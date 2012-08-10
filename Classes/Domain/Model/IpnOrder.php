<?php
namespace Payment\Paypal\Domain\Model;

/*                                                                        			*
 * PayPal IPN Library													  			*
 * This script belongs to the Payment.Paypal package.                     			*
 * 																		 			*
 * This library is inspired by:											  			*
 * - Symfony2 PayPal IPN Bundle, https://github.com/orderly/symfony2-paypal-ipn/	*
 *                                                                        			*
 *                                                                        			*/

use TYPO3\FLOW3\Annotations as FLOW3;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Store
 *
 * @FLOW3\Entity
 */
class IpnOrder {
	
	/**
	 * @var \Doctrine\Common\Collections\Collection<\Payment\Paypal\Domain\Model\IpnOrderItem>
	 * @ORM\OneToMany(mappedBy="ipnOrder", cascade={"all"})
	 */
	protected $ipnOrderItems;
	
 	/**
	 * @var string
	 * @ORM\Column(name="notify_version", type="string", length=64, nullable=true)
	 */
	protected $notifyVersion;

	/**
	* @var string
	* @ORM\Column(name="verify_sign", type="string", length=127, nullable=true)
	*/
	protected $verifySign;

	/**
	* @var integer
	* @ORM\Column(name="test_ipn", type="integer", nullable=true)
	*/
	protected $testIpn;

	/**
	* @var string
	* @ORM\Column(name="protection_eligibility", type="string", length=24, nullable=true)
	*/
	protected $protectionEligibility;

	/**
	* @var string
	* @ORM\Column(name="charset", type="string", length=127, nullable=true)
	*/
	protected $charset;

	/**
	* @var string
	* @ORM\Column(name="btn_id", type="string", length=40, nullable=true)
	*/
	protected $btnId;

	/**
	* @var string
	* @ORM\Column(name="address_city", type="string", length=40, nullable=true)
	*/
	protected $addressCity;

	/**
	* @var string
	* @ORM\Column(name="address_country", type="string", length=64, nullable=true)
	*/
	protected $addressCountry;

	/**
	* @var string
	* @ORM\Column(name="address_country_code", type="string", length=2, nullable=true)
	*/
	protected $addressCountryCode;

	/**
	* @var string
	* @ORM\Column(name="address_name", type="string", length=128, nullable=true)
	*/
	protected $addressName;

	/**
	* @var string
	* @ORM\Column(name="address_state", type="string", length=40, nullable=true)
	*/
	protected $addressState;

	/**
	* @var string
	* @ORM\Column(name="address_status", type="string", length=20, nullable=true)
	*/
	protected $addressStatus;

	/**
	* @var string
	* @ORM\Column(name="address_street", type="string", length=200, nullable=true)
	*/
	protected $addressStreet;

	/**
	* @var string
	* @ORM\Column(name="address_zip", type="string", length=20, nullable=true)
	*/
	protected $addressZip;

	/**
	* @var string
	* @ORM\Column(name="first_name", type="string", length=64, nullable=true)
	*/
	protected $firstName;

	/**
	* @var string
	* @ORM\Column(name="last_name", type="string", length=64, nullable=true)
	*/
	protected $lastName;

	/**
	* @var string
	* @ORM\Column(name="payer_business_name", type="string", length=127, nullable=true)
	*/
	protected $payerBusinessName;

	/**
	* @var string
	* @ORM\Column(name="payer_email", type="string", length=127, nullable=true)
	*/
	protected $payerEmail;

	/**
	* @var string
	* @ORM\Column(name="payer_id", type="string", length=13, nullable=true)
	*/
	protected $payerId;

	/**
	* @var string
	* @ORM\Column(name="payer_status", type="string", length=20, nullable=true)
	*/
	protected $payerStatus;

	/**
	* @var string
	* @ORM\Column(name="contact_phone", type="string", length=20, nullable=true)
	*/
	protected $contactPhone;

	/**
	* @var string
	* @ORM\Column(name="residence_country", type="string", length=2, nullable=true)
	*/
	protected $residenceCountry;

	/**
	* @var string
	* @ORM\Column(name="business", type="string", length=127, nullable=true)
	*/
	protected $business;

	/**
	* @var string
	* @ORM\Column(name="receiver_email", type="string", length=127, nullable=true)
	*/
	protected $receiverEmail;

	/**
	* @var string
	* @ORM\Column(name="receiver_id", type="string", length=13, nullable=true)
	*/
	protected $receiverId;

	/**
	* @var string
	* @ORM\Column(name="custom", type="string", length=255, nullable=true)
	*/
	protected $custom;

	/**
	* @var string
	* @ORM\Column(name="invoice", type="string", length=127, nullable=true)
	*/
	protected $invoice;

	/**
	* @var string
	* @ORM\Column(name="memo", type="string", length=255, nullable=true)
	*/
	protected $memo;

	/**
	* @var float
	* @ORM\Column(name="tax", type="decimal", scale=2, nullable=true)
	*/
	protected $tax;

	/**
	* @var string
	* @ORM\Column(name="auth_id", type="string", length=19, nullable=true)
	*/
	protected $authId;

	/**
	* @var string
	* @ORM\Column(name="auth_exp", type="string", length=28, nullable=true)
	*/
	protected $authExp;

	/**
	* @var integer
	* @ORM\Column(name="auth_amount", type="integer", nullable=true)
	*/
	protected $authAmount;

