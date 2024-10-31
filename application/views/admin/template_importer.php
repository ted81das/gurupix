<div class="pg-screen-container">
    <div class="pg-page-title-head">
        <h3><?=html_escape($this->lang->line('ltr_template_importer'));?> </h3>
    </div>
    <div class="pg-content-wrapper">
        <?php 
            if(!empty($importer) && $this->db->table_exists('template_importer')){?>
                <div class="col-lg-12">
                    <div class="pg-page-title-head">
                        <h3><?=html_escape($this->lang->line('ltr_template_importer_1700'));?></h3>
                    </div>                        
                </div> 
            <?php }?>
        <form class="paymentGatewaySetting form" id="smpt_form_setting" enctype="multipart/form-data" method="post">                
            <div class="row">    
               
                    <?php 
                   
                        if ($this->db->table_exists('template_importer')) {
                            if(!empty($importer)){
    
                                $i=1;
                                foreach ($importer as $key => $value) {
                                    $where = array('importe_name'=>$value);
                                    $result = $this->Common_DML->get_data( 'template_importer', $where, '*' );
                                    $finename = explode('.sql',$value);  
                                    $checkUpdateSQL = isset($finename[0])&&$finename[0]=="update_sql"? "UpdateSQL" : "templateImporterPopup";
                                    ?>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                                        <div class="template-import">
                                            <h4><?=isset($finename[0])?$finename[0]:'';?></h4>                                    
                                            <div class="pg-import-btn-wrap">
                                                <?php 
                                                    if(!empty($result)){
                                                        ?>
                                                        <button type="button" class="pg-btn disabled"><?=html_escape($this->lang->line('ltr_alredy_import'));?></button>
                                                        <?php
                                                    }else{
                                                        if($finename[0]=="update_sql"){
                                                            ?>
                                                            <a href="#<?=$checkUpdateSQL;?>"  file-name="<?=$value;?>" class="pg-popup-link pg-btn <?= !empty($result)?'':'updateSQLFile';?>">Update</a>                                                                                   
                                                            <?php
                                                        }else{
                                                        ?>
                                                        <a href="#<?=$checkUpdateSQL;?>"  file-name="<?=$value;?>" class="pg-popup-link pg-btn <?= !empty($result)?'':'changeDomainURL';?>"><?= !empty($result)?html_escape($this->lang->line('ltr_alredy_import')):html_escape($this->lang->line('ltr_change_domain_url'));?></a>                                                                                   
                                                        <?php
                                                        }
                                                    }
                                                ?>
                                            </div>
                                            </div>
                                        </div>
                                    <?php
                                }                    
                            }else{
                                ?>
                                <div class="template-data-not-available text-center"><span class="text-center"><?=html_escape($this->lang->line('ltr_no_template'));?><span></div>
                                <?php
                            }
                        } else {
                             ?>
                             <div class="template-data-not-available text-center"><span class="text-center"><?=html_escape($this->lang->line('ltr_no_database_update_error'));?><span></div>
                             
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="template-import">
                                        <h4>Update.sql</h4>                                    
                                        <div class="pg-import-btn-wrap">
                                            <a href="#UpdateSQL"  file-name="update_sql.sql" class="pg-popup-link pg-btn updateSQLFile">Update</a>        
                                        </div>
                                    </div>
                                </div>
                             <?php
                        }
                        
                    ?>  
            </div>
        </form>

    </div>
</div>





<!-- Create user Modal  -->
<div id="templateImporterPopup" class="pg-modal-wrapper mfp-hide">
    <div class="pg-modal-inner-row text-center">
        <div class="pg-modal-title-wrap">
            <h3><?php echo html_escape($this->lang->line('ltr_replace_domain_url')); ?></h3>
        </div>
        <div class="pg-modal-body">
            <div class="pg-input-holder text-center">
                <label><?php echo html_escape($this->lang->line('ltr_domain_url')); ?></label>
                <input type="text"  value="" id="domainName">
            </div>           
            <div class="pg-modal-btn-wrap text-center">				
                <a href="javascript:;" class="pg-btn pg-btn-lg" id="ImportTemplate"><?php echo html_escape($this->lang->line('ltr_importer')); ?></a> 
            </div>
        </div> 
    </div>
</div>
<!-- Create user Modal  -->
<div id="UpdateSQL" class="pg-modal-wrapper mfp-hide">
    <div class="pg-modal-inner-row">
        <div class="pg-modal-title-wrap text-center ">
            <h3>Are You Sure ?</h3>
        </div>
        <div class="pg-modal-body">
            <div class="pg-input-holder text-center ">  
                <label><?php echo html_escape($this->lang->line('ltr_no_database_update_msg')); ?></label>             
                <input hidden type="text"  value="UpdateSQL" id="domainName">
            </div>           
            <div class="pg-modal-btn-wrap text-center ">				
                <a href="javascript:;" class="pg-btn pg-btn-lg" id="ImportTemplate">Ok</a> 
                <a title="Close (Esc)" type="button" class="mfp-close pg-btn pg-btn-lg">Cancel</a> 
            </div>
        </div> 
    </div>
</div>