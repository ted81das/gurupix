<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Theme_setting extends CI_Controller {
    private $g_userID;
    function __construct() {
		parent::__construct();
		if(!$this->session->userdata('admin_member_login')){
			redirect('authentication', 'refresh');
		}
		$this->g_userID = $this->session->userdata( 'user_id' );
        $where = array('user_id'=>$this->g_userID,'data_key' =>'language');
        $language = $this->Common_DML->get_data( 'theme_setting', $where);		
		$lang = isset($language[0]['data_value'])&&!empty($language[0]['data_value'])?$language[0]['data_value']:'';	
		languageLoad($lang);
      
	}
    /**
     * Theme Setting
     */
    public function theme_setting_option(){
        $data = $header = array();
		$userID = $this->session->userdata( 'user_id' );

        $where = array('user_id'=>$userID,'data_key' =>'pg_logo_image');
        $result_logo = $this->Common_DML->get_data( 'theme_setting', $where);
        $data['logo_images'] =$result_logo; 

        $where = array('user_id'=>$userID,'data_key' =>'pg_favicon_image');
        $result_favicon = $this->Common_DML->get_data( 'theme_setting', $where);
        $data['favicon_images'] =$result_favicon; 

        $where = array('user_id'=>$userID,'data_key' =>'pg_preloader_image');
        $result_preloader = $this->Common_DML->get_data( 'theme_setting', $where);
        $data['preloader_images'] =$result_preloader; 
       
        $header['theme_setting'] = html_escape('active');
        $this->load->view('admin/common/header', $header);
		$this->load->view('admin/theme_setting',$data);
		$this->load->view('admin/common/footer');
    }

    /** 
     * Google Analytics - Tracking Scripts Option
     */
    public function google_analytics_script(){

        $data = $header = array();
		$userID = $this->session->userdata( 'user_id' );

        $where = array('user_id'=>$userID,'data_key' =>'google_analytics_header_script');
        $result_header_script = $this->Common_DML->get_data( 'theme_setting', $where);
        $data['result_header_script'] =$result_header_script; 

        $where = array('user_id'=>$userID,'data_key' =>'google_analytics_footer_script');
        $result_footer_script = $this->Common_DML->get_data( 'theme_setting', $where);
        $data['result_footer_script'] =$result_footer_script; 
        
        $header['google_analytics'] = html_escape('active');
        $this->load->view('admin/common/header', $header);
		$this->load->view('google_analytics',$data);
		$this->load->view('admin/common/footer');
    }  
    /**
     * Logo Images changes
     */
    public function logo_changes(){
        header('Content-Type: application/json');
        $config['upload_path']   = './uploads/logo'; 
        $config['allowed_types'] = 'gif|jpg|png'; 
        $config['max_size']      = 1024;
        $this->load->library('upload', $config);
		if(!$this->upload->do_upload('logo_images_file')) {
            $error = array(
                        'status' =>false,
                        'msg' => 'Something went wrong!',
                        'data_file'=>$this->upload->display_errors()
                        ); 
            echo json_encode($error);
        }else { 
             $data = $this->upload->data();
             $userID = $this->session->userdata( 'user_id' );
             $where = array('user_id'=>$userID,'data_key' =>'pg_logo_image');
			 $result = $this->Common_DML->get_data( 'theme_setting', $where, 'COUNT(*) As total' );
            if($result[0]['total'] > 0){
               $theme_data = array('data_value'=>$data['file_name']);
               $where = array('data_key'=>'pg_logo_image');     
               $update_logo =$this->Common_DML->set_data('theme_setting', $theme_data, $where);   
            }else{
                $theme_data = array(
                    'user_id' =>$userID,
                    'data_key'=>'pg_logo_image',
                    'data_value'=>$data['file_name']
                   );
                $this->Common_DML->put_data('theme_setting', $theme_data, $where);
            }
            $success = [
                    'status'=>true,
                    'msg' => 'Logo File upload',
                    'data_file'=>$data['file_name']
                    ];
            echo json_encode($success);
        }
    die();   
    }
    /**
     * Favicon change
     */
    public function favicon_changes(){
        header('Content-Type: application/json');
        $config['upload_path']   = './uploads/logo'; 
        $config['allowed_types'] = 'gif|jpg|png'; 
        $config['max_size']      = 1024;
        $this->load->library('upload', $config);
		if(!$this->upload->do_upload('favicon_images_file')) {
            $error = array(
                        'status' =>false,
                        'msg' => 'Something went wrong!',
                        'data_file'=>$this->upload->display_errors()
                        ); 
            echo json_encode($error);
        }else { 
             $data = $this->upload->data();
             $userID = $this->session->userdata( 'user_id' );
             $where = array('user_id'=>$userID,'data_key' =>'pg_favicon_image');
			 $result = $this->Common_DML->get_data( 'theme_setting', $where, 'COUNT(*) As total' );
            if($result[0]['total'] > 0){
               $theme_data = array('data_value'=>$data['file_name']);
               $where = array('data_key'=>'pg_favicon_image');     
               $update_logo =$this->Common_DML->set_data('theme_setting', $theme_data, $where);   
            }else{
                $theme_data = array(
                    'user_id' =>$userID,
                    'data_key'=>'pg_favicon_image',
                    'data_value'=>$data['file_name']
                   );
                $this->Common_DML->put_data('theme_setting', $theme_data, $where);
            }
            $success = [
                    'status'=>true,
                    'msg' => 'Favicon File upload',
                    'data_file'=>$data['file_name']
                    ];
            echo json_encode($success);
        }
    die();   
    }
    /**
     * Preloader Images
     */
    public function preloader_changes(){
        header('Content-Type: application/json');
        $config['upload_path']   = './uploads/logo'; 
        $config['allowed_types'] = 'gif|jpg|png'; 
        $config['max_size']      = 1024;
        $this->load->library('upload', $config);
		if(!$this->upload->do_upload('preloader_images_file')) {
            $error = array(
                        'status' =>false,
                        'msg' => 'Something went wrong!',
                        'data_file'=>$this->upload->display_errors()
                        ); 
            echo json_encode($error);
        }else { 
             $data = $this->upload->data();
             $userID = $this->session->userdata( 'user_id' );
             $where = array('user_id'=>$userID,'data_key' =>'pg_preloader_image');
			 $result = $this->Common_DML->get_data( 'theme_setting', $where, 'COUNT(*) As total' );
            if($result[0]['total'] > 0){
               $theme_data = array('data_value'=>$data['file_name']);
               $where = array('data_key'=>'pg_preloader_image');     
               $update_logo =$this->Common_DML->set_data('theme_setting', $theme_data, $where);   
            }else{
                $theme_data = array(
                    'user_id' =>$userID,
                    'data_key'=>'pg_preloader_image',
                    'data_value'=>$data['file_name']
                   );
                $this->Common_DML->put_data('theme_setting', $theme_data, $where);
            }
            $success = [
                    'status'=>true,
                    'msg' => 'Preloader File upload',
                    'data_file'=>$data['file_name']
                    ];
            echo json_encode($success);
        }
    die();   
    }

    /**
     * Delete Images
     */
    public function delete_images_changes(){
        $file_name = '';
        if(!empty($_POST['file_name'])):
         $file_name = $_POST['file_name'];
        endif;
        $image_type = '';
        if(!empty($_POST['image_type'])):
         $image_type = $_POST['image_type'];
        endif;
        $where = array('data_key' => $image_type);
	    $this->Common_DML->delete_data('theme_setting', $where );
        $m_img_real= $_SERVER['DOCUMENT_ROOT'].'/uploads/logo/'.$file_name;
        unlink($m_img_real);
        $success = [
            'status'=>true,
            'msg' => 'Done',
           ];
        echo json_encode($success);
    }

    /**
     * Google Analytics Header Script 
     */
    public function google_analytics_header_script_save(){
        $header_script = '';
        if(!empty($_POST['header_script'])):
            $header_script = $_POST['header_script'];  
        endif;
        $userID = $this->session->userdata('user_id');
        $where = array('user_id'=>$userID,'data_key' =>'google_analytics_header_script');
		$result = $this->Common_DML->get_data( 'theme_setting', $where, 'COUNT(*) As total' );
        if($result[0]['total'] > 0){
            $theme_data = array('data_value'=>$header_script);
            $where = array('data_key'=>'google_analytics_header_script');     
            $update_logo =$this->Common_DML->set_data('theme_setting', $theme_data, $where);   
        }else{
            $theme_data = array(
                'user_id' =>$userID,
                'data_key'=>'google_analytics_header_script',
                'data_value'=>$header_script
                );
            $this->Common_DML->put_data('theme_setting', $theme_data, $where);
        }
        $success = [
                'status'=>true,
                'msg' => 'Preloader File upload',
                ];
        echo json_encode($success);
     die();
    }
    /**
     * Google Analytics Footer Script 
     */
    public function google_analytics_footer_script_save(){
        $script_footer = '';
        if(!empty($_POST['footer_script'])):
            $script_footer = $_POST['footer_script'];  
        endif; 
        $userID = $this->session->userdata('user_id');
        $where = array('user_id'=>$userID,'data_key' =>'google_analytics_footer_script');
		$result = $this->Common_DML->get_data( 'theme_setting', $where, 'COUNT(*) As total' );
        if($result[0]['total'] > 0){
            $theme_data = array('data_value'=>$script_footer);
            $where = array('data_key'=>'google_analytics_footer_script');     
            $update_logo =$this->Common_DML->set_data('theme_setting', $theme_data, $where);   
        }else{
            $theme_data = array(
                'user_id' =>$userID,
                'data_key'=>'google_analytics_footer_script',
                'data_value'=>$script_footer
                );
            $this->Common_DML->put_data('theme_setting', $theme_data, $where);
        }
        $success = [
                'status'=>true,
                'msg' => 'Preloader File upload',
                ];
        echo json_encode($success);
     die();
    }

    /**
     * SMPT Setting Option
     */
    public function smtp_settings(){
        $data = $header = array();

		$userID = $this->session->userdata( 'user_id' );

        $where = array('user_id'=>$userID,'data_key' =>'smtp_settings_data');
        $result_smtp_settings = $this->Common_DML->get_data( 'theme_setting', $where);

        $data['result_smtp_settings'] =$result_smtp_settings; 
        $header['smtp_setting'] = html_escape('active');

        $this->load->view('admin/common/header', $header);
		$this->load->view('smtp_setting',$data);
        $this->load->view('admin/common/footer'); 
    }
    /**
     * Payment Setting Option
     */
    public function payment_setting(){
        $data = $header = array();

		$userID = $this->session->userdata( 'user_id' );    

        $where = array('user_id'=>$userID,'data_key' =>'paymentSetting');
        $paymentSetting = $this->Common_DML->get_data( 'theme_setting', $where);
        $data['paymentSetting'] = isset($paymentSetting) && !empty($paymentSetting[0]['data_value']) ? json_decode($paymentSetting[0]['data_value'],true): array(); 
      
        $header['payment_setting'] = html_escape('active');       

        $this->load->view('admin/common/header', $header);
		$this->load->view('payment_setting',$data);
        $this->load->view('admin/common/footer'); 
    }
     /**
     * SMPT Setting Data Save
     */
    public function smpt_settings_script_save(){
        $smtp_host = '';
        if(!empty($_POST['smtp_host'])):
          $smtp_host = $_POST['smtp_host'];
        endif; 
        $smtp_port = '';
        if(!empty($_POST['smtp_port'])):
         $smtp_port = $_POST['smtp_port'];
        endif;
        $smtp_user = '';
        if(!empty($_POST['smtp_user'])):
          $smtp_user = $_POST['smtp_user'];
        endif;
        $smtp_pass = '';
        if(!empty($_POST['smtp_pass'])):
         $smtp_pass = $_POST['smtp_pass'];
        endif;
        $from_mail = '';
        if(!empty($_POST['from_mail'])):
         $from_mail = $_POST['from_mail'];
        endif;
        $mail_title = '';
        if(!empty($_POST['mail_title'])):
         $mail_title = $_POST['mail_title'];
        endif;
        $enable_smpt = '';
        if(!empty($_POST['enable_smpt'])):
         $enable_smpt = $_POST['enable_smpt'];
        endif;
        $smpt_crypto = '';
        if(!empty($_POST['smpt_crypto'])):
         $smpt_crypto = $_POST['smpt_crypto'];
        endif;
        $smtp_data = [
            'smtp_host' => $smtp_host,
            'smtp_port' => $smtp_port,
            'smtp_user' => $smtp_user,
            'smtp_pass' => $smtp_pass,
            'enable_smpt' => $enable_smpt,
            'mail_title' => $mail_title,
            'from_mail' => $from_mail,
            'smpt_crypto' =>$smpt_crypto
        ]; 
        $userID = $this->session->userdata('user_id');
        $where = array('user_id'=>$userID,'data_key' =>'smtp_settings_data');
		$result = $this->Common_DML->get_data( 'theme_setting', $where, 'COUNT(*) As total' );

        if($result[0]['total'] > 0){
            $theme_data = array('data_value'=>json_encode($smtp_data));
            $where = array('data_key'=>'smtp_settings_data');     
            $smpt_data_save = $this->Common_DML->set_data('theme_setting', $theme_data, $where);   
            $smpt_data_save = 1;
        }else{
            $theme_data = array(
                'user_id' =>$userID,
                'data_key'=>'smtp_settings_data',
                'data_value'=>json_encode($smtp_data)
                );
            $smpt_data_save = $this->Common_DML->put_data('theme_setting', $theme_data, $where);
        }
        
        if($smpt_data_save){
            $success = [
                'status'=>true,
                'msg' => 'Smtp Data Save',
                ];
        }else{
            $success = [
                'status'=>false,
                'msg' => 'Something went wrong!',
                ];
        }
        
        echo json_encode($success);
     die();
    }

      /**
     * Payment Setting 
     */
    function paymentSettingSave(){      
        
        $userID = $this->session->userdata('user_id');
        $where = array('user_id'=>$userID,'data_key' =>'paymentSetting');
		$result = $this->Common_DML->get_data( 'theme_setting', $where, 'COUNT(*) As total' );
       
        if($result[0]['total'] > 0){

            $paymentAccess = array('data_value'=>json_encode($_POST));

            $where = array('data_key'=>'paymentSetting');     
            $PaySetting = $this->Common_DML->update_data('theme_setting', $paymentAccess, $where);  
            $msg = "Payment Setting SUccessfully Update";
        }else{
            $paymentAccess = array(
                'user_id' =>$userID,
                'data_key'=>'paymentSetting',
                'data_value'=>json_encode($_POST)
                );
            $PaySetting = $this->Common_DML->put_data('theme_setting', $paymentAccess, $where);
            $msg = "Payment Setting SUccessfully Save";
        }
        
        if($PaySetting){
            $success = [
                'status'=>true,
                'msg' => $msg,
                ];
        }else{
            $success = [
                'status'=>false,
                'msg' => 'Something has gone wrong. Please try again later!',
                ];
        }
        
        echo json_encode($success);
        die();
    }
}