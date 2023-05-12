<?php
    $this->load->helper('form');
?>
<h1 class="mt-4">GENERATE EXCEL FILES</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"></li>
</ol>
<div class="row">
    <div class="form-group mt-3">
        <label class="mb-2" for="shipment_id">SELECT SHIPMENT</label>
        <?php echo form_dropdown('shipment_id', $options, '', ['class'=>'form-control', 'id'=>'shipment_id']); ?> 
    </div> 
    <div class="row mt-3">

    </div>
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <button class="btn btn-primary" type="button" id="excel_btn">GENERATOR EXCEL FILES</button>
    </div>
</div>



