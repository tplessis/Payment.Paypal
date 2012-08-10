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
 * An IPN order item
 *
 * @FLOW3\Entity
 */
class IpnOrderItem {
	/**
	 * The ipn order linked
	 * @var \Payment\Paypal\Domain\Model\IpnOrder
	 * @ORM\ManyToOne(inversedBy="ipnOrderItems")
	 */
	protected $ipnOrder;
	
 	/**
	 * @var integer
	 * @ORM\Column(name="order_id", type="integer", nullable=true)
	 */
	protected $orderId;

	/**
	* @var string
	* @ORM\Column(name="item_name", type="string", length=127, nullable=true)
	*/
	protected $itemName;

	/**
	* @var string
	* @ORM\Column(name="item_number", type="string", length=127, nullable=true)
	*/
	protected $itemNumber;

	/**
	* @var string
	* @ORM\Column(name="quantity", type="string", length=127, nullable=true)
	*/
	protected $quantity;

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
	* @ORM\Column(name="tax", type="decimal", scale=2, nullable=true)
	*/
	protected $tax;

	/**
	* @var float
	* @ORM\Column(name="cost_per_item", type="decimal", scale=2, nullable=true)
	*/
	protected $costPerItem;

	/**
	* @var string
	* @ORM\Column(name="option_name_1", type="string", length=64, nullable=true)
	*/
	protected $optionName1;

	/**
	* @var string
	* @ORM\Column(name="option_selection_1", type="string", length=200, nullable=true)
	*/
	protected $optionSelection1;

	/**
	* @var string
	* @ORM\Column(name="option_name_2", type="string", length=64, nullable=true)
	*/
	protected $optionName2;

	/**
	* @var string
	* @ORM\Column(name="option_selection_2", type="string", length=200, nullable=true)
	*/
	protected $optionSelection2;

	/**
	* @var string
	* @ORM\Column(name="option_name_3", type="string", length=64, nullable=true)
	*/
	protected $optionName3;

	/**
	* @var string
	* @ORM\Column(name="option_selection_3", type="string", length=200, nullable=true)
	*/
	protected $optionSelection3;

	/**
	* @var string
	* @ORM\Column(name="option_name_4", type="string", length=64, nullable=true)
	*/
	protected $optionName4;

	/**
	* @var string
	* @ORM\Column(name="option_selection_4", type="string", length=200, nullable=true)
	*/
	protected $optionSelection4;

	/**
	* @var string
	* @ORM\Column(name="option_name_5", type="string", length=64, nullable=true)
	*/
	protected $optionName5;

	/**
	* @var string
	* @ORM\Column(name="option_selection_5", type="string", length=200, nullable=true)
	*/
	protected $optionSelection5;

	/**
	* @var string
	* @ORM\Column(name="option_name_6", type="string", length=64, nullable=true)
	*/
	protected $optionName6;

	/**
	* @var string
	* @ORM\Column(name="option_selection_6", type="string", length=200, nullable=true)
	*/
	protected $optionSelection6;

	/**
	* @var string
	* @ORM\Column(name="option_name_7", type="string", length=64, nullable=true)
	*/
	protected $optionName7;

	/**
	* @var string
	* @ORM\Column(name="option_selection_7", type="string", length=200, nullable=true)
	*/
	protected $optionSelection7;

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
	* Set orderId
	*
	* @param integer $orderId
	*/
	public function setOrderId($orderId)
	{
	$this->orderId = intval($orderId);
	}

	/**
	* Get orderId
	*
	* @return integer
	*/
	public function getOrderId()
	{
	return $this->orderId;
	}

	/**
	* Set itemName
	*
	* @param string $itemName
	*/
	public function setItemName($itemName)
	{
	$this->itemName = $itemName;
	}

	/**
	* Get itemName
	*
	* @return string
	*/
	public function getItemName()
	{
	return $this->itemName;
	}

	/**
	* Set itemNumber
	*
	* @param string $itemNumber
	*/
	public function setItemNumber($itemNumber)
	{
	$this->itemNumber = $itemNumber;
	}

	/**
	* Get itemNumber
	*
	* @return string
	*/
	public function getItemNumber()
	{
	return $this->itemNumber;
	}

	/**
	* Set quantity
	*
	* @param string $quantity
	*/
	public function setQuantity($quantity)
	{
	$this->quantity = $quantity;
	}

