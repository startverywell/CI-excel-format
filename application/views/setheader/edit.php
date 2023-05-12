<?php
    $this->load->helper('form');
?>
<h1 class="mt-4">EDIT SHIPMENT HEADER</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"></li>
</ol>
<form id="set_header" action="<?php echo site_url('setheader/update');?>" method="POST">
    <?php echo validation_errors(); ?>  
    <?php echo form_open('form'); ?> 
    <?php echo form_hidden('id', $header->id);?>
    <div class="form-group mt-3">
        <label class="mb-2" for="shipment_id">SELECT SHIPMENT</label>
        <?php echo form_dropdown('shipment_id', $options, $header->shipment_id, ['class'=>'form-control']); ?> 
    </div> 
    <div class="form-group mt-3">
        <label class="mb-2" for="date_entered">DATE ENTERED</label>
        <?php echo form_input(array('name' => 'date_entered', 'class' => 'form-control','placeholder'=>"YYYY-mm-dd", 'value'=>$header->date_entered));?>
    </div>
    <div class="form-group mt-3">
        <label class="mb-2" for="shipment_type">SELECT SHIPMENT TYPE</label>
        <?php echo form_dropdown('shipment_type', ['DOM'=>'DOM','PTD'=>'PTD','FOB'=>'FOB','MDDP'=>'MDDP'], $header->shipment_type, ['class'=>'form-control']); ?> 
    </div>
    <div class="form-group mt-3">
        <label class="mb-2" for="factory">FACTORY</label>
        <?php echo form_input(array('name' => 'factory', 'class' => 'form-control','placeholder'=>"Factory name", 'value'=>$header->factory));?>
    </div>
    <div class="form-group mt-3">
        <label class="mb-2" for="carrier">CARRIER</label>
        <?php echo form_input(array('name' => 'carrier', 'class' => 'form-control','placeholder'=>"CARRIER", 'value'=>$header->carrier));?>        
    </div>
    <div class="form-group mt-3">
        <label class="mb-2" for="bl">BL#</label>
        <?php echo form_input(array('name' => 'bl', 'class' => 'form-control','placeholder'=>"BL#", 'value'=>$header->bl));?>
    </div>
    <div class="form-group mt-3">
        <label class="mb-2" for="bill_date">BILL/INV DATE</label>
        <?php echo form_input(array('name' => 'bill_date', 'class' => 'form-control','placeholder'=>"BILL/INV DATE", 'value'=>$header->bill_date));?>
    </div>
    <div class="form-group mt-3">
        <label class="mb-2" for="docs_date">DOCS RCVD DATE</label>
        <?php echo form_input(array('name' => 'docs_date', 'class' => 'form-control','placeholder'=>"DOCS RCVD DATE", 'value'=>$header->docs_date));?>
    </div>
    <div class="form-group mt-3">
        <label class="mb-2" for="bill">Bill#</label>
        <?php echo form_input(array('name' => 'bill', 'class' => 'form-control','placeholder'=>"Bill#", 'value'=>$header->bill));?>
    </div>
    <div class="form-group mt-3">
        <label class="mb-2" for="amount">Amount</label>
        <?php echo form_input(array('name' => 'amount', 'class' => 'form-control','placeholder'=>"Amount", 'value'=>$header->amount));?>
    </div>
    <div class="row mt-5" style="justify-content: center;">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <button class="btn btn-primary" type="submit">SAVE SHIPMENT HEADER</button>
        </div>
        <div class="col-md-3"></div>
    </div>
</form>
