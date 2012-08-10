<?php
namespace Payment\Paypal\ViewHelpers\Widget\Controller;

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
 * @api
 */
class PaypalController extends \TYPO3\Fluid\Core\Widget\AbstractWidgetController {
	
	/**
	 * @FLOW3\Inject
	 * @var \TYPO3\FLOW3\Configuration\ConfigurationManager
	 */
	protected $configurationManager;
	
	/**
	 * @return void
	 */
	public function indexAction() {
		// Config data
		$settingsConfig = $this->configurationManager->getConfiguration(\TYPO3\FLOW3\Configuration\ConfigurationManager::CONFIGURATION_TYPE_SETTINGS, 'Payment.Paypal.Config');
		
		// Context
		$context = getenv('FLOW3_CONTEXT') ?: (getenv('REDIRECT_FLOW3_CONTEXT') ?: 'Development');
		
		// Get responses URI
		$uriBuilder = $this->controllerContext->getUriBuilder();
		$uriBuilder->reset();
		$uriBuilder->setRequest($this->request->getMainRequest());
		$uriBuilder->setCreateAbsoluteUri(TRUE);
		$uriReturn = $uriBuilder->uriFor($settingsConfig['Uri']['Response']['ActionName'], NULL, $settingsConfig['Uri']['Response']['ControllerName'], $settingsConfig['Uri']['Response']['Package']);
		$uriCancel = $uriBuilder->uriFor($settingsConfig['Uri']['Cancel']['ActionName'], NULL, $settingsConfig['Uri']['Cancel']['ControllerName'], $settingsConfig['Uri']['Cancel']['Package']);
		$uriAutoResponse = $uriBuilder->uriFor($settingsConfig['Uri']['AutoResponse']['ActionName'], NULL, $settingsConfig['Uri']['AutoResponse']['ControllerName'], $settingsConfig['Uri']['AutoResponse']['Package']);
		
		// Assign vars
		if(isset($this->widgetConfiguration['cart']))
			$this->view->assign('cart', $this->widgetConfiguration['cart']);
		$this->view->assign('user', $this->widgetConfiguration['user']);
		$this->view->assign('uriPaypalIpn', $settingsConfig['Uri']['Ipn'][$context]);
		$this->view->assign('merchantEmail', $settingsConfig['MerchantEmail'][$context]);
		$this->view->assign('currencyCode', $settingsConfig['CurrencyCode']);  
		$this->view->assign('uriResponse', $uriReturn);
		$this->view->assign('uriCancel', $uriCancel);
		$this->view->assign('uriAutoResponse', $uriAutoResponse);
	}

}
?>