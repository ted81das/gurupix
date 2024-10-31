<div class="pg-screen-container">
    <div class="pg-page-title-head">
        <h3>API Settings</h3>
    </div>
    <div class="pg-smtp-wrapper">
        <?php 
      
        ?> 
        <div class="pg-content-wrapper">
            <form class="paymentGatewaySetting form" id="smpt_form_setting" enctype="multipart/form-data" method="post">                
                <div class="row">                                                
                    <div class="col-lg-12">
                        <div class="pg-page-title-head">
                            <h3>Open AI </h3>
                        </div>                        
                    </div>                   
                    <div class="col-lg-12">
                        <div class="pg-input-holder">
                            <label for="stripe_publishKey">Open AI Key <sup>* <a href="https://platform.openai.com/api-keys" target="_blank"> Get the Open AI Key Here </a></sup></label>
                            <input type="text" name="open_ai_key" id="open_ai_key" value="<?=!empty($api_settings) ? $api_settings['open_ai_key'] :  '' ;?>"  placeholder="Please Enter Open AI Key" >
                        </div>
                    </div> 
                    <div class="col-lg-12">
                        <div class="pg-page-title-head">
                            <h3>YouTube </h3>
                        </div>                        
                    </div>                  
                    <div class="col-lg-12">
                        <div class="pg-input-holder">
                            <label for="strpe_secret_key">YouTube API Key <sup>* <a href="https://console.cloud.google.com/apis/dashboard" target="_blank">Get the YouTube API Key Here </a></sup></label>
                            <input type="text" name="youtube_api_key" id="youtube_api_key" value="<?=!empty($api_settings) ? $api_settings['youtube_api_key'] :  '' ;?>"  placeholder="Please Enter YouTube Key" >
                        </div>
                    </div>                   
                    <div class="col-lg-12">
                        <div class="pg-page-title-head">
                            <h3>Pixabay</h3>
                        </div>                        
                    </div>               
                    <div class="col-lg-12">
                        <div class="pg-input-holder">
                            <label for="paypaBusinessEmail">Pixabay Key <sup>* <a href="https://pixabay.com/api/docs/" target="_blank">Get the Pixabay Key Here</a></sup></label>
                            <input type="text" name="pixabay_key" id="pixabay_key" value="<?=!empty($api_settings) ? $api_settings['pixabay_key'] :  '' ;?>"  placeholder="Please Enter Pixabay Key" >
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="pg-page-title-head">
                            <h3>Image Background Remove</h3>
                        </div>                        
                    </div>  
                    <div class="col-lg-12">
                        <div class="pg-input-holder">
                            <label>Image Background  Remove Authorization Key <sup>* <a href="https://clippingmagic.com/account" target="_blank">Get the Clipping Magic (Image Background Remove) Key Here</a></sup></label>
                            <input type="text" name="BGAuthKey" id="BGAuthKey" value="<?=!empty($api_settings) ? $api_settings['BGAuthKey'] :  '' ;?>"  placeholder="Please Enter Authorization Key">
                        </div>
                    </div>
                <div class="pg-btn-wrap">
                    <button type="button" class="pg-btn api_settings"><?=!empty($api_settings) ? 'Update' :  'save' ;?></button>
                </div>
            </form>
        </div>
    </div> 
</div>