	/**
	* @var string
	* @ORM\Column(name="auth_status", type="string", length=20, nullable=true)
	*/
	protected $authStatus;

	/**
	* @var integer
	* @ORM\Column(name="num_cart_items", type="integer", nullable=true)
	*/
	protected $numCartItems;

	/**
	* @var string
	* @ORM\Column(name="parent_txn_id", type="string", length=19, nullable=true)
	*/
	protected $parentTxnId;

	/**
	* @var string
	* @ORM\Column(name="payment_date", type="string", length=28, nullable=true)
	*/
	protected $paymentDate;

	/**
	* @var string
	* @ORM\Column(name="payment_status", type="string", length=20, nullable=true)
	*/
	protected $paymentStatus;

	/**
	* @var string
	* @ORM\Column(name="payment_type", type="string", length=10, nullable=true)
	*/
	protected $paymentType;

	/**
	* @var string
	* @ORM\Column(name="pending_reason", type="string", length=20, nullable=true)
	*/
	protected $pendingReason;

	/**
	* @var string
	* @ORM\Column(name="reason_code", type="string", length=20, nullable=true)
	*/
	protected $reasonCode;

	/**
	* @var integer
	* @ORM\Column(name="remaining_settle", type="integer", nullable=true)
	*/
	protected $remainingSettle;

	/**
	* @var string
	* @ORM\Column(name="shipping_method", type="string", length=64, nullable=true)
	*/
	protected $shippingMethod;

	/**
	* @var float
	* @ORM\Column(name="shipping", type="decimal", scale=2, nullable=true)
	*/
	protected $shipping;

	/**
	* @var string
	* @ORM\Column(name="transaction_entity", type="string", length=20, nullable=true)
	*/
	protected $transactionEntity;

	/**
	* @var string
	* @ORM\Column(name="txn_id", type="string", length=19, nullable=true)
	*/
	protected $txnId;

	/**
	* @var string
	* @ORM\Column(name="txn_type", type="string", length=20, nullable=true)
	*/
	protected $txnType;

	/**
	* @var float
	* @ORM\Column(name="exchange_rate", type="decimal", scale=2, nullable=true)
	*/
	protected $exchangeRate;

	/**
	* @var string
	* @ORM\Column(name="mc_currency", type="string", length=3, nullable=true)
	*/
	protected $mcCurrency;

	/**
	* @var float
	* @ORM\Column(name="mc_fee", type="decimal", scale=2, nullable=true)
	*/
	protected $mcFee;

	/**
	* @var float
	* @ORM\Column(name="mc_gross", type="decimal", scale=2, nullable=true)
	*/
	protected $mcGross;

	/**
	* @var float
	* @ORM\Column(name="mc_handling", type="decimal", scale=2, nullable=true)
	*/
	protected $mcHandling;

	/**
	* @var float
	* @ORM\Column(name="mc_shipping", type="decimal", scale=2, nullable=true)
	*/
	protected $mcShipping;

	/**
	* @var float
	* @ORM\Column(name="payment_fee", type="decimal", scale=2, nullable=true)
	*/
	protected $paymentFee;

	/**
	* @var float
	* @ORM\Column(name="payment_gross", type="decimal", scale=2, nullable=true)
	*/
	protected $paymentGross;

	/**
	* @var float
	* @ORM\Column(name="settle_amount", type="decimal", scale=2, nullable=true)
	*/
	protected $settleAmount;

	/**
	* @var string
	* @ORM\Column(name="settle_currency", type="string", length=3, nullable=true)
	*/
	protected $settleCurrency;

	/**
	* @var string
	* @ORM\Column(name="auction_buyer_id", type="string", length=64, nullable=true)
	*/
	protected $auctionBuyerId;

	/**
	* @var string
	* @ORM\Column(name="auction_closing_date", type="string", length=28, nullable=true)
	*/
	protected $auctionClosingDate;

	/**
	* @var integer
	* @ORM\Column(name="auction_multi_item", type="integer", nullable=true)
	*/
	protected $auctionMultiItem;

	/**
	* @var string
	* @ORM\Column(name="for_auction", type="string", length=10, nullable=true)
	*/
	protected $forAuction;

	/**
	* @var string
	* @ORM\Column(name="subscr_date", type="string", length=28, nullable=true)
	*/
	protected $subscrDate;

	/**
	* @var string
	* @ORM\Column(name="subscr_effective", type="string", length=28, nullable=true)
	*/
	protected $subscrEffective;

	/**
	* @var string
	* @ORM\Column(name="period1", type="string", length=10, nullable=true)
	*/
	protected $period1;

	/**
	* @var string
	* @ORM\Column(name="period2", type="string", length=10, nullable=true)
	*/
	protected $period2;

	/**
	* @var string
	* @ORM\Column(name="period3", type="string", length=10, nullable=true)
	*/
	protected $period3;

	/**
	* @var float
	* @ORM\Column(name="amount1", type="decimal", scale=2, nullable=true)
	*/
	protected $amount1;

	/**
	* @var float
	* @ORM\Column(name="amount2", type="decimal", scale=2, nullable=true)
	*/
	protected $amount2;

	/**
	* @var float
	* @ORM\Column(name="amount3", type="decimal", scale=2, nullable=true)
	*/
	protected $amount3;

	/**
	* @var float
	* @ORM\Column(name="mc_amount1", type="decimal", scale=2, nullable=true)
	*/
	protected $mcAmount1;

