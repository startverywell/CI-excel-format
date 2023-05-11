<?php
    $this->load->helper('form');
?>
<h1 class="mt-4">CREATE CONTAINER</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"></li>
</ol>
<form id="set_header" action="<?php echo site_url('container/save');?>" method="POST">
    <?php echo validation_errors(); ?>  
    <?php echo form_open('form'); ?> 
    <div class="form-group mt-3">
        <label class="mb-2" for="shipment_id">SELECT SHIPMENT</label>
        <?php echo form_dropdown('shipment_id', $options, '', ['class'=>'form-control']); ?> 
    </div> 
    <div class="form-group mt-3">
        <label class="mb-2" for="name">CONTAINER NAME</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <!-- <div class="form-group mt-3">
        <label class="mb-2" for="pl">3PL</label>
        <input type="checkbox" class="form-control" id="pl" name="pl">
    </div> -->
    <div class="row mt-5" style="justify-content: center;">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <button class="btn btn-primary" type="submit">SAVE CONTAINER</button>
        </div>
        <div class="col-md-3"></div>
    </div>
</form>
