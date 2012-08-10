<?php
namespace Payment\Paypal\Actions;

/*                                                                        			*
 * PayPal IPN Library													  			*
 * This script belongs to the Payment.Paypal package.                     			*
 * 																		 			*
 * This library is inspired by:											  			*
 * - Symfony2 PayPal IPN Bundle, https://github.com/orderly/symfony2-paypal-ipn/	*
 *                                                                        			*
 *                                                                        			*/

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * @FLOW3\Scope("singleton")
 */
class Response {
	
	/**
	 * The PayPal IPN URL we're using
	 * @var string
	 */
	protected $ipnUrl;
	
	/**
	 * The merchant's email address connected to PayPal
	 * @var string
	 */
	protected $merchantEmail;
	
	/**
	 * Contains the POST values for IPN
	 * @var array
	 */
	protected $ipnData;
	
	/**
	 * Contains the fields pertaining to an order
	 * @var \Payment\Paypal\Domain\Model\IpnOrder
	 */
	protected $order;
	
	/**
	 * All-important variable: whether the order has been paid for yet or not
	 * @var string
	 */
	protected $orderStatus;
	
	/**
	 * The transaction ID aka txn_id (from PayPal)
	 * @var boolean
	 */
	protected $transactionID;
	
	/**
	 * The type of transaction (from PayPal)
	 * @var boolean
	 */
	protected $transactionType;
	
	/**
	 * User associated to the transaction
	 * @var \TYPO3\Party\Domain\Model\Person
	 */
	protected $user;
	
	/**
	 * Current request
	 * @var \TYPO3\FLOW3\Mvc\ActionRequest
	 */
	protected $request;
	
	/**
	 * Debug mode or not
	 * @var boolean
	 */
	protected $debug;
	
	/**
	 * Config settings
	 * @var array
	 */
	protected $settingsConfig;
	
	/**
	 * Config settings
	 * @var array
	 */
	protected $settingsLog;
	
	/**
	 * FLOW3 logger
	 * @var \TYPO3\FLOW3\Log\LoggerInterface
	 */
	protected $logger;
	
	/**
	 * @FLOW3\Inject
	 * @var \Payment\Paypal\Domain\Repository\IpnOrderRepository
	 */
	protected $ipnOrderRepository;
	
	/**
	 * @FLOW3\Inject
	 * @var \TYPO3\FLOW3\Configuration\ConfigurationManager
	 */
	protected $configurationManager;
	
	// Payment status constants we use, more user-friendly than the PayPal ones
    const PAID = 'PAID';
    const WAITING = 'WAITING';
    const REJECTED = 'REJECTED';
	
	
	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct() {
			
	}
	
	
	/**
	 * Constructor
	 *
	 * @param \TYPO3\Party\Domain\Model\Person $user FLOW3 User who made the payment
	 * @param \TYPO3\FLOW3\Mvc\ActionRequest $request Current request
	 * @return void
	 */
	public function init($user, $request) {
		// Config data
		$this->settingsConfig = $this->configurationManager->getConfiguration(\TYPO3\FLOW3\Configuration\ConfigurationManager::CONFIGURATION_TYPE_SETTINGS, 'Payment.Paypal.Config');
		$this->settingsLog = $this->configurationManager->getConfiguration(\TYPO3\FLOW3\Configuration\ConfigurationManager::CONFIGURATION_TYPE_SETTINGS, 'Payment.Paypal.Log');
		
		// Context
		$context = getenv('FLOW3_CONTEXT') ?: (getenv('REDIRECT_FLOW3_CONTEXT') ?: 'Development');
		
		// Init vars
		$this->user = $user;
		$this->request = $request;
		$this->ipnUrl = $this->settingsConfig['Uri']['Ipn'][$context];
		$this->merchantEmail = $this->settingsConfig['MerchantEmail'][$context];
		$this->ipnData = array();
		
		// Create FLOW3 logger
    	$this->logger = \TYPO3\FLOW3\Log\LoggerFactory::create('LogPaymentPaypal', 'TYPO3\FLOW3\Log\Logger', $this->settingsLog['PaymentLogger']['backend'], $this->settingsLog['PaymentLogger']['backendOptions']);
	}
	