	/**
	* @var float
	* @ORM\Column(name="mc_amount2", type="decimal", scale=2, nullable=true)
	*/
	protected $mcAmount2;

	/**
	* @var float
	* @ORM\Column(name="mc_amount3", type="decimal", scale=2, nullable=true)
	*/
	protected $mcAmount3;

	/**
	* @var string
	* @ORM\Column(name="recurring", type="string", length=1, nullable=true)
	*/
	protected $recurring;

	/**
	* @var string
	* @ORM\Column(name="reattempt", type="string", length=1, nullable=true)
	*/
	protected $reattempt;

	/**
	* @var string
	* @ORM\Column(name="retry_at", type="string", length=28, nullable=true)
	*/
	protected $retryAt;

	/**
	* @var integer
	* @ORM\Column(name="recur_times", type="integer", nullable=true)
	*/
	protected $recurTimes;

	/**
	* @var string
	* @ORM\Column(name="username", type="string", length=64, nullable=true)
	*/
	protected $username;

	/**
	* @var string
	* @ORM\Column(name="password", type="string", length=24, nullable=true)
	*/
	protected $password;

	/**
	* @var string
	* @ORM\Column(name="subscr_id", type="string", length=19, nullable=true)
	*/
	protected $subscrId;

	/**
	* @var string
	* @ORM\Column(name="case_id", type="string", length=28, nullable=true)
	*/
	protected $caseId;

	/**
	* @var string
	* @ORM\Column(name="case_type", type="string", length=28, nullable=true)
	*/
	protected $caseType;

	/**
	* @var string
	* @ORM\Column(name="case_creation_date", type="string", length=28, nullable=true)
	*/
	protected $caseCreationDate;

	/**
	* @var string
	* @ORM\Column(name="order_status", type="string", length=9, nullable=true)
	*/
	protected $orderStatus;

	/**
	* @var \DateTime
	* @ORM\Column(name="discount", type="decimal", scale=2, nullable=true)
	*/
	protected $discount;

	/**
	* @var float
	* @ORM\Column(name="shipping_discount", type="decimal", scale=2, nullable=true)
	*/
	protected $shippingDiscount;

	/**
	* @var string
	* @ORM\Column(name="ipn_track_id", type="string", length=127, nullable=true)
	*/
	protected $ipnTrackId;

	/**
	* @var string
	* @ORM\Column(name="transaction_subject", type="string", length=255, nullable=true)
	*/
	protected $transactionSubject;

	/**
	* @var \DateTime
	* @ORM\Column(name="created_at", type="datetime", nullable=false)
	*/
	protected $createdAt;

	/**
	* @var \DateTime
	* @ORM\Column(name="updated_at", type="datetime", nullable=false)
	*/
	protected $updatedAt;

	
	/**
	 * Constructs a new ipn order
	 */
	public function __construct() {
		$this->ipnOrderItems = new \Doctrine\Common\Collections\ArrayCollection();
	}
	
	/**
	* Set id
	*
	* @param integer $id
	*/
	public function setId($id)
	{
	$this->id = intval($id);
	}

	/**
	* Get id
	*
	* @return integer
	*/
	public function getId()
	{
	return $this->id;
	}

	/**
	* Set notifyVersion
	*
	* @param string $notifyVersion
	*/
	public function setNotifyVersion($notifyVersion)
	{
	$this->notifyVersion = $notifyVersion;
	}

	/**
	* Get notifyVersion
	*
	* @return string
	*/
	public function getNotifyVersion()
	{
	return $this->notifyVersion;
	}

	/**
	* Set verifySign
	*
	* @param string $verifySign
	*/
	public function setVerifySign($verifySign)
	{
	$this->verifySign = $verifySign;
	}

	/**
	* Get verifySign
	*
	* @return string
	*/
	public function getVerifySign()
	{
	return $this->verifySign;
	}

	/**
	* Set testIpn
	*
	* @param integer $testIpn
	*/
	public function setTestIpn($testIpn)
	{
	$this->testIpn = intval($testIpn);
	}

	/**
	* Get testIpn
	*
	* @return integer
	*/
	public function getTestIpn()
	{
	return $this->testIpn;
	}

	/**
	* Set protectionEligibility
	*
	* @param string $protectionEligibility
	*/
	public function setProtectionEligibility($protectionEligibility)
	{
	$this->protectionEligibility = $protectionEligibility;
	}

	/**
	* Get protectionEligibility
	*
	* @return string
	*/
	public function getProtectionEligibility()
	{
	return $this->protectionEligibility;
	}

	/**
	* Set charset
	*
	* @param string $charset
	*/
	public function setCharset($charset)
	{
	$this->charset = $charset;
	}

	/**
	* Get charset
	*
	* @return string
	*/
	public function getCharset()
	{
	return $this->charset;
	}

	/**
	* Set btnId
	*
	* @param string $btnId
	*/
	public function setBtnId($btnId)
	{
	$this->btnId = $btnId;
	}

	/**
	* Get btnId
	*
	* @return string
	*/
	public function getBtnId()
	{
	return $this->btnId;
	}

	/**
	* Set addressCity
	*
	* @param string $addressCity
	*/
	public function setAddressCity($addressCity)
	{
	$this->addressCity = $addressCity;
	}

	/**
	* Get addressCity
	*
	* @return string
	*/
	public function getAddressCity()
	{
	return $this->addressCity;
	}

