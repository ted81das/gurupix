<?php 
/* * ***
 * Version: 1.0.0
 *
 * Description of Stripe Payment Gateway Library
 *
 * @package: CodeIgniter
 * @category: Libraries
 * @author TechArise Team
 * @email  info@techarise.com
 *
 * *** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Stripe{ 
   
    public $CI;
    public $PublicKey = '';
    public $SecretKey = '';  
    function __construct(){ 
        $this->CI = get_instance();
        $this->CI->load->model('Common_DML');

        require APPPATH .'third_party/stripe/stripe-php/init.php'; 
       
    }    
    function stripeAcceess(){       
        $where = array('data_key' =>'paymentSetting');
        $paymentSetting = $this->CI->Common_DML->get_data( 'theme_setting', $where);
		$paymentSetting = isset($paymentSetting) && !empty($paymentSetting[0]['data_value']) ? json_decode($paymentSetting[0]['data_value'],true): array(); 

        $data['PublicKey'] = !empty($paymentSetting) ? $paymentSetting['stripe_publishKey'] : '';
        $data['SecretKey'] = !empty($paymentSetting) ? $paymentSetting['strpe_secret_key'] : '';      
        return $data;
    } 
}