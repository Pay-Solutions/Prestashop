<?php

class thaiepay extends PaymentModule  //this declares the class and specifies it will extend the standard payment module
{
   
    private $_html = '';
    private $_postErrors = array();
   
    function __construct()
    {
        $this->name = 'thaiepay';
        $this->tab = 'payments_gateways';
        $this->version = 1;

        parent::__construct(); // The parent construct is required for translations

        $this->page = basename(__FILE__, '.php');
        $this->displayName = $this->l('ThaiEPay Payments Module');
        $this->description = $this->l('ePayment System');
	}

	public function install()
	{
		if (!parent::install()
		OR !$this->createPaymentcardtbl() //calls function to create payment card table
					OR !$this->registerHook('invoice')
		OR !$this->registerHook('payment')
		OR !$this->registerHook('paymentReturn'))
		return false;
		return true;
	}

	function createPaymentcardtbl()
	{
		$db = Db::getInstance();
		$query = "CREATE TABLE `"._DB_PREFIX_."order_thaiepay` (
	`id_payment` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	`id_order` INT NOT NULL ,
	`cardholdername` TEXT NOT NULL ,
	`cardnumber` TEXT NOT NULL
	) ENGINE = MYISAM ";   
		$db->Execute($query);
		return true;
	}

	/**
	* hookPayment($params)
	* Called in Front Office at Payment Screen - displays user this module as payment option
	*/
	function hookPayment($params)
	{
		global $smarty;
		
		$merchantid = "25504443"; // Edit Your Merchant ID
		$customeremail = "youremail@email.com";
		$productdetail = "Payment Method From Prestashop Order No.".$params['cart']->id ;
		$currency = "00";
		$refno = intval($params['cart']->id);		
		$urlAction = "https://www.thaiepay.com/epaylink/payment.aspx";
		
		$total = floatval(number_format($params['cart']->getOrderTotal(true, 3), 2, '.', ''));

		$smarty->assign(array(
				'this_path' => $this->_path,
				'this_path_ssl' => Configuration::get('PS_FO_PROTOCOL').$_SERVER['HTTP_HOST'].__PS_BASE_URI__."modules/{$this->name}/",
				'total' => $total ,
				'urlAction' => $urlAction,
				'merchantid' => $merchantid ,
				'customeremail' => $customeremail , 
				'productdetail' => $productdetail ,
				'cc' => $currency ,
				'refno' => $refno		
		));

		return $this->display(__FILE__, 'thaiepay.tpl');
	}

}
?>