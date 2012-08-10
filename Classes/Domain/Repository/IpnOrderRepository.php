<?php
namespace Payment\Paypal\Domain\Repository;

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
 * A repository for IpnOrder
 *
 * @FLOW3\Scope("singleton")
 */
class IpnOrderRepository extends \TYPO3\FLOW3\Persistence\Repository {

	/**
	 * Finds ipn order with the specifier txn id
	 *
	 * @param string $txn_id The txn id to search
	 * @return \Payment\Paypal\Domain\Model\IpnOrder The ipn order
	 */
	public function findBillByTxnId($txn_id) {
		$query = $this->createQuery();
		$ipnOrder = $query->matching(
					$query->equals('txnId', $txn_id)
				);					
		return $ipnOrder->execute()->getFirst();
	}
	
}
?>