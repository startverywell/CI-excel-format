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
                        <form id="msform" action="<?php echo site_url('pllist/update');?>" method="POST">
                            <input type="hidden" name="id" value="<?php echo $pl->id ?>">
                            <!-- progressbar -->
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title mb-1">3PL Information</h2>
                                    <div class="row">
                                        <div class="col-2">
                                            <label class="pay">SKU</label>
                                        </div>
                                        <div class="col-4">
                                            <?php echo form_input(array('name' => 'sku','placeholder'=>"SKU", 'value'=>$pl->sku));?>
                                        </div>
                                        <div class="col-2">
                                            <label class="pay">Pack</label>
                                        </div>
                                        <div class="col-4">
                                            <?php echo form_input(array('name' => 'pack','placeholder'=>"Pack", 'value'=>$pl->pack));?>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-2">
                                            <label class="pay">DESCRIPTION</label>
                                        </div>
                                        <div class="col-4">
                                            <?php echo form_input(array('name' => 'description','placeholder'=>"DESCRIPTION", 'value'=>$pl->description));?>
                                        </div>
                                        <div class="col-2">
                                            <label class="pay">Length</label>
                                        </div>
                                        <div class="col-4">
                                            <?php echo form_input(array('name' => 'length','placeholder'=>"Length", 'value'=>$pl->length));?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">
                                            <label class="pay">DESCRIPTION2</label>
                                        </div>
                                        <div class="col-4">
                                            <?php echo form_input(array('name' => 'description2','placeholder'=>"DESCRIPTION2", 'value'=>$pl->description2));?>
                                        </div>
                                        <div class="col-2">
                                            <label class="pay">Width</label>
                                        </div>
                                        <div class="col-4">
                                            <?php echo form_input(array('name' => 'width','placeholder'=>"Width", 'value'=>$pl->width));?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">
                                            <label class="pay">Packing UoM QTY</label>
                                        </div>
                                        <div class="col-4">
                                            <?php echo form_input(array('name' => 'qty','placeholder'=>"Packing UoM QTY", 'value'=>$pl->qty));?>
                                        </div>
                                        <div class="col-2">
                                            <label class="pay">Height</label>
                                        </div>
                                        <div class="col-4">
                                            <?php echo form_input(array('name' => 'height','placeholder'=>"Height", 'value'=>$pl->height));?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">
                                            <label class="pay">Style Category</label>
                                        </div>
                                        <div class="col-4">
                                            <?php echo form_input(array('name' => 'style','placeholder'=>"Style Category", 'value'=>$pl->style));?>
                                        </div>
                                        <div class="col-2">
                                            <label class="pay">Weight</label>
                                        </div>
                                        <div class="col-4">
                                            <?php echo form_input(array('name' => 'weight','placeholder'=>"Weight", 'value'=>$pl->weight));?>
                                        </div>
                                        
                                    </div>
                                </div>
                                <a type="submit" class="action-button" href="<?php echo site_url('/pllist')?>">Back</a>
                                <input type="submit" class="action-button" id="create_header" value="SAVE"/>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
