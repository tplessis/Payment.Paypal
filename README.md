Payment.Paypal
==============

This is a Paypal library for FLOW3 heavily inspired by https://github.com/orderly/symfony2-paypal-ipn/.

### Configuration

In the Settings.yaml, configure your Paypal merchant email and controller actions wich will received paypal responses :
- Response : This is the controller action where your PayPal buyers will be sent AFTER they have successfully purchased your products.
- Cancel : This is the controller action where your PayPal buyers will be sent if they cancel purchased.
- AutoResponse : Controller action wich received Paypal IPN.

### Example

Here is an example of a paypal controller to include in your package :
    
    <?php
	namespace Your\Namespace\Controller;
	
	use TYPO3\FLOW3\Annotations as FLOW3;
	
	/**
	 * A controller which manage paypal responses
	 *
	 */
	class PaypalController extends \TYPO3\FLOW3\Mvc\Controller\ActionController {
	
		/**
		* @FLOW3\Inject
		* @var \Payment\Paypal\Actions\Response
		*/
		protected $ipn;
		
		
		/**
		 * Received Paypal IPN notifications
		 * 
		 * @return void
		 */
		public function paypalIpnAction() {
			// Getting ipn service registered in container
			$this->ipn->init($this->user, $this->request);
	        
	        try {
	        	 //validate ipn (generating response on PayPal IPN request)
	        	$this->ipn->validateIPN();
				
	            // Succeeded, now let's extract the order
	            $this->ipn->extractOrder();
				
				// We save the order now
	            $this->ipn->saveOrder();
					
	            // Now let's check what the payment status is and act accordingly
	            if ($this->ipn->getOrderStatus() == \Payment\Paypal\Actions\Response::PAID)
	            {				
					//
					// Save paypal informations like you want
					//
	            }
	        } catch(\Payment\Paypal\Security\Exception $error) {
	        	//
	        	// You can email email errors
	        	//
	        }
	    }
	
		
		/**
		 * Method called if the paypal validation is correct
		 * 
		 * @return void
		 */
		public function paypalTrueAction() {
			
		}
		
		/**
		 * Method called if the paypal validation is wrong
		 * 
		 * @return void
		 */
		public function paypalFalseAction() {
			
		}
	
	}

	?>