	/**
	* Set addressCountry
	*
	* @param string $addressCountry
	*/
	public function setAddressCountry($addressCountry)
	{
	$this->addressCountry = $addressCountry;
	}

	/**
	* Get addressCountry
	*
	* @return string
	*/
	public function getAddressCountry()
	{
	return $this->addressCountry;
	}

	/**
	* Set addressCountryCode
	*
	* @param string $addressCountryCode
	*/
	public function setAddressCountryCode($addressCountryCode)
	{
	$this->addressCountryCode = $addressCountryCode;
	}

	/**
	* Get addressCountryCode
	*
	* @return string
	*/
	public function getAddressCountryCode()
	{
	return $this->addressCountryCode;
	}

	/**
	* Set addressName
	*
	* @param string $addressName
	*/
	public function setAddressName($addressName)
	{
	$this->addressName = $addressName;
	}

	/**
	* Get addressName
	*
	* @return string
	*/
	public function getAddressName()
	{
	return $this->addressName;
	}

	/**
	* Set addressState
	*
	* @param string $addressState
	*/
	public function setAddressState($addressState)
	{
	$this->addressState = $addressState;
	}

	/**
	* Get addressState
	*
	* @return string
	*/
	public function getAddressState()
	{
	return $this->addressState;
	}

	/**
	* Set addressStatus
	*
	* @param string $addressStatus
	*/
	public function setAddressStatus($addressStatus)
	{
	$this->addressStatus = $addressStatus;
	}

	/**
	* Get addressStatus
	*
	* @return string
	*/
	public function getAddressStatus()
	{
	return $this->addressStatus;
	}

	/**
	* Set addressStreet
	*
	* @param string $addressStreet
	*/
	public function setAddressStreet($addressStreet)
	{
	$this->addressStreet = $addressStreet;
	}

	/**
	* Get addressStreet
	*
	* @return string
	*/
	public function getAddressStreet()
	{
	return $this->addressStreet;
	}

	/**
	* Set addressZip
	*
	* @param string $addressZip
	*/
	public function setAddressZip($addressZip)
	{
	$this->addressZip = $addressZip;
	}

	/**
	* Get addressZip
	*
	* @return string
	*/
	public function getAddressZip()
	{
	return $this->addressZip;
	}

	/**
	* Set firstName
	*
	* @param string $firstName
	*/
	public function setFirstName($firstName)
	{
	$this->firstName = $firstName;
	}

	/**
	* Get firstName
	*
	* @return string
	*/
	public function getFirstName()
	{
	return $this->firstName;
	}

	/**
	* Set lastName
	*
	* @param string $lastName
	*/
	public function setLastName($lastName)
	{
	$this->lastName = $lastName;
	}

	/**
	* Get lastName
	*
	* @return string
	*/
	public function getLastName()
	{
	return $this->lastName;
	}

	/**
	* Set payerBusinessName
	*
	* @param string $payerBusinessName
	*/
	public function setPayerBusinessName($payerBusinessName)
	{
	$this->payerBusinessName = $payerBusinessName;
	}

	/**
	* Get payerBusinessName
	*
	* @return string
	*/
	public function getPayerBusinessName()
	{
	return $this->payerBusinessName;
	}

	/**
	* Set payerEmail
	*
	* @param string $payerEmail
	*/
	public function setPayerEmail($payerEmail)
	{
	$this->payerEmail = $payerEmail;
	}

	/**
	* Get payerEmail
	*
	* @return string
	*/
	public function getPayerEmail()
	{
	return $this->payerEmail;
	}

	/**
	* Set payerId
	*
	* @param string $payerId
	*/
	public function setPayerId($payerId)
	{
	$this->payerId = $payerId;
	}

	/**
	* Get payerId
	*
	* @return string
	*/
	public function getPayerId()
	{
	return $this->payerId;
	}

	/**
	* Set payerStatus
	*
	* @param string $payerStatus
	*/
	public function setPayerStatus($payerStatus)
	{
	$this->payerStatus = $payerStatus;
	}

	/**
	* Get payerStatus
	*
	* @return string
	*/
	public function getPayerStatus()
	{
	return $this->payerStatus;
	}

	/**
	* Set contactPhone
	*
	* @param string $contactPhone
	*/
	public function setContactPhone($contactPhone)
	{
	$this->contactPhone = $contactPhone;
	}

	/**
	* Get contactPhone
	*
	* @return string
	*/
	public function getContactPhone()
	{
	return $this->contactPhone;
	}

	/**
	* Set residenceCountry
	*
	* @param string $residenceCountry
	*/
	public function setResidenceCountry($residenceCountry)
	{
	$this->residenceCountry = $residenceCountry;
	}

	/**
	* Get residenceCountry
	*
	* @return string
	*/
	public function getResidenceCountry()
	{
	return $this->residenceCountry;
	}

	/**
	* Set business
	*
	* @param string $business
	*/
	public function setBusiness($business)
	{
	$this->business = $business;
	}

	/**
	* Get business
	*
	* @return string
	*/
	public function getBusiness()
	{
	return $this->business;
	}

	/**
	* Set receiverEmail
	*
	* @param string $receiverEmail
	*/
	public function setReceiverEmail($receiverEmail)
	{
	$this->receiverEmail = $receiverEmail;
	}

	/**
	* Get receiverEmail
	*
	* @return string
	*/
	public function getReceiverEmail()
	{
	return $this->receiverEmail;
	}

