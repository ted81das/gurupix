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
    <div class="pg-payment-from-wrap pg-subscription-plan-wrap">
    <div class="container">
        <?php if (!empty($plandetail)): ?>
            <div class="row justify-content-center m-0">
                <form id="subscribFreTrial" class="form"  method="POST">
                    <div class="pg-plan-body">
                        <div class="pg-plan-header">                            
                            <h4>Are you sure you want to continue with this payment?</h4>
                            <div class="pg-plan-price">
                                <span><?php echo $plandetail[0]['pl_name']; ?></span>
                                <span class="pg-green"><?php echo $currency_sym[$plandetail[0]['pl_currency']]; ?>
                                    <?php echo $plandetail[0]['pl_price']; ?></span>
                            </div>
                        </div>
                        <div class="pg-input-holder">
                            <label for="username">Username <span class="error-msg" id="username-error"></span></label>
                            <input type="text" value="" id="username" name="username"/>
                            <input type="hidden" value="<?php echo base64_encode($plandetail[0]['pl_id']); ?>"id="planid" name="planid"/>
                            <input type="hidden" value="<?php echo $plandetail[0]['pl_price']; ?>" id="price" name="price"/>
                            <input type="hidden" value="<?php echo $plandetail[0]['pl_currency']; ?>" id="currency"name="currency"/>
                            <input type="hidden" value="<?php echo $plandetail[0]['pl_currency']; ?>" id="currency"name="currency"/>
                        </div>
                        <div class="pg-input-holder">
                            <label for="useremail">Email <span class="error-msg" id="useremail-error"></span></label>
                            <input type="email" value="" id="useremail" name="useremail"/>
                        </div>
                        <div class="pg-input-holder">
                            <label for="userpassword">Password <span class="error-msg" id="userpassword-error"></span>
                            </label>
                            <input type="password" value="" id="userpassword" name="userpassword"/>
                        </div>                                                                  
                        <div class="pg-btn-wrap">
                            <button class="btnAction pg-btn"type="submit">
                                <span id="button-text">Send Payment</span>
                                <div class="spinner hidden" id="spinner">
                                    <img id="proccesing" style="width: 35px;height: 35px;" src="<?=base_url();?>assets/images/proccesing.gif">
                                </div>
                            </button>
                            <p id="card-error" role="alert"></p>
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
  
     <script>
        var URL = "<?=$baseURL;?>";
        $(document).ready(function(){
            $('#proccesing').hide();
        });
        $(document).on('submit','#subscribFreTrial',function(e){
            e.preventDefault();
            var username = $('#username').val();
            var useremail = $('#useremail').val();
            var userpassword = $('#userpassword').val();
            var formdata = new FormData($(this).closest('form')[0]); 
            if (username.trim() === '' || useremail.trim() === '' || userpassword.trim() === '') {
                $.toaster("Please fill in all fields.", 'Error', 'danger');
            } else {
                $('#spinner').removeAttr('hidden');
                $('#proccesing').show();
                $.ajax({
                    type:'post',
                    url: URL+'subsription',
                    data:formdata,
                    processData: false,
                    contentType: false,
                    success:function(data){
                        var result = jQuery.parseJSON(data);
                        console.log(result);
                        if(result.status==1){
                            $.toaster(result.msg, 'Success', 'success');
                            setTimeout(function(){ window.location =URL; }, 1500);
                        }else{
                            $.toaster(result.msg, 'Error', 'danger');
                        }
                    }
                });
            }
        });   
</script>
 </body>
</html>