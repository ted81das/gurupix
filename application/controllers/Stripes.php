<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stripes extends CI_Controller {
    private $g_userID;
    public function __construct() {
        parent::__construct();
        $this->load->library('Stripe');
		// Set your Stripe API keys
        
    }
    /**
     * Stripe Payment Form
     */
    public function index($planId) {
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
		$data['access'] = !empty(html_escape($this->stripe->stripeAcceess()))?html_escape($this->stripe->stripeAcceess()):'';
	
        $data['plandetail'] = $plandetail;
		$data['currency_sym'] = $currency_sym;
        $this->load->view('payment-gatway/stripe/stripe_form',$data);
    }
    /**
     * Process Payment
     */
    public function process_payment() {
		$access = !empty(html_escape($this->stripe->stripeAcceess()))?html_escape($this->stripe->stripeAcceess()):'';
		$token = json_decode(file_get_contents('php://input'),true);
        $data['metaDescription'] = html_escape($this->lang->line('ltr_auth_create_subscription_metaDescription'));
        $data['metaKeywords'] = html_escape($this->lang->line('ltr_auth_create_subscription_metaKeywords'));
        $data['title'] = html_escape($this->lang->line('ltr_auth_create_subscription_title'));
        $data['breadcrumbs'] = array('apppixaguru' => '#');		
		
        \Stripe\Stripe::setApiKey($access['SecretKey']);
		// $token  = $this->input->post('stripeToken'); $token[]
		$plandetail = $this->Common_DML->get_data('plans', array('pl_id'=>base64_decode( $token['planid'])))[0];
		
		$user_name  = $token['name'];
		$user_password  = md5($token['userpassword']);
		$$_POST['useremail']  = $token['email']; 
        $email  = $token['email']; 
        $plan_name  = $plandetail['pl_name'];
		$plan_id  = (base64_decode( $token['planid'])); 
        $interval  = $plandetail['interval'];
        $price  = $plandetail['pl_price'];
        $currency  = $plandetail['pl_currency'];

		$coupon_code = $token['coupon_code'];
			
		if(!empty($coupon_code)):
			$where = array('coupon_code' => $coupon_code); 
			$result = $this->Common_DML->get_data('coupon_code', $where);
			
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
		endif;
        $time = time();
        $plan = \Stripe\Plan::create(array( 
            "product" => [
                "name" => $plan_name,
                "type" => "service"
            ],
            "nickname" => $plan_name,
            "interval" => $plandetail['interval_count'],
            "interval_count" => "1",
            "currency" => $currency,
            "amount" => ($price*100) ,
        ));
	
        $customer = \Stripe\Customer::create([
            'email' => $email,
            'source'  => $token['token']['id'],
        ]);
	
        $subscription = \Stripe\Subscription::create(array(
            "customer" => $customer->id,
            "items" => array(
                array(
                    "plan" => $plan->id,
                  ),
            ),
        ));  
	
		if($subscription->id){
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

            if($insert_id){
                
				if($subscription){ 
						// Check whether the subscription activation is successful 
						//if($subscription->status == 'active'){ 
							// Subscription info 
						$subscrID = $subscription->id; 
						$custID = $subscription->customer; 
						$planID = $subscription->plan->id; 
						$planAmount = ($subscription->plan->amount/100); 
						$planCurrency = $subscription->plan->currency; 
						$P_interval = $subscription->plan->interval; 
						if($P_interval=="year"){
							$planInterval = 365;	
						}else if($P_interval=="month"){
							$planInterval = 31;	
						}else if($P_interval=="week"){
							$planInterval = 7;	
						}
						$planIntervalCount = $subscription->plan->interval_count; 
						$created = date("Y-m-d H:i:s", $subscription->created); 
						$current_period_start = date("Y-m-d H:i:s", $subscription->current_period_start); 
						// $created = date("Y-m-d H:i:s"); 
						$current_period_start = date("Y-m-d H:i:s"); 
						$current_time = date("Y-m-d H:i:s",time());	
						$future_timestamp = date('Y-m-d H:i:s', strtotime($current_time. ' + '.$planInterval.' days')); 										
						$current_period_end = $future_timestamp; 
						//$current_period_end = date("Y-m-d H:i:s", $subscription->current_period_end); 
						$status = $subscription->status; 
						 
						// Insert tansaction data into the database 
						$subscripData = array( 
							'user_id' => $insert_id, 
							'plan_id' => $plan_id, 
							'stripe_subscription_id' => $subscrID, 
							'stripe_customer_id' => $custID, 
							'stripe_plan_id' => $planID, 
							'plan_amount' => $planAmount, 
							'plan_amount_currency' => $planCurrency, 
							'plan_interval' => $P_interval, 
							'plan_interval_count' => $planIntervalCount, 
							'plan_period_start' => $current_period_start, 
							'plan_period_end' => $current_period_end, 
							'payer_email' => $email, 
							'created' => $created, 
							'status' => $status 
						   ); 
						$subscription_id = $this->Common_DML->put_data('user_subscriptions', $subscripData);
						// Update subscription id in the users table  
						if($subscription_id && !empty($insert_id)){ 
							$data = array('subscription_id' => $subscription_id); 
							$where = array('id' =>$insert_id);
							$this->Common_DML->set_data( 'users', $data, $where );
						} 
					//}
				} 
                    
				/**
				 * Send Email Data
				 */
                $subject = $user_name.' credentials info';
				$str = "Username : ".$email.", Password : ".$user_password;
				if($$_POST['useremail']){
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

					//$mail_result = sendmailTemplate( $template_name, $mail, $var );		
					
				}
				$this->session->set_flashdata('price', $price);  
				echo json_encode( array( 'status' => 1, 'data'=> $subscription, 'msg' => html_escape($this->lang->line('ltr_auth_create_subscription_msg1')),'url'=>'authentication/thankyou') );	
			   
		    }
	    }
    }
    /**
     * Return Url 
     */
    public function return_url($planid=""){
		$plandetail = $this->Common_DML->get_data('plans', array('pl_id'=>base64_decode($_GET['orderId'])))[0];		
		
		$data['metaDescription'] = html_escape($this->lang->line('ltr_auth_create_subscription_metaDescription'));
        $data['metaKeywords'] = html_escape($this->lang->line('ltr_auth_create_subscription_metaKeywords'));
        $data['title'] = html_escape($this->lang->line('ltr_auth_create_subscription_title'));
        $data['breadcrumbs'] = array('apppixaguru' => '#');
        $data['price'] =  $plandetail['pl_price'];		
        $data['cur'] =  $this->currency_sym($plandetail['pl_currency']);		
       $this->load->view('thankyou',$data);
    }
    /**
     * Cancel Url
     */
    public function cancel_url(){

        echo "This is Cancel Url";
    }
	function currency_sym($cur=""){
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
		$data['currency_sym'] ="";
		foreach ($currency_sym as $key => $value) {
			if($cur==$key){
				$data['currency_sym'] .= $value;
			}
		}
		return $data['currency_sym'];
	}
	
	public function freePlan($planId){
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
		$data['access'] = !empty(html_escape($this->stripe->stripeAcceess()))?html_escape($this->stripe->stripeAcceess()):'';
		$data['baseURL'] = base_url();
        $data['plandetail'] = $plandetail;
		$data['currency_sym'] = $currency_sym;
        $this->load->view('freePlan',$data);
	}
	 /**
	 * Create Plan
	 */
	public function create_subscription_plan(){		
		$plan_id  = (base64_decode( $_POST['planid'])); 
		$plandetail = $this->Common_DML->get_data('plans', array('pl_id'=>$plan_id ))[0];
		
		$array = array(
			'name' => $_POST['username'],
			'email' =>  $_POST['useremail'],
			'password' => md5( $_POST['userpassword']),			
			'status' => 1,
			'access_level' => $plandetail['pl_id'],
			'datetime' => date('Y-m-d H:i:s')
		   );
		$where = array( 'email' =>$_POST['useremail'] );
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
			$where = array('email' =>$_POST['useremail']);
			$this->Common_DML->set_data( 'users', $array, $where );
			$insert_id = $result_id[0]['id'];
		} 

		if($insert_id){
			
			$P_interval = $plandetail['interval_count']; 
			if($P_interval=="year"){
				$planInterval = 365;	
			}else if($P_interval=="month"){
				$planInterval = 31;	
			}else if($P_interval=="week"){
				$planInterval = 7;	
			}
			
			$created = date("Y-m-d H:i:s");			
			
			$current_period_start = date("Y-m-d H:i:s"); 
			$current_time = date("Y-m-d H:i:s",time());	
			$future_timestamp = date('Y-m-d H:i:s', strtotime($current_time. ' + '.$planInterval.' days')); 										
			$current_period_end = $future_timestamp; 
			
			$status = 'success'; 
				
			// Insert tansaction data into the database 
			$subscripData = array( 
				'user_id' => $insert_id, 
				'plan_id' => $plan_id, 
				'stripe_subscription_id' =>'free_'.getRandomNumber(12), 
				'stripe_customer_id' => 'free_'.getRandomNumber(14),
				'stripe_plan_id' => 'free_'.getRandomNumber(10), 
				'plan_amount' => 0, 
				'plan_amount_currency' => $plandetail['pl_currency'], 
				'plan_interval' =>$plandetail['interval_count'], 
				'plan_interval_count' => 1, 
				'plan_period_start' => $current_period_start, 
				'plan_period_end' => $current_period_end, 
				'payer_email' => $_POST['useremail'], 
				'created' => $created, 
				'payment_method' => 'TrialPeriod', 
				'status' => $status 
				); 
				
			$subscription_id = $this->Common_DML->put_data('user_subscriptions', $subscripData);
		 
			if($subscription_id && !empty($insert_id)){ 
				$data = array('subscription_id' => $subscription_id); 
				$where = array('id' =>$insert_id);
				$this->Common_DML->set_data( 'users', $data, $where );
			} 
			/**
			 * Send Email Data
			 */
			$subject =$_POST['username'].' credentials info';
			$str = "Username : ".$_POST['useremail'].", Password : ".$_POST['userpassword'];
			if($_POST['useremail']){
				$link = base_url();
				$mail = array(
					"email" => $_POST['useremail'],
					"name" => $_POST['username'],
				);
				$template_name = 'media-access';
				$var = '[
					{
					"name": "USERNAME",
					"content": "'.$_POST['username'].'"
					},
					{
					"name": "EMAIL",
					"content": "'.$_POST['useremail'].'"
					},
					{
					"name": "PASSWORD",
					"content": "'.$_POST['userpassword'].'"
					}
				]';

				$where = array('data_key' =>'smtp_settings_data');
				$result_smpt_settings = $this->Common_DML->get_data( 'theme_setting', $where);
				$data_smpt = '';
				if(!empty($result_smpt_settings[0]['data_value'])){
				  $data_smpt = $result_smpt_settings[0]['data_value'];
				}
				$data['email_for'] = 'new_user';
				$data['password'] = $_POST['userpassword'];
				$data['USERNAME'] =$_POST['username'];
				$data['email'] = $_POST['username'];
				$mresult = sendmailTemplate($template_name, $mail, $var,$data,$data_smpt);			
				
			}
			$this->session->set_flashdata('price', 0);  
			echo json_encode( array( 'status' => 1, 'msg' => html_escape($this->lang->line('ltr_auth_create_subscription_msg1')),'url'=>'authentication/thankyou') );	
		   
		}
	}
}  