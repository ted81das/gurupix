<div class="pg-page-title-head">
    <h3><?php echo html_escape($this->lang->line('ltr_Google_Analytics')); ?></h3>
</div>
<div class="pg-analytics-wrapper">
    <form method="post" action="" id="pg_google_analytics_header_scripte">
        <div class="pg-input-holder">
            <label><?php echo html_escape($this->lang->line('ltr_Add_Script_Header')); ?></label>
            <textarea name="header_script" id="header_script"><?php if(!empty($result_header_script[0]['data_value'])): echo $result_header_script[0]['data_value']; endif ; ?></textarea>
        </div>
        <button type="submit" class="pg-btn" name="save_google_analytics_script">Save</button>
    </form>
    <form method="post" action="" id="pg_google_analytics_footer_scripte">
        <div class="pg-input-holder">
            <label><?php echo html_escape($this->lang->line('ltr_Add_Script_footer')); ?></label>
            <textarea name="footer_script" id="footer_script"><?php if(!empty($result_footer_script[0]['data_value'])): echo $result_footer_script[0]['data_value']; endif ; ?></textarea>
        </div>
       <button type="submit" class="pg-btn" name="save_google_analytics_script">Save</button>
    </form>
</div>