	/**
	* Set receiverId
	*
	* @param string $receiverId
	*/
	public function setReceiverId($receiverId)
	{
	$this->receiverId = $receiverId;
	}

	/**
	* Get receiverId
	*
	* @return string
	*/
	public function getReceiverId()
	{
	return $this->receiverId;
	}

	/**
	* Set custom
	*
	* @param string $custom
	*/
	public function setCustom($custom)
	{
	$this->custom = $custom;
	}

	/**
	* Get custom
	*
	* @return string
	*/
	public function getCustom()
	{
	return $this->custom;
	}

	/**
	* Set invoice
	*
	* @param string $invoice
	*/
	public function setInvoice($invoice)
	{
	$this->invoice = $invoice;
	}

	/**
	* Get invoice
	*
	* @return string
	*/
	public function getInvoice()
	{
	return $this->invoice;
	}

	/**
	* Set memo
	*
	* @param string $memo
	*/
	public function setMemo($memo)
	{
	$this->memo = $memo;
	}

	/**
	* Get memo
	*
	* @return string
	*/
	public function getMemo()
	{
	return $this->memo;
	}

	/**
	* Set tax
	*
	* @param float $tax
	*/
	public function setTax($tax)
	{
	$this->tax = floatval($tax);
	}

	/**
	* Get tax
	*
	* @return float
	*/
	public function getTax()
	{
	return $this->tax;
	}

	/**
	* Set authId
	*
	* @param string $authId
	*/
	public function setAuthId($authId)
	{
	$this->authId = $authId;
	}

	/**
	* Get authId
	*
	* @return string
	*/
	public function getAuthId()
	{
	return $this->authId;
	}

	/**
	* Set authExp
	*
	* @param string $authExp
	*/
	public function setAuthExp($authExp)
	{
	$this->authExp = $authExp;
	}

	/**
	* Get authExp
	*
	* @return string
	*/
	public function getAuthExp()
	{
	return $this->authExp;
	}

	/**
	* Set authAmount
	*
	* @param integer $authAmount
	*/
	public function setAuthAmount($authAmount)
	{
	$this->authAmount = intval($authAmount);
	}

	/**
	* Get authAmount
	*
	* @return integer
	*/
	public function getAuthAmount()
	{
	return $this->authAmount;
	}

	/**
	* Set authStatus
	*
	* @param string $authStatus
	*/
	public function setAuthStatus($authStatus)
	{
	$this->authStatus = $authStatus;
	}

	/**
	* Get authStatus
	*
	* @return string
	*/
	public function getAuthStatus()
	{
	return $this->authStatus;
	}

	/**
	* Set numCartItems
	*
	* @param integer $numCartItems
	*/
	public function setNumCartItems($numCartItems)
	{
	$this->numCartItems = intval($numCartItems);
	}

	/**
	* Get numCartItems
	*
	* @return integer
	*/
	public function getNumCartItems()
	{
	return $this->numCartItems;
	}

	/**
	* Set parentTxnId
	*
	* @param string $parentTxnId
	*/
	public function setParentTxnId($parentTxnId)
	{
	$this->parentTxnId = $parentTxnId;
	}

	/**
	* Get parentTxnId
	*
	* @return string
	*/
	public function getParentTxnId()
	{
	return $this->parentTxnId;
	}

	/**
	* Set paymentDate
	*
	* @param string $paymentDate
	*/
	public function setPaymentDate($paymentDate)
	{
	$this->paymentDate = $paymentDate;
	}

	/**
	* Get paymentDate
	*
	* @return string
	*/
	public function getPaymentDate()
	{
	return $this->paymentDate;
	}

	/**
	* Set paymentStatus
	*
	* @param string $paymentStatus
	*/
	public function setPaymentStatus($paymentStatus)
	{
	$this->paymentStatus = $paymentStatus;
	}

	/**
	* Get paymentStatus
	*
	* @return string
	*/
	public function getPaymentStatus()
	{
	return $this->paymentStatus;
	}

	/**
	* Set paymentType
	*
	* @param string $paymentType
	*/
	public function setPaymentType($paymentType)
	{
	$this->paymentType = $paymentType;
	}

	/**
	* Get paymentType
	*
	* @return string
	*/
	public function getPaymentType()
	{
	return $this->paymentType;
	}

	/**
	* Set pendingReason
	*
	* @param string $pendingReason
	*/
	public function setPendingReason($pendingReason)
	{
	$this->pendingReason = $pendingReason;
	}

	/**
	* Get pendingReason
	*
	* @return string
	*/
	public function getPendingReason()
	{
	return $this->pendingReason;
	}

	/**
	* Set reasonCode
	*
	* @param string $reasonCode
	*/
	public function setReasonCode($reasonCode)
	{
	$this->reasonCode = $reasonCode;
	}

	/**
	* Get reasonCode
	*
	* @return string
	*/
	public function getReasonCode()
	{
	return $this->reasonCode;
	}

	/**
	* Set remainingSettle
	*
	* @param integer $remainingSettle
	*/
	public function setRemainingSettle($remainingSettle)
	{
	$this->remainingSettle = intval($remainingSettle);
	}

	/**
	* Get remainingSettle
	*
	* @return integer
	*/
	public function getRemainingSettle()
	{
	return $this->remainingSettle;
	}

	/**
	* Set shippingMethod
	*
	* @param string $shippingMethod
	*/
	public function setShippingMethod($shippingMethod)
	{
	$this->shippingMethod = $shippingMethod;
	}