	/**
	* Get quantity
	*
	* @return string
	*/
	public function getQuantity()
	{
	return $this->quantity;
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
	* Set costPerItem
	*
	* @param float $costPerItem
	*/
	public function setCostPerItem($costPerItem)
	{
	$this->costPerItem = floatval($costPerItem);
	}

	/**
	* Get costPerItem
	*
	* @return float
	*/
	public function getCostPerItem()
	{
	return $this->costPerItem;
	}

	/**
	* Set optionName1
	*
	* @param string $optionName1
	*/
	public function setOptionName1($optionName1)
	{
	$this->optionName1 = $optionName1;
	}

	/**
	* Get optionName1
	*
	* @return string
	*/
	public function getOptionName1()
	{
	return $this->optionName1;
	}

	/**
	* Set optionSelection1
	*
	* @param string $optionSelection1
	*/
	public function setOptionSelection1($optionSelection1)
	{
	$this->optionSelection1 = $optionSelection1;
	}

	/**
	* Get optionSelection1
	*
	* @return string
	*/
	public function getOptionSelection1()
	{
	return $this->optionSelection1;
	}

	/**
	* Set optionName2
	*
	* @param string $optionName2
	*/
	public function setOptionName2($optionName2)
	{
	$this->optionName2 = $optionName2;
	}

	/**
	* Get optionName2
	*
	* @return string
	*/
	public function getOptionName2()
	{
	return $this->optionName2;
	}

	/**
	* Set optionSelection2
	*
	* @param string $optionSelection2
	*/
	public function setOptionSelection2($optionSelection2)
	{
	$this->optionSelection2 = $optionSelection2;
	}

	/**
	* Get optionSelection2
	*
	* @return string
	*/
	public function getOptionSelection2()
	{
	return $this->optionSelection2;
	}

	/**
	* Set optionName3
	*
	* @param string $optionName3
	*/
	public function setOptionName3($optionName3)
	{
	$this->optionName3 = $optionName3;
	}

	/**
	* Get optionName3
	*
	* @return string
	*/
	public function getOptionName3()
	{
	return $this->optionName3;
	}

	/**
	* Set optionSelection3
	*
	* @param string $optionSelection3
	*/
	public function setOptionSelection3($optionSelection3)
	{
	$this->optionSelection3 = $optionSelection3;
	}

	/**
	* Get optionSelection3
	*
	* @return string
	*/
	public function getOptionSelection3()
	{
	return $this->optionSelection3;
	}

	/**
	* Set optionName4
	*
	* @param string $optionName4
	*/
	public function setOptionName4($optionName4)
	{
	$this->optionName4 = $optionName4;
	}

	/**
	* Get optionName4
	*
	* @return string
	*/
	public function getOptionName4()
	{
	return $this->optionName4;
	}

	/**
	* Set optionSelection4
	*
	* @param string $optionSelection4
	*/
	public function setOptionSelection4($optionSelection4)
	{
	$this->optionSelection4 = $optionSelection4;
	}

	/**
	* Get optionSelection4
	*
	* @return string
	*/
	public function getOptionSelection4()
	{
	return $this->optionSelection4;
	}

	/**
	* Set optionName5
	*
	* @param string $optionName5
	*/
	public function setOptionName5($optionName5)
	{
	$this->optionName5 = $optionName5;
	}

	/**
	* Get optionName5
	*
	* @return string
	*/
	public function getOptionName5()
	{
	return $this->optionName5;
	}

	/**
	* Set optionSelection5
	*
	* @param string $optionSelection5
	*/
	public function setOptionSelection5($optionSelection5)
	{
	$this->optionSelection5 = $optionSelection5;
	}

	/**
	* Get optionSelection5
	*
	* @return string
	*/
	public function getOptionSelection5()
	{
	return $this->optionSelection5;
	}

	/**
	* Set optionName6
	*
	* @param string $optionName6
	*/
	public function setOptionName6($optionName6)
	{
	$this->optionName6 = $optionName6;
	}

	/**
	* Get optionName6
	*
	* @return string
	*/
	public function getOptionName6()
	{
	return $this->optionName6;
	}

	/**
	* Set optionSelection6
	*
	* @param string $optionSelection6
	*/
	public function setOptionSelection6($optionSelection6)
	{
	$this->optionSelection6 = $optionSelection6;
	}

	/**
	* Get optionSelection6
	*
	* @return string
	*/
	public function getOptionSelection6()
	{
	return $this->optionSelection6;
	}

	/**
	* Set optionName7
	*
	* @param string $optionName7
	*/
	public function setOptionName7($optionName7)
	{
	$this->optionName7 = $optionName7;
	}

	/**
	* Get optionName7
	*
	* @return string
	*/
	public function getOptionName7()
	{
	return $this->optionName7;
	}

	/**
	* Set optionSelection7
	*
	* @param string $optionSelection7
	*/
	public function setOptionSelection7($optionSelection7)
	{
	$this->optionSelection7 = $optionSelection7;
	}

	/**
	* Get optionSelection7
	*
	* @return string
	*/
	public function getOptionSelection7()
	{
	return $this->optionSelection7;
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
	 * Get the ipn order
	 *
	 * @return \Payment\Paypal\Domain\Model\IpnOrder The IPN order
	 */
	public function getIpnOrder() {
		return $this->ipnOrder;
	}

	/**
	 * Sets this ipn order
	 *
	 * @param \Payment\Paypal\Domain\Model\IpnOrder The IPN order
	 * @return void
	 */
	public function setIpnOrder(\Payment\Paypal\Domain\Model\IpnOrder $ipnOrder) {
		$this->ipnOrder = $ipnOrder;
	}
}
?>