<?php
    $this->load->helper('form');
?>
<h1 class="mt-4">UPDATE SHIPMENT</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"></li>
</ol>
<form class="form-upload" name="uploadImages" id="uploadImages" action="<?php echo site_url('dragdrop/update');?>" method="POST" enctype="multipart/form-data">
    <?php echo form_hidden('id', $shipment->id);?>    
    <div class="row mb-5">
        <div class="form-group mt-3">
            <label class="mb-2" for="factory">Name</label>
            <?php echo form_input(array('name' => 'name', 'class' => 'form-control','placeholder'=>" name", 'value'=>$shipment->name));?>
        </div>
    </div>
    <div class="row mt-5" style="justify-content: center;">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <button class="upload-buton" type="submit">UPDATE Shipment</button>
        </div>
        <div class="col-md-3"></div>
    </div>
</form>