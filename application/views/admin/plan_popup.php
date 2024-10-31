<?php if(!empty($subscription_plans)){ ?>
<div class="pg-modal-wrapper">
    <div class="pg-modal-inner-row">
        <div class="pg-modal-title-wrap">
            <h3><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_heading')); ?></h3>
        </div> 
        <div class="pg-modal-body">
            <form id="update_pricing_plan_form" action="" method="POST">
                <div class="pg-input-holder">
                    <label for="plan_name"><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_plan_name')); ?></label>
                    <input type="text"  value="<?php if(isset($subscription_plans[0]['pl_name'])): echo html_escape($subscription_plans[0]['pl_name']); endif; ?>" id="plan_name" name="plan_name">
                </div>
                <div class="pg-input-holder">
                    <label for="currency_set"><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_currency')); ?></label>
                    <select  id="currency_set" name="currency_set">
                        
                        <option value="USD" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='USD'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_united_states_dollars')); ?></option>

                        <option value="EUR" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='EUR'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_euro')); ?></option>

                        <option value="GBP" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='GBP'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_united_Kingdom_pounds')); ?></option>

                        <option value="DZD" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='DZD'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_algeria_dinars')); ?></option>
                        <option value="ARP" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='ARP'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_argentina_pesos')); ?></option>

                        <option value="AUD" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='AUD'): echo 'selected="selected"'; endif; ?>> <?php echo html_escape($this->lang->line('ltr_admin_plan_popup_australia_dollars')); ?></option>

                        <option value="ATS" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='ATS'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_austria_schillings')); ?></option>
                        <option value="BSD" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='BSD'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_bahamas_dollars')); ?></option>
                        <option value="BBD" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='BBD'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_barbados_dollars')); ?></option>
                        <option value="BEF" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='BEF'): echo 'selected="selected"'; endif; ?>> <?php echo html_escape($this->lang->line('ltr_admin_plan_popup_belgium_francs')); ?></option>
                        <option value="BMD" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='BMD'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_bermuda_dollars')); ?></option>
                        <option value="BRR" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='BRR'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_brazil_real')); ?></option>
                        <option value="BGL" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='BGL'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_bulgaria_lev')); ?></option>
                        <option value="CAD" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='CAD'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_canada_dollars')); ?></option>
                        <option value="CLP" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='CLP'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_chile_pesos')); ?></option>
                        <option value="CNY" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='CNY'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_china_yuan_renmimbi')); ?></option>
                        <option value="CYP" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='CYP'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_cyprus_pounds')); ?></option>
                        <option value="CSK" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='CSK'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_czech_republic_koruna')); ?></option>
                        <option value="DKK" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='DKK'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_denmark_kroner')); ?></option>
                        <option value="NLG" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='NLG'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_dutch_guilders')); ?></option>
                        <option value="XCD" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='XCD'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_eastern_caribbean_dollars')); ?></option>
                        <option value="EGP" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='EGP'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_egypt_pounds')); ?></option>
                        <option value="FJD" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='FJD'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_fiji_dollars')); ?></option>
                        <option value="FIM" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='FIM'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_finland_markka')); ?></option>
                        <option value="FRF" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='FRF'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_france_francs')); ?></option>
                        <option value="DEM" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='DEM'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_germany_deutsche_marks')); ?></option>
                        <option value="XAU" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='XAU'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_gold_ounces')); ?></option>
                        <option value="GRD" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='GRD'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_greece_drachmas')); ?></option>
                        <option value="HKD" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='HKD'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_hong_kong_dollars')); ?></option>
                        <option value="HUF" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='HUF'): echo 'selected="selected"'; endif; ?>> <?php echo html_escape($this->lang->line('ltr_admin_plan_popup_hungary_forint')); ?></option>
                        <option value="ISK" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='ISK'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_iceland_krona')); ?></option>
                        <option value="INR" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='INR'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_india_rupees')); ?></option>
                        <option value="IDR" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='IDR'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_indonesia_rupiah')); ?></option>
                        <option value="IEP" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='IEP'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_ireland_punt')); ?></option>
                        <option value="ILS" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='ILS'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_israel_new_shekels')); ?></option>
                        <option value="ITL" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='ITL'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_italy_lira')); ?></option>
                        <option value="JMD" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='JMD'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_jamaica_dollars')); ?></option>
                        <option value="JPY" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='JPY'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_japan_yen')); ?></option>
                        <option value="JOD" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='JOD'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_jordan_dinar')); ?></option>
                        <option value="KRW" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='KRW'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_korea_south_won')); ?></option>
                        <option value="LBP" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='LBP'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_lebanon_pounds')); ?></option>
                        <option value="LUF" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='LUF'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_luxembourg_francs')); ?></option>
                        <option value="MYR" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='MYR'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_malaysia_ringgit')); ?></option>
                        <option value="MXP" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='MXP'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_mexico_pesos')); ?></option>
                        <option value="NLG" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='NLG'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_netherlands_guilders')); ?></option>
                        <option value="NZD" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='NZD'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_new_zealand_dollars')); ?></option>
                        <option value="NOK" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='NOK'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_norway_kroner')); ?></option>
                        <option value="PKR" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='PKR'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_pakistan_rupees')); ?></option>
                        <option value="XPD" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='XPD'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_palladium_ounces')); ?></option>
                        <option value="PHP" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='PHP'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_philippines_pesos')); ?></option>
                        <option value="XPT" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='XPT'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_platinum_ounces')); ?></option>
                        <option value="PLZ" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='PLZ'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_poland_zloty')); ?></option>
                        <option value="PTE" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='PTE'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_portugal_escudo')); ?></option>
                        <option value="ROL" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='ROL'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_romania_leu')); ?></option>
                        <option value="RUR" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='RUR'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_russia_rubles')); ?></option>
                        <option value="SAR" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='SAR'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_saudi_arabia_riyal')); ?></option>
                        <option value="XAG" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='XAG'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_silver_ounces')); ?></option>
                        <option value="SGD" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='SGD'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_singapore_dollars')); ?></option>
                        <option value="SKK" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='SKK'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_Slovakia_koruna')); ?></option>
                        <option value="ZAR" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='ZAR'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_south_africa_rand')); ?></option>
                        <option value="KRW" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='KRW'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_south_korea_won')); ?></option>
                        <option value="ESP" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='ESP'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_spain_pesetas')); ?></option>
                        <option value="XDR" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='XDR'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_special_drawing_right')); ?></option>
                        <option value="SDD" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='SDD'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_sudan_dinar')); ?></option>
                        <option value="SEK" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='SEK'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_sweden_krona')); ?></option>
                        <option value="CHF" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='CHF'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_switzerland_francs')); ?></option>
                        <option value="TWD" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='TWD'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_taiwan_dollars')); ?></option>
                        <option value="THB" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='THB'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_thailand_baht')); ?></option>
                        <option value="TTD" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='TTD'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_trinidad_and_tobago_dollars')); ?></option>
                        <option value="TRL" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='TRL'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_turkey_lira')); ?></option>
                        <option value="VEB" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='VEB'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_venezuela_bolivar')); ?></option>
                        <option value="ZMK" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='ZMK'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_zambia_Kwacha')); ?></option>
                        <option value="EUR" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='EUR'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_euro')); ?></option>
                        <option value="XCD" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='XCD'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_eastern_caribbean_dollars')); ?></option>
                        <option value="XDR" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='XDR'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_special_drawing_right')); ?></option>
                        <option value="XAG" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='XAG'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_silver_ounces')); ?></option>
                        <option value="XAU" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='XAU'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_gold_ounces')); ?></option>
                        <option value="XPD" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='XPD'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_palladium_ounces')); ?></option>

                        <option value="XPT" <?php if(isset($subscription_plans[0]['pl_currency']) && $subscription_plans[0]['pl_currency']=='XPT'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_platinum_ounces')); ?></option>
                    </select> 
                </div>
                <div class="pg-input-holder">
                    <label for="plan_type"><?php echo html_escape($this->lang->line('ltr_planType')); ?></label>
                    <select  id="plan_type" name="planType">                        
                        <option value="free" <?php if(isset($subscription_plans[0]['plan_type']) && $subscription_plans[0]['plan_type']=='free'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_free')); ?></option>
                        <option value="paid" <?php if(isset($subscription_plans[0]['plan_type']) && $subscription_plans[0]['plan_type']=='paid'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_paid')); ?></option>
                    </select>  
                </div>
                <?php
                if($subscription_plans[0]['plan_type']!="free"){
                    ?>
                        <div class="pg-input-holder paidPlan">
                            <label for="price_plans"><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_price')); ?></label>
                            <input type="text"  value="<?php if(isset($subscription_plans[0]['pl_price'])): echo html_escape($subscription_plans[0]['pl_price']); endif; ?>" id="price_plans" name="price_plans">
                        </div>                      
                    <?php
                }
                ?>
                <div class="pg-input-holder">
                    <label for="interval_set"><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_interval')); ?></label>
                    <select  id="interval_set" name="interval_set">
                        <option value="7" <?php if(isset($subscription_plans[0]['interval']) && $subscription_plans[0]['interval']=='7'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_week')); ?></option>
                        <option value="31" <?php if(isset($subscription_plans[0]['interval']) && $subscription_plans[0]['interval']=='31'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_month')); ?></option>
                        <option value="183" <?php if(isset($subscription_plans[0]['interval']) && $subscription_plans[0]['interval']=='183'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_half_year')); ?></option>
                        <option value="365" <?php if(isset($subscription_plans[0]['interval']) && $subscription_plans[0]['interval']=='365'): echo 'selected="selected"'; endif; ?>><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_year')); ?></option>
                    </select>  
                </div> 
                <div class="pg-input-holder">
                   <label for="plane_description"><?php echo html_escape($this->lang->line('ltr_admin_plan_popup_plan_description')); ?></label>
                   <textarea id="plane_description" name="plane_description" rows="4" cols="50" value="<?php if(isset($subscription_plans[0]['plan_description'])): echo html_escape($subscription_plans[0]['plan_description']); endif; ?>">
                   <?php if(isset($subscription_plans[0]['plan_description'])): echo sprintf("%s",$subscription_plans[0]['plan_description']); endif; ?></textarea>
                </div>
                <div class="pg-input-holder text-center">
                   <input type="hidden"  value="<?php if(isset($subscription_plans[0]['pl_id'])): echo html_escape($subscription_plans[0]['pl_id']); endif; ?>" id="plan_id">
                    <button type="submit" class="pg-btn pg-btn-lg" id="update_pricing_plan"><?php echo html_escape($this->lang->line('ltr_update_plan')); ?></button> 
                </div>
            </form>
         </div> 
     </div>
</div> 
<?php } ?>  