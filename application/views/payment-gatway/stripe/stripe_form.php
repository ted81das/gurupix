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
        <?php if (!empty($plandetail)): ?>
            <div class="row justify-content-center m-0">
                <form id="payment-box" class="form" data-consumer-key="<?= isset($access['PublicKey'])?$access['PublicKey']:''; ?>"
                      data-create-order-url="<?= site_url('Stripes/process_payment'); ?>"
                      data-return-url="<?= site_url('Stripes/return_url'); ?>" method="POST">
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
                            <input type="hidden" value="<?php echo base64_encode($plandetail[0]['pl_id']); ?>"
                                   id="planid" name="planid"/>
                            <input type="hidden" value="<?php echo $plandetail[0]['pl_price']; ?>" id="price" name="price"/>
                            <input type="hidden" value="<?php echo $plandetail[0]['pl_currency']; ?>" id="currency"
                                   name="currency"/>
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
                        <div class="pg-input-holder">
                            <label for="coupon_code">Apply Coupon Code</label>
                            <input type="text" value="" id="coupon_code" name="coupon_code"/>
                        </div>
                        <?php
                            if( isset($access['PublicKey']) && empty($access['PublicKey'])){
                                ?>
                                    <div class="pg-input-holder">
                                        <label class="stripePaymentGatewayError">Please Add Stripe Payment Gateway Details In Admin Panel</label>                                       
                                    </div>                                
                                <?php
                            }
                         ?>
                        <div class="pg-input-holder">
                          <label for="card-number">Card Number</label>
                          <div id="card-number"></div>
                        </div>
                        <div class="pg-btn-wrap">
                            <button class="btnAction pg-btn" id="btn-payment" type="<?= isset($access['PublicKey']) && empty($access['PublicKey']) ? 'button' : 'submit'; ?>" <?= isset($access['PublicKey']) && empty($access['PublicKey']) ? 'disabled' : ''; ?>>
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
    <script src="https://js.stripe.com/v3/"></script>
     <script>
        $('#proccesing').hide();
        var stripeKey = $('#payment-box').attr('data-consumer-key');
        var createOrderUrl = $('#payment-box').attr('data-create-order-url'); 
       
        var returnUrl = $('#payment-box').attr('data-return-url');
        var stripe = Stripe(stripeKey);
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-number');

        // function confirmOrder(event) {
        var form = document.getElementById('payment-box'); 
        form.addEventListener('submit', function (event) {
            event.preventDefault();
                var valid = formValidate();               
                stripe.createToken(card).then(function (result) {                   
                    if (valid) {                       
                            var purchase = {
                                email: document.getElementById("useremail").value,
                                unitPrice: document.getElementById("price").value,
                                currency: document.getElementById("currency").value,
                                name: document.getElementById("username").value,
                                userpassword: document.getElementById("userpassword").value,
                                coupon_code: document.getElementById("coupon_code").value,
                                planid: document.getElementById("planid").value,
                                token:result.token,
                            };
                            loading(true);
                           
                            $.ajax({
                                method: "POST",
                                url: createOrderUrl,
                                data: JSON.stringify(purchase),                              
                                success: function(resp) {
                                    var data = $.parseJSON(resp);
                                    console.log(data);
                                    loading(false);
                                    orderComplete(data.id, purchase.planid);
                                },
                                error: function(resp) {
                                   loading(true);
                                   console.log(resp);
                                   showError(resp);
                                }
                            });
                           
                            var payWithCard = function(stripe, card, clientSecret, orderHash) {
                                loading(true);
                                stripe.confirmCardPayment(clientSecret, {
                                    payment_method: {
                                        card: card
                                    }
                                }).then(function(result) {
                                    if (result.error) {
                                        // Show error to your customer
                                        showError(result.error.message);
                                    } else {
                                        // The payment succeeded!
                                        orderComplete(result.paymentIntent.id, orderHash);
                                    }
                                });
                            };
                            /* ------- UI helpers ------- */
                            // Shows a success message when the payment is complete
                            var orderComplete = function(paymentIntentId, orderHash) {
                                loading(false);
                                window.location.href = returnUrl + "?orderId=" + orderHash;
                            };
                            // Show the customer the error from Stripe if their card fails to
                            // charge
                            var showError = function(errorMsgText) {
                                loading(false);
                                var errorMsg = document.querySelector("#card-error");

                               

                                errorMsg.textContent = errorMsgText;
                                setTimeout(function() {
                                    errorMsg.textContent = "";
                                }, 10000);
                            };
                            // Show a spinner on payment submission
                            function loading(isLoading) {
                                if (isLoading) {
                                    // Disable the button and show a spinner
                                    document.querySelector("button").disabled = true;
                                    document.querySelector("#spinner").classList.remove("hidden");
                                    document.querySelector("#button-text").classList.add("hidden");
                                    $('#proccesing').show();
                                } else {
                                    document.querySelector("button").disabled = false;
                                    document.querySelector("#spinner").classList.add("hidden");
                                    document.querySelector("#button-text").classList
                                        .remove("hidden");
                                }

                            };
                    }
               });
            });
            function formValidate() {
                var valid = true;
                var email = document.getElementById("useremail").value;
                var unitPrice = document.getElementById("price").value;
                var emailField = document.getElementById("useremail");
                var priceField = document.getElementById("price");
                var currencyField = document.getElementById("currency").value;

                var usernameField  = document.getElementById("username").value;
                var userpassword = document.getElementById("userpassword").value;

                var allInput = document.querySelectorAll(".input-box");
                for (i = 0; i < allInput.length; i++) {
                    allInput[i].classList.remove('error-field');
                }

                var allErrorSpan = document.querySelectorAll(".error-msg");
                for (i = 0; i < allErrorSpan.length; i++) {
                    allErrorSpan[i].innerText = "";
                }

                var currencyRegex = /^(?!0\.00)[1-9]\d{0,2}(,\d{3})*(\.\d\d)?$/;
                var emailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

                if (unitPrice.trim() == "") {
                    priceField.classList.add("error-field");
                    document.getElementById("price-error").innerText = "required.";
                } else if (!currencyRegex.test(unitPrice)) {
                    priceField.classList.add("error-field");
                    document.getElementById("price-error").innerText = "invalid.";
                    valid = false;
                }
                if (usernameField.trim() == "") {
                    document.getElementById("username").classList.add("error-field");
                    document.getElementById("username-error").innerText = "required.";
                }
                if (email.trim() == "") {
                    emailField.classList.add("error-field");
                    document.getElementById("useremail-error").innerText = "required.";
                } else if (!emailRegex.test(email)) {
                    emailField.classList.add("error-field");
                    document.getElementById("useremail-error").innerText = "invalid.";
                    valid = false;
                }

                
                if (userpassword.trim() == "") {
                    document.getElementById("userpassword").classList.add("error-field");
                    document.getElementById("userpassword-error").innerText = "required.";
                }
                
                
                if (currencyField.trim() == "") {
                    currencyField.classList.add("error-field");
                   // document.getElementById("currency-error").innerText = "required.";
                }
                if ((email == "") || unitPrice == "" || currencyField == ""
                    || usernameField == "" || userpassword == ""
                    ) {
                    
                    var errorElement = document.getElementsByClassName("error-field");
                    errorElement[0].focus();
                    valid = false;
                }

                return valid;
            }
</script>
 </body>
</html>