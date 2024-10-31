<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
	private $g_userID;
	function __construct() {
		parent::__construct();
		
		if( !$this->session->userdata( 'admin_member_login' ) ){
			redirect( 'authentication', 'refresh' );
		}
		$this->g_userID = $this->session->userdata( 'user_id' );		

        $where = array('user_id'=>$this->g_userID,'data_key' =>'language');
        $language = $this->Common_DML->get_data( 'theme_setting', $where);		
		$lang = isset($language[0]['data_value'])&&!empty($language[0]['data_value'])?$language[0]['data_value']:'';	
		languageLoad($lang);
		
	}
	/**
	 * Admin User View
	 */
	public function index(){
		$this->users();
	} 
	/** 
	 * Admin Template View
	 */
	public function templates( $size = '1200x628',$active_tem=1){
		$data = $header = array();
		$userID = $this->session->userdata( 'user_id' );
		$header['templates'] = html_escape('active');
		$data['category'] = $this->Common_DML->get_data('category');
		$data['templates'] = $this->Common_DML->get_data_limit( 
			'user_templates', 
			array( 'user_id' => $userID, 'template_size' => $size, 'status' => $active_tem), 
			'template_id,thumb,template_name,template_size,status,datetime', 
			array(0,24),
			'modifydate',
			'DESC'
		  );
		$data['active_templates'] = $this->Common_DML->get_data('user_templates', array('user_id'=>$userID,'template_size'=>$size, 'status'=>1), 'COUNT(*) as total');
		$data['inactive_templates'] = $this->Common_DML->get_data('user_templates', array('user_id'=>$userID,'template_size'=>$size, 'status'=>0), 'COUNT(*) as total' );
		$data['size'] = $size;
		$data['active_tem'] = $active_tem;
		$template_size_count = $this->Common_DML->query('SELECT template_size, COUNT(*) as tot FROM `user_templates` WHERE user_id = '.$userID.' && status = 1 GROUP BY template_size');
		$tot_A = $this->Common_DML->query('SELECT COUNT(*) as total FROM `user_templates` WHERE user_id = '.$userID.' && status = 1');
		$tot_I = $this->Common_DML->query('SELECT COUNT(*) as total FROM `user_templates` WHERE user_id = '.$userID.' && status = 0');
		$tot_T = $this->Common_DML->query('SELECT COUNT(*) as total FROM `user_templates` WHERE user_id = '.$userID);
		$data['template_size_count'] = $template_size_count;
		$data['tot_A'] = $tot_A;
		$data['tot_I'] = $tot_I;
		$data['tot_T'] = $tot_T;
		$this->load->view('admin/common/header', $header);
		$this->load->view('admin/templates',$data);
		$this->load->view('admin/common/footer');
    }
    /** 
	 * Admin Template Action
	 */
	public function template_action(){
		if(!isset( $_POST['template_id'] )){ echo json_encode( array( 'status' => 0, 'msg' => html_escape($this->lang->line('ltr_admin_templates_msg0')) ) ); die(); }
		$userID = $this->g_userID;		
		$where = array( 'template_id' => html_escape($_POST['template_id']), 'user_id' => $userID, 'status' => 1 );
		$template = $this->Common_DML->get_data( 'user_templates', $where );
		if(empty($template)){ echo json_encode( array( 'status' => 0, 'msg' => html_escape($this->lang->line('ltr_admin_templates_msg1')) ) ); die(); }
		if(isset($_POST['action']) && $_POST['action'] == 'copy'){
			unset($template[0]['template_id']);
			$template[0]['datetime'] = date('Y-m-d H:i:s');
			$file = './'.$template[0]['thumb'];
			$name = random_generator() . '.jpg';
			$newfile = './uploads/user_'.$userID.'/templates/'.$name;
			if (!copy($file, $newfile)) {
				echo json_encode( array( 'status' => 0, 'msg' =>html_escape($this->lang->line('ltr_admin_templates_msg1'))) );
				die();
			}
			$template[0]['thumb'] = 'uploads/user_'.$userID.'/templates/'.$name;
			$what = $template[0];
			$insert_id = $this->Common_DML->put_data( 'user_templates', $what );
			echo json_encode( array( 'status' => 1, 'msg' =>html_escape($this->lang->line('ltr_admin_templates_msg3')), 'insert_id' => $insert_id, 'data' => $what ) );
		}
		if(isset($_POST['action']) && $_POST['action'] == 'delete'){
			$path = $template[0]['thumb'];
			if(!empty($path)) unlink($path);
			$this->Common_DML->delete_data( 'user_templates', $where );	
			echo json_encode( array( 'status' => 1, 'msg' => html_escape($this->lang->line('ltr_admin_templates_msg4')) ) );
		}
	}
	/**
	 * Admin Get Sub Category
	 */
	public function get_sub_category(){
		if(isset($_POST['cat_id'])){
			$where = array( 'cat_id' => html_escape($_POST['cat_id']) );
			$sub_category = $this->Common_DML->get_data( 'sub_category', $where, 'sub_cat_id,name' );
			echo json_encode( array( 'status' => 1, 'data' => $sub_category ) );
		}
	}
	/**
	 * Admin All User Data Views
	 */
    public function users(){
		$header = array();
		$data = array('users'=>array());
		$recordsTotal = $this->Common_DML->get_data( 'users', array( 'role' => 'user' ), 'COUNT(id) as total' );
		$data['plans'] = $this->Common_DML->get_data( 'plans','', '*' );
		$header['users'] = html_escape('active');
		$data['recordsTotal'] = isset($recordsTotal[0]['total']) ? html_escape($recordsTotal[0]['total']) : 0;
		$this->load->view('admin/common/header', $header);
		$this->load->view('admin/users', $data);
		$this->load->view('admin/common/footer');
	}
	public function CreateUserSubscription(){		
		if(isset($_POST['action']) && $_POST['action'] =="create"){
		
			$plan_id  = $_POST['plan']; 
			$plandetail = $this->Common_DML->get_data('plans', array('pl_id'=>$plan_id ))[0];
			$array = array(
				'name' => $_POST['name'],
				'email' =>  $_POST['email'],
				'password' => md5( $_POST['password']),			
				'status' => 1,
				'access_level' => $plandetail['pl_id'],
				'datetime' => date('Y-m-d H:i:s')
			   );
			$where = array( 'email' =>$_POST['name'] );
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
				$where = array('email' =>$_POST['email']);
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
				$pm_method = $plandetail['pl_price']==0 ? 'TrialPeriod' : 'manuallyadd';
				// Insert tansaction data into the database 
				$subscripData = array( 
					'user_id' => $insert_id, 
					'plan_id' => $plan_id, 
					'stripe_subscription_id' =>'admin_'.getRandomNumber(12), 
					'stripe_customer_id' => 'admin_'.getRandomNumber(14),
					'stripe_plan_id' => 'admin_'.getRandomNumber(10), 
					'plan_amount' => $plandetail['pl_price'], 
					'plan_amount_currency' => $plandetail['pl_currency'], 
					'plan_interval' =>$plandetail['interval_count'], 
					'plan_interval_count' => 1, 
					'plan_period_start' => $current_period_start, 
					'plan_period_end' => $current_period_end, 
					'payer_email' => $_POST['email'], 
					'created' => $created, 
					'payment_method' => $pm_method, 
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
				$subject =$_POST['name'].' credentials info';
				$str = "Username : ".$_POST['email'].", Password : ".$_POST['password'];
				if($_POST['email']){
					$link = base_url();
					$mail = array(
						"email" => $_POST['email'],
						"name" => $_POST['name'],
					);
					$template_name = 'media-access';
					$var = '[
						{
						"name": "USERNAME",
						"content": "'.$_POST['name'].'"
						},
						{
						"name": "EMAIL",
						"content": "'.$_POST['email'].'"
						},
						{
						"name": "PASSWORD",
						"content": "'.$_POST['password'].'"
						}
					]';
	
					$where = array('data_key' =>'smtp_settings_data');
					$result_smpt_settings = $this->Common_DML->get_data( 'theme_setting', $where);
					$data_smpt = '';
					if(!empty($result_smpt_settings[0]['data_value'])){
					  $data_smpt = $result_smpt_settings[0]['data_value'];
					}
					$data['email_for'] = 'new_user';
					$data['password'] = $_POST['password'];
					$data['USERNAME'] =$_POST['name'];
					$data['email'] = $_POST['email'];
					if($_POST['send_mail']==1){
						$mresult = sendmailTemplate($template_name, $mail, $var,$data,$data_smpt);			
					}
					$mresult = sendmailTemplate($template_name, $mail, $var,$data,$data_smpt);			
					
				}
				$this->session->set_flashdata('price', 0);  
				echo json_encode( array( 'status' => 1, 'msg' => html_escape($this->lang->line('ltr_auth_create_subscription_msg1')),'url'=>'authentication/thankyou') );	
			   
			}
		}
		die;
	}
    /**
	 * Admin All User Data Loads
	 */
	function get_user($page = 0){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
            $get = $this->input->get(NULL,TRUE);
            if(isset($post['length']) && $post['length']>0){
                if(isset($post['start']) && !empty($post['start'])){
                    $limit = array($post['length'],$post['start']);
                    $count = $post['start']+1;
                }else{ 
                    $limit = array($post['length'],0);
                    $count = 1;
                }
            }else{
                $limit = '';
                $count = 1;
            }        
			            
            if($post['search']['value'] != ''){			
                $like = array('name',$post['search']['value']); 
            }else{
               $like = ''; 
            }			
			
            $users = $this->Common_DML->select_data('*','users',array('role'=>'user'),$limit,array('id','desc'),$like);
    
            if(!empty($users)){               
    
                foreach($users as $user){
                                    
					$dataarray[] =  array(
						$count,
						'<span class="pg-t-username">'.html_escape($user['name']).'</span>',
						'<span class="pg-t-mail">'.html_escape($user['email']).'</span>',
						html_escape($user['status']) == 1 ? '<span class="pg-active-user">'.html_escape($this->lang->line('ltr_user_active_action')).'</span>' : '<span class="pg-inactive-user">'.html_escape($this->lang->line('ltr_user_deactivate_action')).'</span>',
						'<div class="pg-btn-group">
							<a href="'.base_url().'admin/get_popup/user/'.html_escape($user['id']).'" class="pg-btn pg-edit-user-link"><span class="pg-edit-icon">
							<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 477.873 477.873"><g><path d="M392.533 238.937c-9.426 0-17.067 7.641-17.067 17.067V426.67c0 9.426-7.641 17.067-17.067 17.067H51.2c-9.426 0-17.067-7.641-17.067-17.067V85.337c0-9.426 7.641-17.067 17.067-17.067H256c9.426 0 17.067-7.641 17.067-17.067S265.426 34.137 256 34.137H51.2C22.923 34.137 0 57.06 0 85.337V426.67c0 28.277 22.923 51.2 51.2 51.2h307.2c28.277 0 51.2-22.923 51.2-51.2V256.003c0-9.425-7.641-17.066-17.067-17.066z" /><path d="M458.742 19.142A65.328 65.328 0 0 0 412.536.004a64.85 64.85 0 0 0-46.199 19.149L141.534 243.937a17.254 17.254 0 0 0-4.113 6.673l-34.133 102.4c-2.979 8.943 1.856 18.607 10.799 21.585 1.735.578 3.552.873 5.38.875a17.336 17.336 0 0 0 5.393-.87l102.4-34.133c2.515-.84 4.8-2.254 6.673-4.13l224.802-224.802c25.515-25.512 25.518-66.878.007-92.393zm-24.139 68.277L212.736 309.286l-66.287 22.135 22.067-66.202L390.468 43.353c12.202-12.178 31.967-12.158 44.145.044a31.215 31.215 0 0 1 9.12 21.955 31.043 31.043 0 0 1-9.13 22.067z" /></g></svg>
						</span></a>
							<a href="#" data-user_id="'.html_escape($user['id']).'" class="pg-btn pg-delete-user"><span class="pg-delete-icon">
							<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 512 512"><g><path d="M436 60h-75V45c0-24.813-20.187-45-45-45H196c-24.813 0-45 20.187-45 45v15H76c-24.813 0-45 20.187-45 45 0 19.928 13.025 36.861 31.005 42.761L88.76 470.736C90.687 493.875 110.385 512 133.604 512h244.792c23.22 0 42.918-18.125 44.846-41.271l26.753-322.969C467.975 141.861 481 124.928 481 105c0-24.813-20.187-45-45-45zM181 45c0-8.271 6.729-15 15-15h120c8.271 0 15 6.729 15 15v15H181V45zm212.344 423.246c-.643 7.712-7.208 13.754-14.948 13.754H133.604c-7.739 0-14.305-6.042-14.946-13.747L92.294 150h327.412l-26.362 318.246zM436 120H76c-8.271 0-15-6.729-15-15s6.729-15 15-15h360c8.271 0 15 6.729 15 15s-6.729 15-15 15z" /><path d="m195.971 436.071-15-242c-.513-8.269-7.67-14.558-15.899-14.043-8.269.513-14.556 7.631-14.044 15.899l15 242.001c.493 7.953 7.097 14.072 14.957 14.072 8.687 0 15.519-7.316 14.986-15.929zM256 180c-8.284 0-15 6.716-15 15v242c0 8.284 6.716 15 15 15s15-6.716 15-15V195c0-8.284-6.716-15-15-15zM346.927 180.029c-8.25-.513-15.387 5.774-15.899 14.043l-15 242c-.511 8.268 5.776 15.386 14.044 15.899 8.273.512 15.387-5.778 15.899-14.043l15-242c.512-8.269-5.775-15.387-14.044-15.899z"/></g></svg>
						</span></a>
						</div>' 
					);                    
                    $count++;
                }
    
                $recordsTotal = $this->Common_DML->countAll('users',array('role'=>'user'),'','',$like);
    
                $output = array(
                    "draw" => $post['draw'],
                    "recordsTotal" => $recordsTotal,
                    "recordsFiltered" => $recordsTotal,
                    "data" => $dataarray,
                );
    
            }else{
                $output = array(
                    "draw" => $post['draw'],
                    "recordsTotal" => 0,
                    "recordsFiltered" => 0,
                    "data" => array(),
                );
            }
            echo json_encode($output,JSON_UNESCAPED_SLASHES);
        }else{
            echo 'Direct access not allow';
        } 
    }
	public function categoryTabel(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            $post = $this->input->post(NULL,TRUE);
            $get = $this->input->get(NULL,TRUE);
            if(isset($post['length']) && $post['length']>0){
                if(isset($post['start']) && !empty($post['start'])){
                    $limit = array($post['length'],$post['start']);
                    $count = $post['start']+1;
                }else{ 
                    $limit = array($post['length'],0);
                    $count = 1;
                }
            }else{
                $limit = '';
                $count = 1;
            }        
			            
            if($post['search']['value'] != ''){			
                $like = array('name',$post['search']['value']); 
            }else{
               $like = ''; 
            }			
			
            $categorys = $this->Common_DML->select_data('*','sub_category','',$limit,array('sub_cat_id','desc'),$like);
    
            if(!empty($categorys)){              
    
                foreach($categorys as $category){
                                    
					$dataarray[] =  array(
						$count,
						'<span class="pg-t-username">'.html_escape($category['name']).'</span>',						
						'<div class="pg-btn-group">
							<a href="'. base_url() . 'admin/get_popup/sub_cat/'.$category['sub_cat_id'].'" class="pg-btn pg-edit-user-link"><span class="pg-edit-icon"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 477.873 477.873"><g><path d="M392.533 238.937c-9.426 0-17.067 7.641-17.067 17.067V426.67c0 9.426-7.641 17.067-17.067 17.067H51.2c-9.426 0-17.067-7.641-17.067-17.067V85.337c0-9.426 7.641-17.067 17.067-17.067H256c9.426 0 17.067-7.641 17.067-17.067S265.426 34.137 256 34.137H51.2C22.923 34.137 0 57.06 0 85.337V426.67c0 28.277 22.923 51.2 51.2 51.2h307.2c28.277 0 51.2-22.923 51.2-51.2V256.003c0-9.425-7.641-17.066-17.067-17.066z" /><path d="M458.742 19.142A65.328 65.328 0 0 0 412.536.004a64.85 64.85 0 0 0-46.199 19.149L141.534 243.937a17.254 17.254 0 0 0-4.113 6.673l-34.133 102.4c-2.979 8.943 1.856 18.607 10.799 21.585 1.735.578 3.552.873 5.38.875a17.336 17.336 0 0 0 5.393-.87l102.4-34.133c2.515-.84 4.8-2.254 6.673-4.13l224.802-224.802c25.515-25.512 25.518-66.878.007-92.393zm-24.139 68.277L212.736 309.286l-66.287 22.135 22.067-66.202L390.468 43.353c12.202-12.178 31.967-12.158 44.145.044a31.215 31.215 0 0 1 9.12 21.955 31.043 31.043 0 0 1-9.13 22.067z" /></g></svg></span></a>
							<a href="" class="pg-btn ed_delete_category" data-sub_cat_id="'. $category['sub_cat_id'].'">
								<span class="pg-delete-icon">
									<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 512 512"><g><path d="M436 60h-75V45c0-24.813-20.187-45-45-45H196c-24.813 0-45 20.187-45 45v15H76c-24.813 0-45 20.187-45 45 0 19.928 13.025 36.861 31.005 42.761L88.76 470.736C90.687 493.875 110.385 512 133.604 512h244.792c23.22 0 42.918-18.125 44.846-41.271l26.753-322.969C467.975 141.861 481 124.928 481 105c0-24.813-20.187-45-45-45zM181 45c0-8.271 6.729-15 15-15h120c8.271 0 15 6.729 15 15v15H181V45zm212.344 423.246c-.643 7.712-7.208 13.754-14.948 13.754H133.604c-7.739 0-14.305-6.042-14.946-13.747L92.294 150h327.412l-26.362 318.246zM436 120H76c-8.271 0-15-6.729-15-15s6.729-15 15-15h360c8.271 0 15 6.729 15 15s-6.729 15-15 15z" /><path d="m195.971 436.071-15-242c-.513-8.269-7.67-14.558-15.899-14.043-8.269.513-14.556 7.631-14.044 15.899l15 242.001c.493 7.953 7.097 14.072 14.957 14.072 8.687 0 15.519-7.316 14.986-15.929zM256 180c-8.284 0-15 6.716-15 15v242c0 8.284 6.716 15 15 15s15-6.716 15-15V195c0-8.284-6.716-15-15-15zM346.927 180.029c-8.25-.513-15.387 5.774-15.899 14.043l-15 242c-.511 8.268 5.776 15.386 14.044 15.899 8.273.512 15.387-5.778 15.899-14.043l15-242c.512-8.269-5.775-15.387-14.044-15.899z"/></g></svg>
								</span>
							</a>
						</div>' 
					);                    
                    $count++;
                }
    
                $recordsTotal = $this->Common_DML->countAll('sub_category','','','',$like);
    
                $output = array(
                    "draw" => $post['draw'],
                    "recordsTotal" => $recordsTotal,
                    "recordsFiltered" => $recordsTotal,
                    "data" => $dataarray,
                );
    
            }else{
                $output = array(
                    "draw" => $post['draw'],
                    "recordsTotal" => 0,
                    "recordsFiltered" => 0,
                    "data" => array(),
                );
            }
            echo json_encode($output,JSON_UNESCAPED_SLASHES);
        }else{
            echo 'Direct access not allow';
        } 
	}
	public function get_popup( $form = 'user', $id = '' ){
		if($form == 'user' && $id != ''){
			$data = array();
			$where = array( 'id' => $id );
			$data['plans'] = $this->Common_DML->get_data( 'plans','', '*' );						
			$data['users'] = $this->Common_DML->get_data( 'users', $where );
			$this->load->view('admin/admin_popup', $data);
		}
		if($form == 'sub_cat' && $id != ''){
			$data = array();
			$where = array( 'sub_cat_id' => $id );
			$data['sub_category'] = $this->Common_DML->get_data( 'sub_category', $where );
			$this->load->view('admin/admin_popup', $data);
		}
		if($form == 'suggestion' && $id != ''){
			$data = array();
			$where = array( 'suggestion_id' => $id );
			$data['suggestion'] = $this->Common_DML->get_data( 'suggestion', $where );
			$data['ts_categories'] = $this->Common_DML->get_data( 'sub_category', array(), '*', array( 'cat_id' => 1, 'status' => 1 ) );
			$data['s_categories'] = $this->Common_DML->get_data( 'suggestion_category', array(), '*', array( 's_id' => 'DESC' ) );
			$this->load->view('admin/admin_popup', $data);
		}
		if($form == 'template' && $id != ''){
			$data = array();
			$where = array( 'template_id' => $id );
			$data['category'] = $this->Common_DML->get_data( 'category' );
			$data['template'] = $this->Common_DML->get_data( 'user_templates', $where, 'template_name,cat_id,sub_cat_id,template_id,template_size,access_level' );
			$data['t_sub_category'] = $this->Common_DML->get_data( 'sub_category', array( 'cat_id' => $data['template'][0]['cat_id'] ) );
			$this->load->view('admin/admin_popup', $data);
		}
		if($form == 'tduplicate' && $id != ''){
			$data = array();
			$data['duplicate'] = true;
			$data['template_id'] = $id;
			$this->load->view('admin/admin_popup', $data);
		}
	}
	/**
	 * Admin All User Action
	 */
	public function user_action(){	
		if(isset($_POST['action']) && $_POST['action'] == 'update'){
			
			$where = array( 'email' => $_POST['email'] );
			$result = $this->Common_DML->get_data( 'users', $where, '*' );
			if(!empty($result) && count($result) == 1){
				$array = array(
					'name' => trim(html_escape($_POST['name'])),
					'email' => trim(html_escape($_POST['email'])),
					'access_level' => html_escape($_POST['plan']),
					'status' => html_escape($_POST['status'])
				);
				if(!empty(trim($_POST['password']))){
					$array['password'] = md5(html_escape($_POST['password']));
				} 
				$where = array( 'id' => html_escape($_POST['user_id']) );
				$insert_id = $this->Common_DML->set_data( 'users', $array, $where );
			
				$plan_id  = $_POST['plan']; 
				$planExitCheck = $this->Common_DML->get_data('user_subscriptions', array('plan_id'=>$plan_id,'user_id'=>$_POST['user_id'] ));
				$subId = $this->Common_DML->get_data('users', array('id'=>$_POST['user_id'] ),'subscription_id')[0];
				$plandetail = $this->Common_DML->get_data('plans', array('pl_id'=>$plan_id ))[0];
				
				if(empty($planExitCheck)){
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
					$pm_method = $plandetail['pl_price']==0 ? 'TrialPeriod' : 'manuallyadd';
					// Insert tansaction data into the database 
					$subscripData = array( 						
						'plan_id' => $plan_id, 
						'stripe_subscription_id' =>'admin_'.getRandomNumber(12), 
						'stripe_customer_id' => 'admin_'.getRandomNumber(14),
						'stripe_plan_id' => 'admin_'.getRandomNumber(10), 
						'plan_amount' => $plandetail['pl_price'], 
						'plan_amount_currency' => $plandetail['pl_currency'], 
						'plan_interval' =>$plandetail['interval_count'], 							
						'plan_period_start' => $current_period_start, 
						'plan_period_end' => $current_period_end, 
						'payer_email' => $_POST['email'], 
						'created' => $created,	
						); 
				
					$this->Common_DML->set_data( 'user_subscriptions', $subscripData, array('usp_id'=>$subId['subscription_id']));
				
					
					/**
					 * Send Email Data
					 */
					$subject =$_POST['name'].' credentials info';
					$str = "Username : ".$_POST['email'].", Password : ".$_POST['password'];
					if($_POST['email']){
						$link = base_url();
						$mail = array(
							"email" => $_POST['email'],
							"name" => $_POST['name'],
						);
						$template_name = 'media-access';
						$var = '[
							{
							"name": "USERNAME",
							"content": "'.$_POST['name'].'"
							},
							{
							"name": "EMAIL",
							"content": "'.$_POST['email'].'"
							},
							{
							"name": "PASSWORD",
							"content": "'.$_POST['password'].'"
							}
						]';
		
						$where = array('data_key' =>'smtp_settings_data');
						$result_smpt_settings = $this->Common_DML->get_data( 'theme_setting', $where);
						$data_smpt = '';
						if(!empty($result_smpt_settings[0]['data_value'])){
						  $data_smpt = $result_smpt_settings[0]['data_value'];
						}
						$data['email_for'] = 'new_user';
						$data['password'] = $_POST['password'];
						$data['USERNAME'] =$_POST['name'];
						$data['email'] = $_POST['email'];

						if($_POST['send_mail']==1){
							$mresult = sendmailTemplate($template_name, $mail, $var,$data,$data_smpt);			
						}
						
					}					
				}
				$subject = $_POST['name'].html_escape(' credentials info');
				$str = "Username : ".html_escape($_POST['email']).", Password : ".html_escape($_POST['password']);
				echo json_encode( array( 'status' => 1, 'msg' =>html_escape($this->lang->line('ltr_admin_user_action_msg3')) ) );	
			}else{
				echo json_encode( array( 'status' => 0, 'msg' =>html_escape($this->lang->line('ltr_admin_user_action_msg2'))) );
			}
		}
		if(isset($_POST['action']) && $_POST['action'] == 'delete'){
			if(!empty($_POST['user_id'])){
				$where = array( 'id' => html_escape($_POST['user_id']));
				$this->Common_DML->delete_data( 'users', $where );
				$this->Common_DML->delete_data( 'user_image', array( 'user_id' => html_escape($_POST['user_id'] )) );
				$this->Common_DML->delete_data( 'user_templates', array( 'user_id' => html_escape($_POST['user_id'] )) );
				$this->Common_DML->delete_data( 'campaign', array( 'user_id' => html_escape($_POST['user_id'] )) );
				$this->Common_DML->delete_data( 'user_subscriptions', array( 'user_id' => html_escape($_POST['user_id'] )) );
				remove_directory( 'uploads/user_'.html_escape($_POST['user_id']));
				echo json_encode( array( 'status' => 1, 'msg' =>html_escape($this->lang->line('ltr_admin_user_action_msg3'))) );	
			}else{
				echo json_encode( array( 'status' => 0, 'msg' =>html_escape($this->lang->line('ltr_admin_user_action_msg4')) ) );
			}
		}
	}
	
	/**
	 * Admin category Option
	 */
	public function category(){
		if(isset($_POST['action']) && $_POST['action'] == 'create'){
			$cat_name = $_POST['name'];
			$data = array( 
				'name' => $cat_name,
				'cat_id' => html_escape($_POST['cat_id']),
				'status' => 1,
				'datetime' => date('Y-m-d H:i:s')
			);
			$id = $this->Common_DML->put_data( 'sub_category', $data );
			if($id > 0){
				echo json_encode( array( 'status' => 1, 'msg' =>html_escape($this->lang->line('ltr_admin_category_msg1'))) );
			}else{
				echo json_encode( array( 'status' => 0, 'msg' =>html_escape($this->lang->line('ltr_admin_category_msg2'))) );
			}
			die();
		} 
		if(isset($_POST['action']) && $_POST['action'] == 'update'){
			$cat_name = html_escape($_POST['name']);
			$data = array( 
				'name' => $cat_name,
				'datetime' => date('Y-m-d H:i:s')
			);
			$where = array( 'sub_cat_id' => $_POST['sub_cat_id'] );
			$id = $this->Common_DML->set_data( 'sub_category', $data, $where );
			echo json_encode( array( 'status' => 1, 'msg' =>html_escape($this->lang->line('ltr_admin_category_msg3'))) );
			die();
		}
		if(isset($_POST['action']) && $_POST['action'] == 'delete'){
			$where = array( 'sub_cat_id' => html_escape($_POST['sub_cat_id']) );
			$this->Common_DML->delete_data( 'sub_category', $where );
			echo json_encode( array( 'status' => 1, 'msg' =>html_escape($this->lang->line('ltr_admin_category_msg4'))) );
			die();
		}
		$data = $header = array();
	
		$categories = $this->Common_DML->get_join_data( 'sub_category sc', 'user_templates ut', 'ut.sub_cat_id = sc.sub_cat_id', array('user_id'=>$this->g_userID), 'sc.*, COUNT(ut.template_id) as tot', array( 'sub_cat_id' => 'DESC' ), 'LEFT', 'sc.sub_cat_id' );
		
		$categories =  $this->Common_DML->get_data('sub_category',$where = array(), $field = '*', array( 'sub_cat_id' => 'DESC' ));
		$data['categories'] = $categories;
		$header['category'] = html_escape('active');
		$this->load->view('admin/common/header', $header);
		$this->load->view('admin/category', $data);
		$this->load->view('admin/common/footer');
	}
	/**
	 * Admin Create Template
	 */
	public function create_template(){
		if(isset($_POST['template_id'])){
			$array = array(
				'template_name' => html_escape($_POST['template_name']),
				'cat_id' => html_escape($_POST['cat_id']),
				'template_size' => html_escape($_POST['template_size']),
				'sub_cat_id' => html_escape($_POST['sub_cat_id']),
			  );
			$this->Common_DML->set_data( 'user_templates', $array, array( 'template_id' => html_escape($_POST['template_id'])) );
			echo json_encode( array( 'status' => 1, 'msg' =>html_escape($this->lang->line('ltr_admin_create_template_msg1')), 'url' => base_url() . 'admin/templates' ) );
			die();
		}
		if(isset($_POST['template_name'])){
			$array = array(
				'template_name' => html_escape($_POST['template_name']),
				'campaign_id' => 1,
				'user_id' => html_escape($this->session->userdata( 'user_id' )),
				'cat_id' =>1,
				'template_size' => html_escape($_POST['template_size']),
				'sub_cat_id' => html_escape($_POST['sub_cat_id']),
				'datetime' => date('Y-m-d H:i:s'),
				'modifydate' => date('Y-m-d H:i:s'),
				'status' => 1,
				'template_custom_size' =>html_escape($_POST['custom_size'])
			  );
			$template_id = $this->Common_DML->put_data( 'user_templates', $array );
			echo json_encode( array( 'status' => 1, 'msg' =>html_escape($this->lang->line('ltr_admin_create_template_msg2')), 'url' => base_url() . 'editor/admin_edit/'.$template_id ) );
		}
		die();
	}
	/**
	 * Admin Template Status
	 */
	public function template_status_update(){
		if(isset($_POST['template_id'])){
			$array = array(
				'status' => html_escape($_POST['status'])
			);
			$this->Common_DML->set_data( 'user_templates', $array, array( 'template_id' => html_escape($_POST['template_id'] )) );
			echo json_encode( array( 'status' => 1, 'msg' =>html_escape($this->lang->line('ltr_admin_template_status_update_msg1'))) );
			die();
		}
	} 
	/**
	 * Admin Load More Template
	 */
	public function get_more_template(){
	    if(isset($_POST['reach'])){
			$userID = $this->g_userID;
			$size = html_escape($_POST['size']);
			$active_inactive = html_escape($_POST['active_inactive']);
			$templates = $this->Common_DML->get_data_limit( 
				'user_templates', 
				array( 'user_id' => $userID, 'template_size' => $size, 'status' => $active_inactive), 
				'template_id,thumb,template_name,template_size,status,DATE_FORMAT(datetime, "%d/%m/%Y") as datetime', 
				array(html_escape($_POST['reach']), 24),
				'modifydate',
				'DESC'
			); 
			$count = $this->Common_DML->get_data_limit( 
				'user_templates', 
				array( 'user_id' => $userID, 'template_size' => $size , 'status' => $active_inactive), 
				'template_id', 
				array(html_escape($_POST['reach'])+24, 24),
				'modifydate',
				'DESC'
			   );
			$response = array(
				'status' => 1,
				'reach' => html_escape($_POST['reach']) + 24,
				'data' => $templates,
				'hide' => count($count) > 0 ? 0 : 1
			);
			echo json_encode( $response );
			die();
		}
	}
	/**
	 * Admin Download Template Option
	 */
	public function download_template($access_level = 1,$template_size = '1200x628'){
		 $r = $this->Common_DML->get_data( 'user_templates', array('access_level'=>$access_level,'user_id'=>20,'template_size'=>$template_size,'status'=>1), 'template_id,thumb' );
		 $this->load->library('zip');
		 for($i=0;$i<count($r);$i++){
			 if(!empty($r[$i]['thumb'])){
				$this->zip->read_file($r[$i]['thumb']);
			 }
		 }
		 $this->zip->download('files_backup.zip');
	}
	/**
	 * Admin Logout Option
	 */
	public function logout(){
		$array_items = array( 'admin_member_login', 'access_level', 'profile_pic','name','facebook_post','user_id', 'email','member_login' );
		$this->session->unset_userdata( $array_items );
		 redirect( 'authentication', 'refresh' );
	}  
	/**
	 * Admin Get Total Template
	 */
	public function get_total_temp(){
		$res = $this->Common_DML->query('SELECT template_size, COUNT(*) as tot FROM `user_templates` WHERE user_id = 20 && status = 1 GROUP BY template_size');
		$tot = $this->Common_DML->query('SELECT COUNT(*) as total FROM `user_templates` WHERE user_id = 20 && status = 1');
		print_r($tot);
		print_r($res);
	}
	/**
	 * Admin Copy All Size Template
	 */
	public function copy_all_size(){
		if(isset($_POST['template_id']) && !empty($_POST['template_id'])){
			$r = $this->Common_DML->get_data( 'user_templates', array('template_id'=> html_escape($_POST['template_id']),'user_id'=>20), '*' );
			unset( $r[0]['template_id'] );
			$array = $r[0]; 
			if(!empty($_POST['template_size'])){
				$array['template_name'] = html_escape($_POST['template_name']);
				for($i=0;$i<count($_POST['template_size']);$i++){
					$array['template_size'] = html_escape($_POST['template_size'][$i]);
					$array['thumb'] = '';
					$this->Common_DML->put_data('user_templates', $array );
				}
			}
			redirect( 'admin/templates', 'refresh' );	
		}	
	}

	/**
	 * Admin Profile Update
	 */
	public function admin_profile(){
        $data = array();
		$userID = $this->g_userID;
		$data['user'] = $this->Common_DML->get_data( 'users', array( 'id' => $userID, 'status' => 1 ) );
		if(count($data['user']) != 1) redirect( 'authentication', 'refresh' );
		if(isset($_GET['code']) && isset($_GET['state'])){
			$insert_id = $this->Common_DML->set_data( 'fb_details', $fb_data, array( 'user_id' => $this->g_userID ) );
			if($insert_id > 0){
				redirect( 'profile', 'refresh' );
			}
		}
		 
		$header = array();
		$header['menu'] = 'profile';
		$this->load->view('admin/common/header',$header);
		$this->load->view('profile', $data);
		$this->load->view('admin/common/footer');
    }
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

		$where = array('user_id'=>$userID,'data_key' =>'siteTitle');
        $siteTitle = $this->Common_DML->get_data( 'theme_setting', $where);
        $data['siteTitle'] =$siteTitle; 
             
        $header['theme_setting'] = html_escape('active');
        $this->load->view('admin/common/header', $header);
		$this->load->view('admin/theme_setting',$data);
		$this->load->view('admin/common/footer');
    }
    public function languageSetting(){
        $data = $header = array();
		$userID = $this->session->userdata( 'user_id' );

        $where = array('user_id'=>$userID,'data_key' =>'language');
        $language = $this->Common_DML->get_data( 'theme_setting', $where);
        $data['language'] =$language; 
          
        $header['language_setting'] = html_escape('active');
        $this->load->view('admin/common/header', $header);
		$this->load->view('admin/language_setting',$data);
		$this->load->view('admin/common/footer');
    }
	public function languageSettingsAdd(){
		
		$userID = $this->session->userdata('user_id');
        $where = array('user_id'=>$userID,'data_key' =>'language');
		$result = $this->Common_DML->get_data( 'theme_setting', $where, 'COUNT(*) As total' );
       
        if($result[0]['total'] > 0){

            $ApitAccess = array('data_value'=>$_POST['Lnaguage']);

            $where = array('data_key'=>'language');     
            $apiSetting = $this->Common_DML->update_data('theme_setting', $ApitAccess, $where);  
            $msg = "language Setting Successfully Update";
        }else{
            $ApitAccess = array(
                'user_id' =>$userID,
                'data_key'=>'language',
                'data_value'=>$_POST['Lnaguage']
                );
            $apiSetting = $this->Common_DML->put_data('theme_setting', $ApitAccess, $where);
            $msg = "language Setting Successfully Save";
        }
        
        if($apiSetting){
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
    public function api_setting(){
		$data = array();
        $header['api_setting'] = html_escape('active');
		$userID = $this->session->userdata( 'user_id' );    
		$where = array('user_id'=>$userID,'data_key' =>'apiSetting');
        $paymentSetting = $this->Common_DML->get_data( 'theme_setting', $where);
        $data['api_settings'] = isset($paymentSetting) && !empty($paymentSetting[0]['data_value']) ? json_decode($paymentSetting[0]['data_value'],true): array();
		
        $this->load->view('admin/common/header', $header);
		$this->load->view('admin/api_setting',$data);
		$this->load->view('admin/common/footer');
    }
	public function restApi(){
		$data = array();
        $header['rest_api'] = html_escape('active');
		$userID = $this->session->userdata( 'user_id' );    
		$where = array('id' =>$userID);
        $users = $this->Common_DML->get_data( 'users', $where);  
		$data['token'] = base64_encode($users[0]['id'].'_'.$users[0]['email']);		
        $this->load->view('admin/common/header', $header);
		$this->load->view('admin/rest_api.php',$data);
		$this->load->view('admin/common/footer');
	}
	public function apiSettingAdd(){

		$userID = $this->session->userdata('user_id');
        $where = array('user_id'=>$userID,'data_key' =>'apiSetting');
		$result = $this->Common_DML->get_data( 'theme_setting', $where, 'COUNT(*) As total' );
       
        if($result[0]['total'] > 0){

            $ApitAccess = array('data_value'=>json_encode($_POST));

            $where = array('data_key'=>'apiSetting');     
            $apiSetting = $this->Common_DML->update_data('theme_setting', $ApitAccess, $where);  
            $msg = "Payment Setting Successfully Update";
        }else{
            $ApitAccess = array(
                'user_id' =>$userID,
                'data_key'=>'apiSetting',
                'data_value'=>json_encode($_POST)
                );
            $apiSetting = $this->Common_DML->put_data('theme_setting', $ApitAccess, $where);
            $msg = "API Setting Successfully Save";
        }
        
        if($apiSetting){
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
	public function SiteNameChange(){

		$userID = $this->session->userdata('user_id');
        $where = array('user_id'=>$userID,'data_key' =>'siteTitle');
		$result = $this->Common_DML->get_data( 'theme_setting', $where, 'COUNT(*) As total' );
       
        if($result[0]['total'] > 0){

            $ApitAccess = array('data_value'=>$_POST['sitename']);

            $where = array('data_key'=>'siteTitle');     
            $apiSetting = $this->Common_DML->update_data('theme_setting', $ApitAccess, $where);  
            $msg = "Site Name Successfully Update";
        }else{
            $ApitAccess = array(
                'user_id' =>$userID,
                'data_key'=>'siteTitle',
                'data_value'=>$_POST['sitename']
                );
            $apiSetting = $this->Common_DML->put_data('theme_setting', $ApitAccess, $where);
            $msg = "Site Name Successfully Save";
        }
        
        if($apiSetting){
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
	public function templateImporter(){
		$userID = $this->g_userID;		
        $data = array();
		$dir = FCPATH.'/uploads/sql_template';
		$specific_entries = array(".sql",);
		$data['importer'] = read_folder($dir,$specific_entries);		
		$header = array();
		$header['template_importer'] = html_escape('active');
		$header['menu'] = 'template importer';
		$this->load->view('admin/common/header',$header);
		$this->load->view('admin/template_importer', $data);
		$this->load->view('admin/common/footer');
    }
 
	public function TemplateSqlImporter(){
	
		$this->load->database();  //load the driver first
		
		$mysqlUserName      = $this->db->username;
		$mysqlPassword      = $this->db->password;
		$mysqlHostName      = $this->db->hostname;
		$DbName             = $this->db->database;
	
		$Connection = mysqli_connect($mysqlHostName , $mysqlUserName,$mysqlPassword,$DbName);
		
		$filePath = FCPATH.'uploads/sql_template/'.$_POST['fineName'];
	
		if($_POST['domainName']!="UpdateSQL"){

			$SQL = file_get_contents($filePath);
		
			$replaceData = str_replace('https://app.pixaguru.com/', $_POST['domainName'] ,$SQL);
			
			file_put_contents($filePath,$replaceData);
		}

		
		/***** Check DB Details ENDS ******/

		if($Connection){		
			
			// Temporary variable, used to store current query
			$templine = '';

			// Read in entire file
			$lines = file($filePath );
		
			// Loop through each line
			$res = [];
			foreach ($lines as $line)
			{

				// Skip it if it's a comment
				if (substr($line, 0, 2) == '--' || $line == '')
					continue;

					// Add this line to the current segment
					$templine .= $line;
					
					array_push($res,$templine);
					// If it has a semicolon at the end, it's the end of the query
					if (substr(trim($line), -1, 1) == ';')
					{
						// Perform the query
						mysqli_set_charset($Connection,'utf8');
						mysqli_query($Connection,$templine);
						// Reset temp variable to empty
						$templine = '';
					}				
				
			} 
		
			if(!empty($res)){				
				$import = array(
					'importe_name' =>$_POST['fineName']				
				   );
				$this->Common_DML->put_data('template_importer', $import);
				
				echo "done";  		
			}	
			
		}else {
			echo "not_done";  
		}
	}
	function LanguageTranslate(){

		$Path = APPPATH.'language/english/english_lang.php';
		
        $lang = file_get_contents($Path);
		
		echo($lang);
		die;

		$curl = curl_init();

		curl_setopt_array($curl, [
			CURLOPT_URL => "https://google-translate-v21.p.rapidapi.com/translate",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode([
				'text_to_translate' => 'Layers',
				'dest' => 'ar'
			]),
			CURLOPT_HTTPHEADER => [
				"X-RapidAPI-Host: google-translate-v21.p.rapidapi.com",
				"X-RapidAPI-Key: afa67acf23msh471bcb4c6bd7ae1p16a801jsn4b3ab8418870",
				"content-type: application/json"
			],
		]);

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			echo $response;
		}
	}
    function ChangeURLSQL(){
        $dbHost     = 'localhost';
    	$dbUname    = 'kamleshyadav_pixaguru';
    	$dbPass     = '.W8bX9!g&}$,';
    	$dbName     = 'kamleshyadav_pixaguru';
    	 
		$filename   = 'import_1';
    	$filePath = 'uploads/'.$filename; 
    	
        $file_content = file_get_contents($filePath); 
        $mime_type = mime_content_type($filePath);

    	if(file_exists($filePath)){	
    
         // Connect & select the database
    		$db = new mysqli($dbHost, $dbUname, $dbPass, $dbName); 
    		
    		// Temporary variable, used to store current query
    		$templine = '';
    		
    		// Read in entire file
    		$lines = file($filePath);
    	
    		$error = '';
    		
    		// Loop through each line
    		foreach ($lines as $line){
    			// Skip it if it's a comment
    			if(substr($line, 0, 2) == '--' || $line == ''){
    				continue;
    			}
    			
    			// Add this line to the current segment
    			$templine .= $line;
    			
    			// If it has a semicolon at the end, it's the end of the query
    			if (substr(trim($line), -1, 1) == ';'){
    				// Perform the query
    				if(!$db->query($templine)){
    					$error .= 'Error importing query "<b>' . $templine . '</b>": ' . $db->error . '<br /><br />';
    				}
    				
    				// Reset temp variable to empty
    				$templine = '';
    			}
    		}
		}
    }
  
}