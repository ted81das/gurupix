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
        <div class="pg-payment-from-wrap pg-subscription-plan-wrap">
            <div class="container">
                <?php if(!empty($plandetail)): ?>
                    <div class="row justify-content-center m-0">
                       <form action="<?php echo base_url(); ?>Paypal/pay" method="POST">
                        <div class="pg-plan-body">
                            <div class="pg-plan-header">
                                <h4>Are you sure you want to continue with this payment?</h4>
                                <div class="pg-plan-price">
                                    <span><?php echo $plandetail[0]['pl_name']; ?></span>
                                    <span class="pg-green"><?php echo $currency_sym[$plandetail[0]['pl_currency']]; ?><?php echo $plandetail[0]['pl_price']; ?></span>
                                </div>
                            </div>

                            <div class="pg-input-holder">
                                <label for="username">Username</label>
                                <input type="text"  value="" id="username" name="username" /> 
                                <input type="hidden"  value="<?php echo base64_encode($plandetail[0]['pl_id']); ?>" id="planid" name="planid" /> 
                            </div>

                            <div class="pg-input-holder">
                                <label for="useremail">Email</label>
                                <input type="email"  value="" id="useremail" name="useremail" /> 
                            </div>

                            <div class="pg-input-holder">
                                <label for="userpassword">Password</label>
                                <input type="password"  value="" id="userpassword" name="userpassword" /> 
                            </div>

                            <div class="pg-input-holder">
                                <label for="coupon_code">Apply Coupon Code</label>
                                <input type="text"  value="" id="coupon_code" name="coupon_code" /> 
                            </div>
                            <?php
                                if( isset($access['sandbox_accounts']) && empty($access['sandbox_accounts'])){
                                    ?>
                                        <div class="pg-input-holder">
                                            <label class="stripePaymentGatewayError">Please Add PayPal Payment Gateway Details In Admin Panel</label>                                       
                                        </div>                                
                                    <?php
                                }
                            ?>
                            <div class="pg-btn-wrap">
                                <button type="<?= isset($access['sandbox_accounts']) && empty($access['sandbox_accounts']) ? 'button' : 'submit'; ?>" <?= isset($access['sandbox_accounts']) && empty($access['sandbox_accounts']) ? 'disabled' : ''; ?> class="pg-btn">Paynow</button>
                            </div>
                        </div>
                   </form>
                   <?php endif; ?>
                </div>
            </div> 
     </div>
     <span id="base_url" data-ajax_url="<?php echo site_url(); ?>"></span>
     <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
     <script src="<?php echo base_url(); ?>assets/js/jquery.toaster.js"></script>
     <script src="<?php echo base_url(); ?>assets/js/front-script.js"></script>
 </body>
</html>