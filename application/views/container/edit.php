<?php
    $this->load->helper('form');
?>
<h1 class="mt-4">UPDATE CONTAINER</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"></li>
</ol>
<form id="set_header" action="<?php echo site_url('container/update');?>" method="POST">
    <?php echo validation_errors(); ?>  
    <?php echo form_open('form'); ?> 
    <?php echo form_hidden('id', $container->id);?>
    <div class="form-group mt-3">
        <label class="mb-2" for="shipment_id">SELECT SHIPMENT</label>
        <?php echo form_dropdown('shipment_id', $options, $container->shipment_id, ['class'=>'form-control']); ?> 
    </div> 
    <div class="form-group mt-3">
        <label class="mb-2" for="name">CONTAINER NAME</label>
        <?php echo form_input(array('name' => 'name', 'class' => 'form-control','placeholder'=>"CONTAINER NAME", 'value'=>$container->name));?>
    </div>
    <div class="row mt-5" style="justify-content: center;">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <a class="btn btn-success" href="<?php echo site_url('/container/one/'.$container->shipment_id)?>">Back</a>
            <button class="btn btn-primary" type="submit">SAVE CONTAINER</button>
        </div>
        <div class="col-md-3"></div>
    </div>
</form>