	/**
	 * Extracts the fields from the IPN notification and then sends them back to PayPal to make sure that the post is not bogus.
	 *
	 * @return void
	 */
    public function validateIPN() {
    	$this->transactionID = NULL;
        $this->transactionType = NULL;
		
    	//get post parameters
        $parameters = $this->request->getHttpRequest()->getArguments();
			
    	// First check that we have post data.
        if (empty($parameters)) {
           	$this->logger->log("No POST data found");
			throw new \Payment\Paypal\Security\Exception\NoPostDataException("No POST data found", 1);
			return;
        }
		
		// Before doing anything else, let's clean up our post data.
        foreach (array_keys($parameters) as $field) {
            $value = $this->request->getHttpRequest()->getArgument($field);
            // Put line feeds back to \r\n for PayPal otherwise multi-line data will be rejected as INVALID
            $parameters[$field] = str_replace("\n", "\r\n", $value);

            // Let's also store this in this class, turning empty strings back to null to avoid breaking Doctrine later
            $this->ipnData[$field] = ($parameters[$field] == '') ? NULL : $parameters[$field];
        }
		
		// Let's now set the transaction type and transaction ID, we'll use these for logging.
        $this->transactionID = (isset($this->ipnData['txn_id']) ? $this->ipnData['txn_id'] : NULL);
        $this->transactionType = (isset($this->ipnData['txn_type']) ? $this->ipnData['txn_type'] : NULL);
        
        // Now we need to check that we haven't received this message from PayPal before.
        if($this->ipnOrderRepository->findBillByTxnId($this->transactionID)) {
        	$this->logger->log("This is a duplicate call: TXN ID " . $this->transactionID . " already logged");
			throw new \Payment\Paypal\Security\Exception\DuplicateCallException("This is a duplicate call: TXN ID " . $this->transactionID . " already logged", 1);
			return;
        }
		
		// Now we need to ask PayPal to tell us if it sent this notification
        try {
	        $ipnResponse = $this->postData($this->ipnUrl, array_merge(
	        	array('cmd' => '_notify-validate'),
	            $parameters
	        ));
		} catch(\Payment\Paypal\Security\Exception\PostDataException $error) {
			throw $error;
			return;
		}
		
		// Check that PayPal says that the IPN call we received is not invalid
        if (stristr("INVALID", $ipnResponse)) {
            // Invalid IPN transaction. Check the log for details.
            $this->logger->log("PayPal rejected the IPN call as invalid - potentially call was spoofed or was not checked within 30s");
			throw new \Payment\Paypal\Security\Exception\InvalidIpnTransactionException("PayPal rejected the IPN call as invalid - potentially call was spoofed or was not checked within 30s", 1);
			return;
        }
		
		// The IPN transaction is a genuine one - now we need to validate its contents.
        // First we check that the receiver email matches our email address.
        if ($this->ipnData['receiver_email'] != $this->merchantEmail) {
            $this->logger->log("Receiver email " . $this->ipnData['receiver_email'] . " does not match merchant's");
			throw new \Payment\Paypal\Security\Exception\ReceiverEmailException("Receiver email " . $this->ipnData['receiver_email'] . " does not match merchant's", 1);
			return;
        }
		
		// The final check is of the payment status. We need to surface this
        // as a class variable so that the calling code can decide how to respond.
        //
        // PayPal has various different payment statuses' - we list them below,
        // but for simplicity we generalise these into three categories:
        // - PAID - meaning the merchant can now dispatch the order
        // - WAITING - wait for another update from PayPal with this transaction_id
        // - REJECTED - meaning that payment failed and the order should be rejected
        // The following page was invaluable in understanding the different PayPal payment
        // statuses: http://www.coderprofile.com/networks/discussion-forum/1305/paypal-help-ipn-payment_status
        //
        // We throw an error if the payment_status code is unrecognised.
        switch ($this->ipnData['payment_status']) {
            case "Completed": // Order has been paid for
                $this->orderStatus = self::PAID;
                break;
            case "Pending": // Payment is still waiting to go through
            case "Processed": // Mostly used to indicate that a cheque has been received and is currently going through the verification process
                $this->orderStatus = self::WAITING;
                break;
            case "Voided": // Bounced or cancelled check
            case "Expired": // Credit card company didn't recognise card
            case "Reversed": // Credit card holder has got the credit card co to reverse the charge
                $this->orderStatus = self::REJECTED;
                break;
            default:
                $this->logger->log("Payment status of " . $this->ipnData['payment_status'] . " is not recognised");
				throw new \Payment\Paypal\Security\Exception\PaymentNotRecognisedException("Payment status of " . $this->ipnData['payment_status'] . " is not recognised", 1);
				return;
        }

        // Phew! We have a valid IPN transaction, log it.
        $this->logger->log("Parsing, authentication and validation completed. Order status = ".$this->orderStatus);
	}


