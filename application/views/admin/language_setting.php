<div class="pg-screen-container">
    <div class="pg-page-title-head">
        <h3><?php echo html_escape($this->lang->line('ltr_language_setting')); ?></h3>
    </div>
    <div class="pg-smtp-wrapper">       
        <div class="pg-content-wrapper">
            <form class="paymentGatewaySetting form" id="smpt_form_setting" enctype="multipart/form-data" method="post">                
                <div class="row">                                                
                    <div class="col-lg-12">
                        <div class="pg-page-title-head">
                            <h3><?php echo html_escape($this->lang->line('ltr_language')); ?> </h3>
                        </div>                        
                    </div>                   
                    <div class="pg-input-holder">                       
                        <select  id="Lnaguage" name="Lnaguage">
                            <option value="english"   <?= isset($language[0]['data_value']) && $language[0]['data_value']=="english" ? "selected":"";?> ><?php echo html_escape($this->lang->line('ltr_English')); ?></option>
                            <option value="arabic"   <?= isset($language[0]['data_value']) && $language[0]['data_value']=="arabic" ? "selected":"";?> ><?php echo html_escape($this->lang->line('ltr_Arabic')); ?></option>
                            <option value="french"  <?= isset($language[0]['data_value']) && $language[0]['data_value']=="french" ? "selected":"";?> ><?php echo html_escape($this->lang->line('ltr_French')); ?></option>
                            <option value="spanish"  <?= isset($language[0]['data_value']) && $language[0]['data_value']=="spanish" ? "selected":"";?> ><?php echo html_escape($this->lang->line('ltr_Spanish')); ?></option>
                        </select>  
                    </div>                  
                <div class="pg-btn-wrap">
                    <button type="button" class="pg-btn language_settings"><?=!empty($api_settings) ? 'Update' :  'save' ;?></button>
                </div>
            </form>
        </div>
    </div> 
</div>
