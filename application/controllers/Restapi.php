<?php

class Restapi extends CI_Controller {
	  
    function userGetTemplate(){ 
        if(isset($data['token'])){
            $data = $_REQUEST;         
            $Token = explode('_',base64_decode($data['token']));
            if(!empty($Token[1])){
                if (!filter_var($Token[1], FILTER_VALIDATE_EMAIL)) {
                    $output = array(                    
                        "recordsTotal" => 0,
                        "recordsFiltered" => 0,
                        "data" => array(),
                        "msg" => 'Invalide Token',
                    );
                    echo json_encode($output,JSON_UNESCAPED_SLASHES);    
                    die;
                }else{
                
                    if(isset($Token) && !empty($Token)){
                        if(isset($Token[1]) && !empty($Token[1])){
                            $usersCheck = $this->Common_DML->select_data('*','users',array('email'=>$Token[1]));
                        }else{
                            $usersCheck = array();
                        }
                    
                        if(empty( $usersCheck)){
                            $output = array(                    
                                "recordsTotal" => 0,
                                "recordsFiltered" => 0,
                                "data" => array(),
                                "msg" => 'Invalide Token',
                            );
                            echo json_encode($output,JSON_UNESCAPED_SLASHES);    
                            die;
                        }
                        if(isset($data['length']) && $data['length']>0){
                        
                            if(isset($data['start']) && !empty($data['start'])){
                                $limit = array($data['length'],$data['start']);              
                            }else{ 
                                $limit = array($data['length'],0);             
                            }
                        }else{
                            $limit = '';           
                        }        
                                    
                        if($data['search']!= ''){			
                            $like = array('template_name',$data['search']); 
                        }else{
                            $like = ''; 
                        }			
                        
                
                        $user_templates = $this->Common_DML->select_data('*','user_templates',array('thumb !='=>'','user_id'=>$Token[0]),$limit,array('template_id','desc'),$like);
                    
                        if(!empty($user_templates)){               
                
                            foreach($user_templates as $temp){  
                            
                                $dataarray[] =  array(
                                    'template_id'=> $temp['template_id'],
                                    'campaign_id'=> $temp['campaign_id'],
                                    'cat_id'=> $temp['cat_id'],
                                    'sub_cat_id'=> $temp['sub_cat_id'],
                                    'template_name'=> $temp['template_name'],
                                    'thumb'=> base_url().$temp['thumb'],
                                    'template_size'=> $temp['template_size'],
                                    'status'=> $temp['status'],
                                ); 
                                                            
                            }
                            $output = array(                    
                                "recordsTotal" => count($user_templates),
                                "recordsFiltered" => count($user_templates),
                                "data" => $dataarray,
                                "msg" => 'Successfully Get Template',
                            );
                
                        }else{
                            $output = array(                    
                                "recordsTotal" => 0,
                                "recordsFiltered" => 0,
                                "data" => array(),
                                "msg" => 'No data available',
                            );
                        }
                    }else{
                        $output = array(               
                            "recordsTotal" => 0,
                            "recordsFiltered" => 0,
                            "data" => array(),
                            "msg" => 'Token Is Empty',
                        );
                    }
                    echo json_encode($output,JSON_UNESCAPED_SLASHES);      
                }
            }else{
                $output = array(                    
                    "recordsTotal" => 0,
                    "recordsFiltered" => 0,
                    "data" => array(),
                    "msg" => 'Invalide Token',
                );
                echo json_encode($output,JSON_UNESCAPED_SLASHES);    
                die; 
            }
        }else{
            $output = array(                    
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => array(),
                "msg" => 'Token is empty',
            );
            echo json_encode($output,JSON_UNESCAPED_SLASHES);    
            die; 
        }
    }
}