	/**
	* Get shippingMethod
	*
	* @return string
	*/
	public function getShippingMethod()
	{
	return $this->shippingMethod;
	}

	/**
	* Set shipping
	*
	* @param float $shipping
	*/
	public function setShipping($shipping)
	{
	$this->shipping = floatval($shipping);
	}

	/**
	* Get shipping
	*
	* @return float
	*/
	public function getShipping()
	{
	return $this->shipping;
	}

	/**
	* Set transactionEntity
	*
	* @param string $transactionEntity
	*/
	public function setTransactionEntity($transactionEntity)
	{
	$this->transactionEntity = $transactionEntity;
	}

	/**
	* Get transactionEntity
	*
	* @return string
	*/
	public function getTransactionEntity()
	{
	return $this->transactionEntity;
	}

	/**
	* Set txnId
	*
	* @param string $txnId
	*/
	public function setTxnId($txnId)
	{
	$this->txnId = $txnId;
	}

	/**
	* Get txnId
	*
	* @return string
	*/
	public function getTxnId()
	{
	return $this->txnId;
	}

	/**
	* Set txnType
	*
	* @param string $txnType
	*/
	public function setTxnType($txnType)
	{
	$this->txnType = $txnType;
	}

	/**
	* Get txnType
	*
	* @return string
	*/
	public function getTxnType()
	{
	return $this->txnType;
	}

	/**
	* Set exchangeRate
	*
	* @param float $exchangeRate
	*/
	public function setExchangeRate($exchangeRate)
	{
	$this->exchangeRate = floatval($exchangeRate);
	}

	/**
	* Get exchangeRate
	*
	* @return float
	*/
	public function getExchangeRate()
	{
	return $this->exchangeRate;
	}

	/**
	* Set mcCurrency
	*
	* @param string $mcCurrency
	*/
	public function setMcCurrency($mcCurrency)
	{
	$this->mcCurrency = $mcCurrency;
	}

	/**
	* Get mcCurrency
	*
	* @return string
	*/
	public function getMcCurrency()
	{
	return $this->mcCurrency;
	}

	/**
	* Set mcFee
	*
	* @param float $mcFee
	*/
	public function setMcFee($mcFee)
	{
	$this->mcFee = floatval($mcFee);
	}

	/**
	* Get mcFee
	*
	* @return float
	*/
	public function getMcFee()
	{
	return $this->mcFee;
	}

	/**
	* Set mcGross
	*
	* @param float $mcGross
	*/
	public function setMcGross($mcGross)
	{
	$this->mcGross = floatval($mcGross);
	}

	/**
	* Get mcGross
	*
	* @return float
	*/
	public function getMcGross()
	{
	return $this->mcGross;
	}

	/**
	* Set mcHandling
	*
	* @param float $mcHandling
	*/
	public function setMcHandling($mcHandling)
	{
	$this->mcHandling = floatval($mcHandling);
	}

	/**
	* Get mcHandling
	*
	* @return float
	*/
	public function getMcHandling()
	{
	return $this->mcHandling;
	}

	/**
	* Set mcShipping
	*
	* @param float $mcShipping
	*/
	public function setMcShipping($mcShipping)
	{
	$this->mcShipping = floatval($mcShipping);
	}

	/**
	* Get mcShipping
	*
	* @return float
	*/
	public function getMcShipping()
	{
	return $this->mcShipping;
	}

	/**
	* Set paymentFee
	*
	* @param float $paymentFee
	*/
	public function setPaymentFee($paymentFee)
	{
	$this->paymentFee = floatval($paymentFee);
	}

	/**
	* Get paymentFee
	*
	* @return float
	*/
	public function getPaymentFee()
	{
	return $this->paymentFee;
	}

	/**
	* Set paymentGross
	*
	* @param float $paymentGross
	*/
	public function setPaymentGross($paymentGross)
	{
	$this->paymentGross = floatval($paymentGross);
	}

	/**
	* Get paymentGross
	*
	* @return float
	*/
	public function getPaymentGross()
	{
	return $this->paymentGross;
	}

	/**
	* Set settleAmount
	*
	* @param float $settleAmount
	*/
	public function setSettleAmount($settleAmount)
	{
	$this->settleAmount = floatval($settleAmount);
	}

	/**
	* Get settleAmount
	*
	* @return float
	*/
	public function getSettleAmount()
	{
	return $this->settleAmount;
	}

	/**
	* Set settleCurrency
	*
	* @param string $settleCurrency
	*/
	public function setSettleCurrency($settleCurrency)
	{
	$this->settleCurrency = $settleCurrency;
	}

	/**
	* Get settleCurrency
	*
	* @return string
	*/
	public function getSettleCurrency()
	{
	return $this->settleCurrency;
	}

	/**
	* Set auctionBuyerId
	*
	* @param string $auctionBuyerId
	*/
	public function setAuctionBuyerId($auctionBuyerId)
	{
	$this->auctionBuyerId = $auctionBuyerId;
	}

	/**
	* Get auctionBuyerId
	*
	* @return string
	*/
	public function getAuctionBuyerId()
	{
	return $this->auctionBuyerId;
	}

	/**
	* Set auctionClosingDate
	*
	* @param string $auctionClosingDate
	*/
	public function setAuctionClosingDate($auctionClosingDate)
	{
	$this->auctionClosingDate = $auctionClosingDate;
	}