	/**
	* Sending data to PayPal IPN service
	*
	* @param string $url
	* @param array $postData
	*
	* @return string
	*/
    private function postData($url, $postData) {
    	// Put the postData into a string
        $postString = '';
        foreach ($postData as $field=>$value) {
            $postString .= $field . '=' . urlencode(stripslashes($value)) . '&'; // Trailing & at end of post string is forgivable
        }

        $parsedURL = parse_url($url);

        // fsockopen is a bit odd - it just takes the host without the scheme - unless you want to use
        // ssl, in which case you need to use ssl://, not http://
        $ipnURL = ($parsedURL['scheme'] == "https") ? "ssl://" . $parsedURL['host'] : $parsedURL['host'];
        // Likewise, if using ssl, then need to change port from 80 to 443
        $ipnPort = ($parsedURL['scheme'] == "https") ? 443 : 80;
        $fp = @fsockopen($ipnURL, $ipnPort, $errorNumber, $errorString, 30);

        // Log and return if we have an error
        if (!$fp) {
            $this->logger->log("fsockopen error number ". $errorNumber .": ". $errorString ." connecting to " . $parsedURL['host'] . " on port " . $ipnPort);
			throw new \Payment\Paypal\Security\Exception\PostDataException("fsockopen error number ". $errorNumber .": ". $errorString ." connecting to " . $parsedURL['host'] . " on port " . $ipnPort, 1);
			return NULL;
        }
		
		// Path is null
		if (!array_key_exists('path', $parsedURL)) {
			$this->logger->log("IPN url must contains a path in Settings.yaml");
			throw new \Payment\Paypal\Security\Exception\PostDataException("IPN url must contains a path in Settings.yaml", 1);
			return NULL;
		}

        fputs($fp, "POST ". $parsedURL['path']. " HTTP/1.1\r\n");
        fputs($fp, "Host: ". $parsedURL['host']. "\r\n");
        fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
        fputs($fp, "Content-length: " . strlen($postString) . "\r\n");
        fputs($fp, "Connection: close\r\n\r\n");
        fputs($fp, $postString . "\r\n\r\n");
        
        $response = '';
        while (!feof($fp)) {
            $response .= fgets($fp, 1024);
        }
        fclose($fp); // Close connection

        if (strlen($response) == 0) {
            $this->logger->log("Response from PayPal was empty");
			throw new \Payment\Paypal\Security\Exception\PostDataException("Response from PayPal was empty", 1);
			return NULL;
        }

        return $response;
    }
	
	
	
