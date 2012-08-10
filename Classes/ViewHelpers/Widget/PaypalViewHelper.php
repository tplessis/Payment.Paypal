<?php
namespace Payment\Paypal\ViewHelpers\Widget;

/*                                                                        			*
 * PayPal IPN Library													  			*
 * This script belongs to the Payment.Paypal package.                     			*
 * 																		 			*
 * This library is inspired by:											  			*
 * - Symfony2 PayPal IPN Bundle, https://github.com/orderly/symfony2-paypal-ipn/	*
 *                                                                        			*
 *                                                                        			*/

use \TYPO3\FLOW3\Reflection\ObjectAccess;
use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * @api
 */
class PaypalViewHelper extends \TYPO3\Fluid\Core\Widget\AbstractWidgetViewHelper {

	/**
	 * @var bool
	 */
	protected $ajaxWidget = FALSE;

	/**
	 * @FLOW3\Inject
	 * @var Payment\Paypal\ViewHelpers\Widget\Controller\PaypalController
	 */
	protected $controller;

	/**
	 *
	 * @param \TYPO3\Party\Domain\Model\Person $user FLOW3 User who made the payment
	 * @param array $cart
	 * 
	 * @return string
	 */
	public function render($user, $cart=NULL) {
		return $this->initiateSubRequest();
	}

}

?>