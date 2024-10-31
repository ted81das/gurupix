<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo html_escape($this->lang->line('ltr_subscribe_plan_page_title')); ?></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
       <!-- Script fonts (Google Fonts Calling) -->
        <link href="<?php echo base_url(); ?>assets/css/fonts.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/ico" href="<?php echo base_url(); ?>assets/images/favicon.png" />
	    <link rel="icon" type="image/ico" href="<?php echo base_url(); ?>assets/images/favicon.png" />
		<!-- Bootstrap Bundle -->
		<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- Favicon  -->
        <link rel="icon" type="image/ico" href="<?php echo base_url(); ?>assets/images/favicon.png" />
		<!-- Custom Style  -->
        <link href="<?php echo base_url(); ?>assets/css/frontend.css" rel="stylesheet">
	</head>
	<body class="pg-front-page">
		 <!-- Preloader  -->
         <div class="pg-preloader-wrap">
            <div class="pg-preloader">
                <img src="<?php echo base_url(); ?>assets/images/preloader.gif" alt="">
            </div>
        </div>
        
        <div class="pg-subscription-plan-wrap">
            <div class="pg-container">
                <div class="container">
                    <div class="pg-subscription-holder">
                        <div class="row justify-content-center">
                                    <div class="col-12">
                                        <div class="pg-section-tilte">
                                            <h2><?php echo html_escape($this->lang->line('ltr_subscribe_plan_title')); ?></h2>
                                        </div>
                                    </div> 
                                    <?php 
                                    $pl_price = 0;
                                    $i=1;
                                    if(!empty($subscription_plans)){
                                    foreach($subscription_plans as $plans){  
                                        $pl_price = $plans['pl_price'];
                                    ?>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-12">
                                        <div class="pg-plan-box">
                                            <div class="pg-plan-box-body">
                                                <?php 
                                                if(!empty($plans['pl_name'])):
                                                    $pl_name = $plans['pl_name'];
                                                    $pl_id = $plans['pl_id'];
                                                ?>
                                                    <div class="pg-plan-head">
                                                        <h5 class="pg-plan-title"><?php echo html_escape($plans['pl_name']); ?></h5>
                                                    </div>
                                                    <?php endif; 
                                                        if(!empty($plans['pl_name'])):
                                                        ?>
                                                        <h6 class="pg-plan-detail">
                                                            <span class="pg-amount">
                                                                <?php
                                                                echo html_escape($currency_sym[$plans['pl_currency']]);  echo html_escape($pl_price);?>
                                                            </span>
                                                            <span class="period">/
                                                                <?php 
                                                                if($plans['interval'] == '7'){
                                                                echo html_escape($plan_interval= "week");
                                                                }elseif($plans['interval'] == '31'){
                                                                echo html_escape($plan_interval= "month");
                                                                }elseif($plans['interval'] == '365'){
                                                                echo html_escape($plan_interval= "year");
                                                                }
                                                            ?></span>
                                                        </h6>
                                                        <div class="pg-plan-detailed-info">
                                                            <?php 
                                                            echo html_entity_decode($plans['plan_description']);
                                                            
                                                            ?>
                                                        </div>
                                                
                                                        <?php 
                                                        if($pl_price!="0"){?>
                                                            <a href="javascript:void(0);" open-modal="create_user_popup_<?php echo $i; ?>" class="pg-btn">
                                                                <?php echo html_escape($this->lang->line('ltr_subscribe_plan_modal_btn')); ?>
                                                            </a>
                                                        <!-- Pixaguru Modal Start -->
                                                        <div id="create_user_popup_<?php echo $i; ?>" class="custom-modal">
                                                            <div class="custom-modal-dialog">
                                                                <div class="custom-modal-content">
                                                                <span class="close-modal" close-modal>X</span>
                                                                    <div class="custom-modal-body">
                                                                        <div class="custom-modal-inner">
                                                                                <div class="pg-modal-title">
                                                                                    <h3>Payment Integration</h3>
                                                                                    <p>To continue with pixaguru please complete the registration first select any one of the payment method to continue.</p>
                                                                                </div>
                                                                                <div class="pg-payment-mode-type">
                                                                                <a href="<?php echo base_url(); ?>pay-with-paypal/<?php echo $pl_id; ?>">
                                                                                        <img src="<?php echo base_url(); ?>assets/images/paypal.png" alt="">
                                                                                </a>
                                                                                <a href="<?php echo base_url(); ?>pay-with-stripe/<?php echo $pl_id; ?>">
                                                                                        <img src="<?php echo base_url(); ?>assets/images/strip.png" alt="">
                                                                                </a>
                                                                                </div>

                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Pixaguru Modal End -->
                                                        
                                                    <?php }else{?>
                                                        <a href="<?php echo base_url(); ?>pay-with-free/<?php echo $pl_id; ?>" class="pg-btn">
                                                                <?php echo html_escape($this->lang->line('ltr_subscribe_plan_modal_btn')); ?>
                                                            </a>
                                                    <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif;
                                $i++;
                                }
                            }
                            ?>
                        </div>
                    </div>


                    <div class="container">
                        <div class="pg-auth-note">
                            <p><?php echo html_escape($this->lang->line('ltr_subscribe_plan_has_acc_msg')); ?> <a href="<?php echo base_url(); ?>authentication"><?php echo html_escape($this->lang->line('ltr_subscribe_plan_has_acc_btn')); ?></a></p>
                        </div>
                    </div>
                </div>
	        </div>
	    </div>
     <span id="base_url" data-ajax_url="<?php echo site_url(); ?>"></span>
     <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
     <script src="<?php echo base_url(); ?>assets/js/jquery.toaster.js"></script>
     <script src="<?php echo base_url(); ?>assets/js/front-script.js"></script>
 </body>
</html>       