	/**
	 * Function to extract the order and order items from the $ipnData
	 *
	 * @return void
	 */
    public function extractOrder() {
    	$this->order = new \Payment\Paypal\Domain\Model\IpnOrder();
        // First extract the actual order record itself
        foreach ($this->ipnData as $key=>$value) {
            // This is very simple: the order fields are any fields which do not end in a number
            // (because those fields belong to the order items)
            // period, amount, mcAmount ends with number and belongs to order. Think condition line should be commented
            if (preg_match("/.*?(\d+)$/", $key) == 0){
                //this code iterate over ipnData fields, check if order have related field and set it
                $parts = explode('_',$key);
                foreach($parts as $i => $part)
                    $parts[$i] = ucfirst ($part);
                $method = join('',$parts);
                $method = 'set'.$method;
                if(method_exists($this->order, $method))
                    $this->order->$method($value);
            }
        }

        // Let's store the payment status too
        $this->order->setOrderStatus($this->orderStatus);
        
        //Updating dates
        if(!$this->order->getCreatedAt())
            $this->order->setCreatedAt(new \DateTime());
        $this->order->setUpdatedAt(new \DateTime());

    
        // Now retrieve the line items which belong to this order
        $hasCart = ($this->order->getTxnType() == 'cart');
        $numItems = $hasCart ? (int)$this->order->getNumCartItems() : 1;

        $totalBeforeDiscount = 0;
        for ($i = 0; $i < $numItems; $i++) {
            
            // Suffixes are different depending on whether there are multiple items (a cart) or not
            $suffix = $hasCart ? ($i + 1) : '';
            $suffixUnderscore = $hasCart ? '_' . $suffix : $suffix;

            $orderItem = new \Payment\Paypal\Domain\Model\IpnOrderItem();
            if(isset($this->ipnData['item_name' . $suffix]))
                $orderItem->setItemName($this->ipnData['item_name' . $suffix]);
            if(isset($this->ipnData['item_number' . $suffix]))
                $orderItem->setItemNumber($this->ipnData['item_number' . $suffix]);
            if(isset($this->ipnData['quantity' . $suffix]))
                $orderItem->setQuantity($this->ipnData['quantity' . $suffix]);
            if(isset($this->ipnData['mc_gross' . $suffixUnderscore]))
                $orderItem->setMcGross($this->ipnData['mc_gross' . $suffixUnderscore]);
            if(isset($this->ipnData['mc_gross' . $suffixUnderscore]) && isset($this->ipnData['quantity' . $suffix]))
                $orderItem->setCostPerItem(floatval($this->ipnData['mc_gross' . $suffixUnderscore]) / intval($this->ipnData['quantity' . $suffix])); // Should be fine because quantity can never be 0
            
            // Update the total before the discount was applied
            $totalBeforeDiscount += $orderItem->getMcGross();
            
            if(isset($this->ipnData['mc_handling' . $suffix]))
                $orderItem->setMcHandling($this->ipnData['mc_handling' . $suffix]);
            if(isset($this->ipnData['mc_shipping' . $suffix]))
                $orderItem->setMcShipping($this->ipnData['mc_shipping' . $suffix]);
            if(isset($this->ipnData['tax' . $suffix]))
                $orderItem->setTax($this->ipnData['tax' . $suffix]); // Tax is not always set on an item
                        
            
            // Set the order item options if any
            // $count = 7 because PayPal allows you to set a maximum of 7 options per item
            // Reference: https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_html_Appx_websitestandard_htmlvariables
            for ($ii = 1, $count = 7; $ii < $count; $ii++) {
                if(isset($this->ipnData['option_name'.$ii.'_'.$suffix])) {
                    $method = 'setOptionName' . $ii;
                    $orderItem->$method($this->ipnData['option_name'.$ii.'_'.$suffix]);
                }
                if(isset($this->ipnData['option_selection'.$ii.'_'.$suffix])) {
                    $method = 'setOptionSelection' . $ii;
                    $orderItem->$method($this->ipnData['option_selection'.$ii.'_'.$suffix]);
                }
            }
            
            // Updating dates
            if(!$orderItem->getCreatedAt())
                $orderItem->setCreatedAt(new \DateTime());
            $orderItem->setUpdatedAt(new \DateTime());
			
			// Add to order item
			$this->order->addIpnOrderItem($orderItem);
        }

        // And calculate the discount, as it's useful to add this into emails etc
        $this->order->setDiscount($totalBeforeDiscount - $this->order->getMcGross());
	}
	
	
	/**
	 * Function to persist the order and the order items to the database.
	 * Note is that an order may already exist in the system, and this IPN
	 * call is just to update the record - e.g. changing its payment status.
	 * 
	 * @return void
	*/
    public function saveOrder() {
    	$this->ipnOrderRepository->add($this->order);
	}
	
	/**
	* Get orderStatus
	*
	* @return string
	*/
    public function getOrderStatus() {
        return $this->orderStatus;
    }
    
    /**
	* Get order
	*
	* @return object
	*/
    public function getOrder() {
        return $this->order;
    }
	
}

?>
