<?php
    $this->load->helper('form');
?>
<link rel="stylesheet" href="<?php echo base_url();?>public/css/one.css">
<!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>UPDATE</strong></h2>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" action="<?php echo site_url('upc/update');?>" method="POST">
                            <input type="hidden" name="id" value="<?php echo $upc->id ?>">
                            <!-- progressbar -->
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title mb-1">UPC Information</h2>
                                    <div class="row mt-5">
                                        <div class="col-2">
                                            <label class="pay">SKU</label>
                                        </div>
                                        <div class="col-4">
                                            <?php echo form_input(array('name' => 'sku','placeholder'=>"SKU", 'value'=>$upc->sku));?>
                                        </div>
                                        <div class="col-2">
                                            <label class="pay">UPC</label>
                                        </div>
                                        <div class="col-4">
                                            <?php echo form_input(array('name' => 'upc','placeholder'=>"UPC", 'value'=>$upc->upc));?>
                                        </div>
                                        
                                    </div>
                                </div>
                                <a type="submit" class="action-button" href="<?php echo site_url('/upc')?>">Back</a>
                                <input type="submit" class="action-button" id="create_header" value="SAVE"/>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