	/**
	* Get auctionClosingDate
	*
	* @return string
	*/
	public function getAuctionClosingDate()
	{
	return $this->auctionClosingDate;
	}

	/**
	* Set auctionMultiItem
	*
	* @param integer $auctionMultiItem
	*/
	public function setAuctionMultiItem($auctionMultiItem)
	{
	$this->auctionMultiItem = intval($auctionMultiItem);
	}

	/**
	* Get auctionMultiItem
	*
	* @return integer
	*/
	public function getAuctionMultiItem()
	{
	return $this->auctionMultiItem;
	}

	/**
	* Set forAuction
	*
	* @param string $forAuction
	*/
	public function setForAuction($forAuction)
	{
	$this->forAuction = $forAuction;
	}

	/**
	* Get forAuction
	*
	* @return string
	*/
	public function getForAuction()
	{
	return $this->forAuction;
	}

	/**
	* Set subscrDate
	*
	* @param string $subscrDate
	*/
	public function setSubscrDate($subscrDate)
	{
	$this->subscrDate = $subscrDate;
	}

	/**
	* Get subscrDate
	*
	* @return string
	*/
	public function getSubscrDate()
	{
	return $this->subscrDate;
	}

	/**
	* Set subscrEffective
	*
	* @param string $subscrEffective
	*/
	public function setSubscrEffective($subscrEffective)
	{
	$this->subscrEffective = $subscrEffective;
	}

	/**
	* Get subscrEffective
	*
	* @return string
	*/
	public function getSubscrEffective()
	{
	return $this->subscrEffective;
	}

	/**
	* Set period1
	*
	* @param string $period1
	*/
	public function setPeriod1($period1)
	{
	$this->period1 = $period1;
	}

	/**
	* Get period1
	*
	* @return string
	*/
	public function getPeriod1()
	{
	return $this->period1;
	}

	/**
	* Set period2
	*
	* @param string $period2
	*/
	public function setPeriod2($period2)
	{
	$this->period2 = $period2;
	}

	/**
	* Get period2
	*
	* @return string
	*/
	public function getPeriod2()
	{
	return $this->period2;
	}

	/**
	* Set period3
	*
	* @param string $period3
	*/
	public function setPeriod3($period3)
	{
	$this->period3 = $period3;
	}

	/**
	* Get period3
	*
	* @return string
	*/
	public function getPeriod3()
	{
	return $this->period3;
	}

	/**
	* Set amount1
	*
	* @param float $amount1
	*/
	public function setAmount1($amount1)
	{
	$this->amount1 = floatval($amount1);
	}

	/**
	* Get amount1
	*
	* @return float
	*/
	public function getAmount1()
	{
	return $this->amount1;
	}

	/**
	* Set amount2
	*
	* @param float $amount2
	*/
	public function setAmount2($amount2)
	{
	$this->amount2 = $floatval(amount2);
	}

	/**
	* Get amount2
	*
	* @return float
	*/
	public function getAmount2()
	{
	return $this->amount2;
	}

	/**
	* Set amount3
	*
	* @param float $amount3
	*/
	public function setAmount3($amount3)
	{
	$this->amount3 = floatval($amount3);
	}

	/**
	* Get amount3
	*
	* @return float
	*/
	public function getAmount3()
	{
	return $this->amount3;
	}

	/**
	* Set mcAmount1
	*
	* @param float $mcAmount1
	*/
	public function setMcAmount1($mcAmount1)
	{
	$this->mcAmount1 = floatval($mcAmount1);
	}

	/**
	* Get mcAmount1
	*
	* @return float
	*/
	public function getMcAmount1()
	{
	return $this->mcAmount1;
	}

	/**
	* Set mcAmount2
	*
	* @param float $mcAmount2
	*/
	public function setMcAmount2($mcAmount2)
	{
	$this->mcAmount2 = floatval($mcAmount2);
	}

	/**
	* Get mcAmount2
	*
	* @return float
	*/
	public function getMcAmount2()
	{
	return $this->mcAmount2;
	}

	/**
	* Set mcAmount3
	*
	* @param float $mcAmount3
	*/
	public function setMcAmount3($mcAmount3)
	{
	$this->mcAmount3 = floatval($mcAmount3);
	}

	/**
	* Get mcAmount3
	*
	* @return float
	*/
	public function getMcAmount3()
	{
	return $this->mcAmount3;
	}

	/**
	* Set recurring
	*
	* @param string $recurring
	*/
	public function setRecurring($recurring)
	{
	$this->recurring = $recurring;
	}

	/**
	* Get recurring
	*
	* @return string
	*/
	public function getRecurring()
	{
	return $this->recurring;
	}

	/**
	* Set reattempt
	*
	* @param string $reattempt
	*/
	public function setReattempt($reattempt)
	{
	$this->reattempt = $reattempt;
	}

	/**
	* Get reattempt
	*
	* @return string
	*/
	public function getReattempt()
	{
	return $this->reattempt;
	}

	/**
	* Set retryAt
	*
	* @param string $retryAt
	*/
	public function setRetryAt($retryAt)
	{
	$this->retryAt = $retryAt;
	}

	/**
	* Get retryAt
	*
	* @return string
	*/
	public function getRetryAt()
	{
	return $this->retryAt;
	}

	/**
	* Set recurTimes
	*
	* @param integer $recurTimes
	*/
	public function setRecurTimes($recurTimes)
	{
	$this->recurTimes = intval($recurTimes);
	}

