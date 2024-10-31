<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Paypal extends CI_Controller{

  	public function  __construct(){
        parent::__construct();
	    $this->load->library('paypal_lib'); // Assuming 'paypal_lib' is the correct library name
        $this->paypal_lib = new Paypal_lib();
	}
	
    public function index($planId){
		$currency_sym = array( 
			'AED' => 'د.إ',  
			'AFN' => '؋',  
			'ALL' => 'L',  
			'AMD' => 'AMD',  
			'ANG' => 'ƒ',  
			'AOA' => 'Kz',  
			'ARS' => '$',  
			'AUD' => '$',  
			'AWG' => 'ƒ',  
			'AZN' => 'AZN',  
			'BAM' => 'KM',  
			'BBD' => '$',  
			'BDT' => '৳ ',  
			'BGN' => 'лв.',  
			'BHD' => '.د.ب',  
			'BIF' => 'Fr',  
			'BMD' => '$',  
			'BND' => '$',  
			'BOB' => 'Bs.',  
			'BRL' => 'R$',  
			'BSD' => '$',  
			'BTC' => '฿',  
			'BTN' => 'Nu.',  
			'BWP' => 'P',  
			'BYR' => 'Br',  
			'BZD' => '$',  
			'CAD' => '$',  
			'CDF' => 'Fr',  
			'CHF' => 'CHF',  
			'CLP' => '$',  
			'CNY' => '¥',  
			'COP' => '$',  
			'CRC' => '₡',  
			'CUC' => '$',  
			'CUP' => '$',  
			'CVE' => '$',  
			'CZK' => 'Kč',  
			'DJF' => 'Fr',  
			'DKK' => 'DKK',  
			'DOP' => 'RD$',  
			'DZD' => 'د.ج',  
			'EGP' => 'EGP',  
			'ERN' => 'Nfk',  
			'ETB' => 'Br',  
			'EUR' => '€',  
			'FJD' => '$',  
			'FKP' => '£',  
			'GBP' => '£',  
			'GEL' => 'ლ',  
			'GGP' => '£',  
			'GHS' => '₵',  
			'GIP' => '£',  
			'GMD' => 'D',  
			'GNF' => 'Fr',  
			'GTQ' => 'Q',  
			'GYD' => '$',  
			'HKD' => '$',  
			'HNL' => 'L',  
			'HRK' => 'Kn',  
			'HTG' => 'G',  
			'HUF' => 'Ft',  
			'IDR' => 'Rp',  
			'ILS' => '₪',  
			'IMP' => '£',  
			'INR' => '₹',  
			'IQD' => 'ع.د',  
			'IRR' => '﷼',  
			'IRT' => 'تومان',  
			'ISK' => 'kr.',  
			'JEP' => '£',  
			'JMD' => '$',  
			'JOD' => 'د.ا',  
			'JPY' => '¥',  
			'KES' => 'KSh',  
			'KGS' => 'сом',  
			'KHR' => '៛',  
			'KMF' => 'Fr',  
			'KPW' => '₩',  
			'KRW' => '₩',  
			'KWD' => 'د.ك',  
			'KYD' => '$',  
			'KZT' => 'KZT',  
			'LAK' => '₭',  
			'LBP' => 'ل.ل',  
			'LKR' => 'රු',  
			'LRD' => '$',  
			'LSL' => 'L',  
			'LYD' => 'ل.د',  
			'MAD' => 'د.م.',  
			'MDL' => 'MDL',  
			'MGA' => 'Ar',  
			'MKD' => 'ден',  
			'MMK' => 'Ks',  
			'MNT' => '₮',  
			'MOP' => 'P',  
			'MRO' => 'UM',  
			'MUR' => '₨',  
			'MVR' => '.ރ',  
			'MWK' => 'MK',  
			'MXN' => '$',  
			'MYR' => 'RM',  
			'MZN' => 'MT',  
			'NAD' => '$',  
			'NGN' => '₦',  
			'NIO' => 'C$',  
			'NOK' => 'kr',  
			'NPR' => '₨',  
			'NZD' => '$',  
			'OMR' => 'ر.ع.',  
			'PAB' => 'B/.',  
			'PEN' => 'S/.',  
			'PGK' => 'K',  
			'PHP' => '₱',  
			'PKR' => '₨',  
			'PLN' => 'zł',  
			'PRB' => 'р.',  
			'PYG' => '₲',  
			'QAR' => 'ر.ق',  
			'RMB' => '¥',  
			'RON' => 'lei',  
			'RSD' => 'дин.',  
			'RUB' => '₽',  
			'RWF' => 'Fr',  
			'SAR' => 'ر.س',  
			'SBD' => '$',  
			'SCR' => '₨',  
			'SDG' => 'ج.س.',  
			'SEK' => 'kr',  
			'SGD' => '$',  
			'SHP' => '£',  
			'SLL' => 'Le',  
			'SOS' => 'Sh',  
			'SRD' => '$',  
			'SSP' => '£',  
			'STD' => 'Db',  
			'SYP' => 'ل.س',  
			'SZL' => 'L',  
			'THB' => '฿',  
			'TJS' => 'ЅМ',  
			'TMT' => 'm',  
			'TND' => 'د.ت',  
			'TOP' => 'T$',  
			'TRY' => '₺',  
			'TTD' => '$',  
			'TWD' => 'NT$',  
			'TZS' => 'Sh',  
			'UAH' => '₴',  
			'UGX' => 'UGX',  
			'USD' => '$',  
			'UYU' => '$',  
			'UZS' => 'UZS',  
			'VEF' => 'Bs F',  
			'VND' => '₫',  
			'VUV' => 'Vt',  
			'WST' => 'T',  
			'XAF' => 'Fr',  
			'XCD' => '$',  
			'XOF' => 'Fr',  
			'XPF' => 'Fr',  
			'YER' => '﷼',  
			'ZAR' => 'R',  
			'ZMW' => 'ZK',  
		   );
		$plandetail = $this->Common_DML->get_data('plans', array('pl_id'=>$planId));
		$data['access'] = !empty(html_escape($this->paypal_lib->PayPalAcceess()))?html_escape($this->paypal_lib->PayPalAcceess()):'';
		
        $data['plandetail'] = $plandetail;
		$data['currency_sym'] = $currency_sym;
        $this->load->view('payment-gatway/paypal/paypal', $data); 
    } 

    public function success(){
        
        $paypalInfo = $this->input->post();
		$paypal_data = json_encode($paypalInfo);

		$paypalInfo = $this->input->post();

	    $data['item_name']= isset($paypalInfo['item_name'])?$paypalInfo['item_name']:'';
		$data['item_number']= isset($paypalInfo['item_number'])?$paypalInfo['item_number']:'';
		$data['txn_id'] = isset($paypalInfo["txn_id"])?$paypalInfo["txn_id"]:'';
		$data['payment_amt'] = isset($paypalInfo["amount"])?$paypalInfo["amount"]:'';
		$data['currency_code'] = isset($paypalInfo["currency_code"])?$paypalInfo["currency_code"]:'';
		$data['custom_id'] = isset($paypalInfo["custom_id"])?$paypalInfo["custom_id"]:'';
		$data['status'] = isset($paypalInfo["payment_status"])?$paypalInfo["payment_status"]:'';
	
	   //echo json_encode( array( 'status' => 1, 'msg' => html_escape($this->lang->line('ltr_auth_create_subscription_msg1'))) );	
	   $data['price'] = isset($paypalInfo["amount"])?$paypalInfo["amount"]:'';
	   $this->session->set_flashdata('price', $data['price']);  
	   redirect('authentication/thankyou');
	}
	public function cancel(){
		// Load payment failed view
		$this->load->view('paypal/cancel');
	}
	public function pay(){
	    // Set variables for paypal form
		$returnURL = base_url().'paypal/success'; //payment success url
		$cancelURL = base_url().'paypal/cancel'; //payment cancel url
		$notifyURL = base_url().'paypal/ipn'; //ipn url
	   // Get product data from the database
	    $planId = $this->input->post('planid'); 
		$plandetail = $this->Common_DML->get_data('plans', array('pl_id'=>base64_decode($planId)));
		$product_name = $product_id = $price = $currency = 0;
		if(!empty($plandetail)):
			$product_name = $plandetail[0]['pl_name'];
			$product_id = $plandetail[0]['pl_id'];
			$price = $plandetail[0]['pl_price'];
			$currency = $plandetail[0]['pl_currency'];
		endif;
     	$coupon_code = $this->input->post('coupon_code');
		if(!empty($coupon_code)):
			$where = array('coupon_code' => $coupon_code); 
			$result = $this->Common_DML->get_data('coupon_code', $where);
			if(!empty($result)){
				if($result[0]['discount_set'] == 'percentage'){
					$discount_amout = $result[0]['discount_per_price'];
					$dis_price = $price * ($discount_amout/100);
					if($price > $dis_price){
				 	    $price = $price - $dis_price;
					}
				}else{
					$discount_amout = $result[0]['discount_per_price'];
					if($price > $discount_amout){
					   $price = $price - $discount_amout;
					}
				}
		   }
		endif;
        $user_name = $this->input->post('username');
		$email = $this->input->post('useremail');
		$user_password = $this->input->post('userpassword');
		$array = array(
			'name' => $user_name,
			'email' => $email,
			'password' => md5($user_password),
			'access_level' => '5',
			'status' => 1,
			'datetime' => date('Y-m-d H:i:s')
		   );
		$where = array( 'email' => $email );
		$result = $this->Common_DML->get_data( 'users', $where, 'COUNT(*) As total' );
		$result_id = $this->Common_DML->get_data( 'users', $where);
		if(!empty($result) && $result[0]['total'] == 0){
			$insert_id = $this->Common_DML->put_data( 'users', $array );
			$folder = 'user_'.$insert_id;
			if (!is_dir('uploads/'.$folder)) {
				mkdir('./uploads/' . $folder, 0777, TRUE);
				mkdir('./uploads/' . $folder . '/campaigns', 0777, TRUE);
				mkdir('./uploads/' . $folder . '/images', 0777, TRUE);
				mkdir('./uploads/' . $folder . '/templates', 0777, TRUE);
			}
		}else{	
			$where = array('email' =>$email);
			$this->Common_DML->set_data( 'users', $array, $where );
			$insert_id = $result_id[0]['id'];
		} 
        // Get current user ID from the session
        // Add fields to PayPal form
        
       	$this->paypal_lib->add_field('return', $returnURL);
		$this->paypal_lib->add_field('cancel_return', $cancelURL);
		$this->paypal_lib->add_field('notify_url', $notifyURL);
		$this->paypal_lib->add_field('item_name', $product_name);
		$this->paypal_lib->add_field('custom', $insert_id);
		$this->paypal_lib->add_field('item_number', $product_id);
		$this->paypal_lib->add_field('amount', $price);
		$this->paypal_lib->add_field('username', $user_name);
		$this->paypal_lib->add_field('password', $user_password);
		$this->paypal_lib->add_field('currency_code', $currency);
		// Render paypal form
		$this->paypal_lib->paypal_auto_form();
		
		/**
		 * Send Email Data
		 */
		$subject = $user_name.' credentials info';
		$str = "Username : ".$email.", Password : ".$user_password;
		if($email){
			$link = base_url();
			$mail = array(
				"email" => $email,
				"name" => $user_name,
			);
			$template_name = 'media-access';
			$var = '[
				{
				"name": "USERNAME",
				"content": "'.$user_name.'"
				},
				{
				"name": "EMAIL",
				"content": "'.$email.'"
				},
				{
				"name": "PASSWORD",
				"content": "'.$user_password.'"
				}
			]';

			$where = array('data_key' =>'smtp_settings_data');
			$result_smpt_settings = $this->Common_DML->get_data( 'theme_setting', $where);
			$data_smpt = '';
			if(!empty($result_smpt_settings[0]['data_value'])){
			  $data_smpt = $result_smpt_settings[0]['data_value'];
			}
			$data['email_for'] = 'new_user';
			$data['password'] = $user_password;
			$data['USERNAME'] = $user_name;
			$data['email'] = $email;
            $mresult = sendmailTemplate($template_name, $mail, $var,$data,$data_smpt);
          } 
	}
	 
    /**
	 * Paypal IPN 
	 */ 
	public function ipn(){
	    $paypalInfo = $this->input->post();
    	if(!empty($paypalInfo)){
	      $ipnCheck = $this->paypal_lib->validate_ipn($paypalInfo);
	      if($ipnCheck){
        	  $plan_id = $paypalInfo['item_number'];
        	  $plandetail = $this->Common_DML->get_data('plans', array('pl_id'=>$plan_id));
        	  $planInterval = $plandetail[0]['interval'];
        	  $current_time = date("Y-m-d H:i:s",time());	
    		  $future_timestamp = date('Y-m-d H:i:s', strtotime($current_time. ' + '.$planInterval.' days'));	
        	  $subscripData = array( 
				'user_id' => $paypalInfo['custom'],
				'plan_id' => $paypalInfo['item_number'],
				'stripe_customer_id' => $paypalInfo['payer_id'],
				'stripe_subscription_id' => $paypalInfo['txn_id'],
				'payment_method' => 'Paypal',
				'plan_amount' => $paypalInfo['mc_gross'],
				'plan_amount_currency' => $paypalInfo['mc_currency'],
				'plan_interval' => $planInterval,
				'plan_interval_count' => 1,
				'plan_period_start' => $current_time,
				'plan_period_end' => $future_timestamp,
				'payer_email' => $paypalInfo['payer_email'],
				'created' => date('Y-m-d H:i:s'),
				'status' => $paypalInfo['payment_status'],
				'all_data' =>json_encode($paypalInfo)
				); 
        	 $subscription_id = $this->Common_DML->put_data('user_subscriptions', $subscripData);

			 if($subscription_id){ 
				$data = array('subscription_id' => $subscription_id); 
				$where = array('id' =>$insert_id);
				$this->Common_DML->set_data( 'users', $data, $where );
			} 
	      }
	  }
    	  
    }
}