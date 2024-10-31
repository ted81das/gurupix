<div class="pg-screen-container">
    <div class="pg-page-title-head">
        <h3>Payment Setting</h3>
    </div>
    <div class="pg-smtp-wrapper">
        <?php 
      
        ?> 
        <div class="pg-content-wrapper">
            <form class="paymentGatewaySetting form" id="smpt_form_setting" enctype="multipart/form-data" method="post">                
                <div class="row">                                                
                    <div class="col-lg-12">
                        <div class="pg-page-title-head">
                            <h3>Stripe Configuration</h3>
                        </div>                        
                    </div>                   
                    <div class="col-lg-6">
                        <div class="pg-input-holder">
                            <label for="stripe_publishKey">Stripe Publishable Key <sup>*</sup></label>
                            <input type="text" name="stripe_publishKey" id="stripe_publishKey" value="<?=!empty($paymentSetting) ? $paymentSetting['stripe_publishKey'] :  '' ;?>"  placeholder="Please Enter Stripe Publishable Key" required>
                        </div>
                    </div>                   
                    <div class="col-lg-6">
                        <div class="pg-input-holder">
                            <label for="strpe_secret_key">Stripe Secret Key <sup>*</sup></label>
                            <input type="text" name="strpe_secret_key" id="strpe_secret_key" value="<?=!empty($paymentSetting) ? $paymentSetting['strpe_secret_key'] :  '' ;?>"  placeholder="Please Enter Stripe Secret Key" required>
                        </div>
                    </div>                   
                    <div class="col-lg-12">
                        <div class="pg-page-title-head">
                            <h3>PayPal Configuration</h3>
                        </div>                        
                    </div>               
                    <div class="col-lg-6">
                        <div class="pg-input-holder">
                            <label for="paypaBusinessEmail">Paypal Client Id <sup>*</sup></label>
                            <input type="text" name="paypal_client_id" id="paypaBusinessEmail" value="<?=!empty($paymentSetting) ? $paymentSetting['paypal_client_id'] :  '' ;?>"  placeholder="Please Enter Paypal Client Id" required>
                        </div>
                    </div>                   
                    <div class="col-lg-6">
                        <div class="pg-input-holder">
                            <label for="payPalSandbox">Sandbox Accounts <sup>*</sup></label>
                            <input type="text" name="sandbox_accounts" id="payPalSandbox" value="<?=!empty($paymentSetting) ? $paymentSetting['sandbox_accounts'] :  '' ;?>"  placeholder="Please Enter Sandbox Accounts" required>
                        </div>
                    </div> 
                <div class="pg-btn-wrap">
                    <button type="button" class="pg-btn paymentSetting"><?=!empty($paymentSetting) ? 'Update' :  'save' ;?></button>
                </div>
            </form>
        </div>
    </div> 
</div>