	/**
	* Get recurTimes
	*
	* @return integer
	*/
	public function getRecurTimes()
	{
	return $this->recurTimes;
	}

	/**
	* Set username
	*
	* @param string $username
	*/
	public function setUsername($username)
	{
	$this->username = $username;
	}

	/**
	* Get username
	*
	* @return string
	*/
	public function getUsername()
	{
	return $this->username;
	}

	/**
	* Set password
	*
	* @param string $password
	*/
	public function setPassword($password)
	{
	$this->password = $password;
	}

	/**
	* Get password
	*
	* @return string
	*/
	public function getPassword()
	{
	return $this->password;
	}

	/**
	* Set subscrId
	*
	* @param string $subscrId
	*/
	public function setSubscrId($subscrId)
	{
	$this->subscrId = $subscrId;
	}

	/**
	* Get subscrId
	*
	* @return string
	*/
	public function getSubscrId()
	{
	return $this->subscrId;
	}

	/**
	* Set caseId
	*
	* @param string $caseId
	*/
	public function setCaseId($caseId)
	{
	$this->caseId = $caseId;
	}

	/**
	* Get caseId
	*
	* @return string
	*/
	public function getCaseId()
	{
	return $this->caseId;
	}

	/**
	* Set caseType
	*
	* @param string $caseType
	*/
	public function setCaseType($caseType)
	{
	$this->caseType = $caseType;
	}

	/**
	* Get caseType
	*
	* @return string
	*/
	public function getCaseType()
	{
	return $this->caseType;
	}

	/**
	* Set caseCreationDate
	*
	* @param string $caseCreationDate
	*/
	public function setCaseCreationDate($caseCreationDate)
	{
	$this->caseCreationDate = $caseCreationDate;
	}

	/**
	* Get caseCreationDate
	*
	* @return string
	*/
	public function getCaseCreationDate()
	{
	return $this->caseCreationDate;
	}

	/**
	* Set orderStatus
	*
	* @param string $orderStatus
	*/
	public function setOrderStatus($orderStatus)
	{
	$this->orderStatus = $orderStatus;
	}

	/**
	* Get orderStatus
	*
	* @return string
	*/
	public function getOrderStatus()
	{
	return $this->orderStatus;
	}

	/**
	* Set discount
	*
	* @param float $discount
	*/
	public function setDiscount($discount)
	{
	$this->discount = floatval($discount);
	}

	/**
	* Get discount
	*
	* @return float
	*/
	public function getDiscount()
	{
	return $this->discount;
	}

	/**
	* Set shippingDiscount
	*
	* @param float $shippingDiscount
	*/
	public function setShippingDiscount($shippingDiscount)
	{
	$this->shippingDiscount = floatval($shippingDiscount);
	}

	/**
	* Get shippingDiscount
	*
	* @return float
	*/
	public function getShippingDiscount()
	{
	return $this->shippingDiscount;
	}

	/**
	* Set ipnTrackId
	*
	* @param string $ipnTrackId
	*/
	public function setIpnTrackId($ipnTrackId)
	{
	$this->ipnTrackId = $ipnTrackId;
	}

	/**
	* Get ipnTrackId
	*
	* @return string
	*/
	public function getIpnTrackId()
	{
	return $this->ipnTrackId;
	}

	/**
	* Set transactionSubject
	*
	* @param string $transactionSubject
	*/
	public function setTransactionSubject($transactionSubject)
	{
	$this->transactionSubject = $transactionSubject;
	}

	/**
	* Get transactionSubject
	*
	* @return string
	*/
	public function getTransactionSubject()
	{
	return $this->transactionSubject;
	}

	/**
	* Set createdAt
	*
	* @param \DateTime $createdAt
	*/
	public function setCreatedAt($createdAt)
	{
	$this->createdAt = $createdAt;
	}

	/**
	* Get createdAt
	*
	* @return \DateTime
	*/
	public function getCreatedAt()
	{
	return $this->createdAt;
	}

	/**
	* Set updatedAt
	*
	* @param \DateTime $updatedAt
	*/
	public function setUpdatedAt($updatedAt)
	{
	$this->updatedAt = $updatedAt;
	}

	/**
	* Get updatedAt
	*
	* @return \DateTime
	*/
	public function getUpdatedAt()
	{
	return $this->updatedAt;
	}

	/**
	 * Adds an ipn order item to this ipn order
	 *
	 * @param \Payment\Paypal\Domain\Model\IpnOrderItem $ipnOrderItem
	 * @return void
	 */
	public function addIpnOrderItem(\Payment\Paypal\Domain\Model\IpnOrderItem $ipnOrderItem) {
		$ipnOrderItem->setIpnOrder($this);
		$this->ipnOrderItems->add($ipnOrderItem);
	}

	/**
	 * Removes an ipn order item from this ipn order
	 *
	 * @param \Payment\Paypal\Domain\Model\IpnOrderItem $ipnOrderItem
	 * @return void
	 */
	public function removeIpnOrderItem(\Payment\Paypal\Domain\Model\IpnOrderItem $ipnOrderItem) {
		$this->ipnOrderItems->removeElement($ipnOrderItem);
	}

	/**
	 * Returns the ipn order items
	 *
	 * @return \Doctrine\Common\Collections\Collection<\Payment\Paypal\Domain\Model\IpnOrderItem>
	 */
	public function getIpnOrderItems() {
		return $this->ipnOrderItems;
	}

}
?>