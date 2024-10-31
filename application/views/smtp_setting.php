<div class="pg-screen-container">
    <div class="pg-page-title-head">
        <h3>SMTP Configuration</h3>
    </div>
    <div class="pg-smtp-wrapper">
        <?php 
        $smtp_host = $smtp_port = $smtp_user = $smtp_pass = $from_mail = $mail_title = $enable_smpt ='';
        if(!empty($result_smtp_settings[0]['data_value'])):
            $data_smpt = json_decode($result_smtp_settings[0]['data_value'],true);
            $smtp_host = $data_smpt['smtp_host'];
            $smtp_port = $data_smpt['smtp_port'];
            $smtp_user = $data_smpt['smtp_user'];
            $smtp_pass = $data_smpt['smtp_pass'];
            $from_mail = $data_smpt['from_mail'];
            $mail_title = $data_smpt['mail_title'];
            $enable_smpt = $data_smpt['enable_smpt'];
            $smpt_crypto = $data_smpt['smpt_crypto'];
        endif; 
        ?> 
        <div class="pg-content-wrapper">
            <form id="smpt_form_setting" action="" method="post">
                <div class="pg-input-holder">
                    <div class="pg-checkbox">
                        <input type="checkbox" name="enable_smpt" id="enable_smpt" <?php if($enable_smpt=='true'): echo 'checked'; endif; ?>>
                        <label for="enable_smpt">Enable SMTP (Simple Mail Transfer Protocol)</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="pg-input-holder">
                            <label for="smtp_host">SMTP Host</label>
                            <input type="text" name="smtp_host" id="smtp_host" value="<?php echo $smtp_host; ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="pg-input-holder">
                            <label for="smtp_port">SMTP Port</label>
                            <input type="text" name="smtp_port" id="smtp_port" value="<?php echo $smtp_port; ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="pg-input-holder">
                            <label for="smtp_user">SMTP Username</label>
                            <input type="text" name="smtp_user" id="smtp_user" value="<?php echo $smtp_user; ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="pg-input-holder">
                            <label for="smtp_user">SMTP Password</label>
                            <input type="password" name="smtp_pass" id="smtp_pass" value="<?php echo $mail_title; ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="pg-input-holder">
                            <label for="smpt_crypto">SMTP Crypto</label>
                            <select id="smpt_crypto" name="smpt_crypto">
                            <option value="ssl" <?php echo isset($smpt_crypto) && $smpt_crypto=='ssl' ? 'selected' : '';?>>SSL</option>
                            <option value="tlc" <?php echo isset($smpt_crypto) && $smpt_crypto=='tlc' ? 'selected' : '';?>>TLC</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="pg-input-holder">
                            <label for="from_mail">From Mail</label>
                            <input type="text" name="from_mail" id="from_mail" value="<?php echo $from_mail; ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="pg-input-holder">
                            <label for="mail_title">Mail Title</label>
                            <input type="text" name="mail_title" id="mail_title" value="<?php echo $smtp_user; ?>" required>
                        </div>
                    </div>
                </div>           
                <div class="pg-btn-wrap">
                    <button type="submit" class="pg-btn">
                        Save SMTP Settings
                    </button>
                </div>
            </form>
        </div>
    </div> 
</div>