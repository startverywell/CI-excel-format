<?php
    $this->load->helper('form');
?>
<h1 class="mt-4">Update DATAS : <?php echo $header_title;?></h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"></li>
</ol>
<form id="set_header" action="<?php echo site_url('setdetails/detailSave');?>" method="POST">
    <?php echo validation_errors(); ?>  
    <?php echo form_open('form'); ?> 
    <?php echo form_hidden('id', $detail->id);?>
    <?php echo form_hidden('shipment_id', $detail->shipment_id);?>
    <?php echo form_hidden('container_id', $detail->container_id);?>
    <div class="form-group mt-3">
        <div class="row">
            <label class="mb-2" for="po">PO</label>
            <?php echo form_input(array('name' => 'po', 'class' => 'form-control', 'value'=>$detail->po));?>
        </div>
        <div class="row">
            <label class="mb-2" for="style">STYLE</label>
            <?php echo form_input(array('name' => 'style', 'class' => 'form-control', 'value'=>$detail->style));?>
        </div>
        <div class="row">
            <label class="mb-2" for="description">DESCRIPTION </label>
            <?php echo form_input(array('name' => 'description', 'class' => 'form-control', 'value'=>$detail->description));?>
        </div>
        <div class="row">
            <label class="mb-2" for="hts">HTS</label>
            <?php echo form_input(array('name' => 'hts', 'class' => 'form-control', 'value'=>$detail->hts));?>
        </div>
        <div class="row">
            <label class="mb-2" for="pcs_carton">PCS/CARTON</label>
            <?php echo form_input(array('name' => 'pcs_carton', 'class' => 'form-control', 'value'=>$detail->pcs_carton));?>
        </div>
        <div class="row">
            <label class="mb-2" for="ctn">CTN </label>
            <?php echo form_input(array('name' => 'ctn', 'class' => 'form-control', 'value'=>$detail->ctn));?>
        </div>
        <div class="row">
            <label class="mb-2" for="total">TOTAL </label>
            <?php echo form_input(array('name' => 'total', 'class' => 'form-control', 'value'=>$detail->total));?>
        </div>
        <div class="row">
            <label class="mb-2" for="uom">UoM</label>
            <?php echo form_input(array('name' => 'uom', 'class' => 'form-control', 'value'=>$detail->uom));?>
        </div>
        <div class="row">
            <label class="mb-2" for="ds">DS </label>
            <?php echo form_input(array('name' => 'ds', 'class' => 'form-control', 'value'=>$detail->ds));?>
        </div>
        <div class="row">
            <label class="mb-2" for="customer">CUSTOMER  </label>
            <?php echo form_input(array('name' => 'customer', 'class' => 'form-control', 'value'=>$detail->customer));?>
        </div>
        <div class="row">
            <label class="mb-2" for="ship">SHIP  </label>
            <?php echo form_input(array('name' => 'ship', 'class' => 'form-control', 'value'=>$detail->ship));?>
        </div>
        <div class="row">
            <label class="mb-2" for="cancel">CANCEL  </label>
            <?php echo form_input(array('name' => 'cancel', 'class' => 'form-control', 'value'=>$detail->cancel));?>
        </div>
        <div class="row">
            <label class="mb-2" for="customer_po">CUSTOMER PO </label>
            <?php echo form_input(array('name' => 'customer_po', 'class' => 'form-control', 'value'=>$detail->customer_po));?>
        </div>
        <div class="row">
            <label class="mb-2" for="so">SO  </label>
            <?php echo form_input(array('name' => 'so', 'class' => 'form-control', 'value'=>$detail->so));?>
        </div>
        <div class="row">
            <label class="mb-2" for="inv">INV  </label>
            <?php echo form_input(array('name' => 'inv', 'class' => 'form-control', 'value'=>$detail->inv));?>
        </div>
        <div class="row">
            <label class="mb-2" for="ext_req">EXT REQ </label>
            <?php echo form_input(array('name' => 'ext_req', 'class' => 'form-control', 'value'=>$detail->ext_req));?>
        </div>
        <div class="row">
            <label class="mb-2" for="rcvd">RCVD  </label>
            <?php echo form_input(array('name' => 'rcvd', 'class' => 'form-control', 'value'=>$detail->rcvd));?>
        </div>
        <div class="row">
            <label class="mb-2" for="short_over">SHORT/OVER </label>
            <?php echo form_input(array('name' => 'short_over', 'class' => 'form-control', 'value'=>$detail->short_over));?>
        </div>
        <div class="row">
            <label class="mb-2" for="notes">NOTES  </label>
            <?php echo form_input(array('name' => 'notes', 'class' => 'form-control', 'value'=>$detail->notes));?>
        </div>
        <div class="row">
            <label class="mb-2" for="upc">UPC </label>
            <?php echo form_input(array('name' => 'upc', 'class' => 'form-control', 'value'=>$detail->upc));?>
        </div>
        <div class="row">
            <label class="mb-2" for="length">Length  </label>
            <?php echo form_input(array('name' => 'length', 'class' => 'form-control', 'value'=>$detail->length));?>
        </div>
        <div class="row">
            <label class="mb-2" for="width">Width  </label>
            <?php echo form_input(array('name' => 'width', 'class' => 'form-control', 'value'=>$detail->width));?>
        </div>
        <div class="row">
            <label class="mb-2" for="height">Height  </label>
            <?php echo form_input(array('name' => 'height', 'class' => 'form-control', 'value'=>$detail->height));?>
        </div>
        <div class="row">
            <label class="mb-2" for="weight">Weight  </label>
            <?php echo form_input(array('name' => 'weight', 'class' => 'form-control', 'value'=>$detail->weight));?>
        </div>
        <div class="row">
            <label class="mb-2" for="cbm">CBM   </label>
            <?php echo form_input(array('name' => 'cbm', 'class' => 'form-control', 'value'=>$detail->cbm));?>
        </div>
        <div class="row">
            <label class="mb-2" for="price">Price  </label>
            <?php echo form_input(array('name' => 'price', 'class' => 'form-control', 'value'=>$detail->price));?>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="pl_new" name="pl_new" value=<?php echo $detail->pl_new?> <?php echo $detail->pl_new==1 ? 'checked' : '' ?> disabled>
            <label class="form-check-label">3PL New?</label>
        </div> 
        <div class="row">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="single_top" name="single_top" value=<?php echo $detail->single_top?> <?php echo $detail->single_top==1 ? 'checked' : '' ?>>
                <label class="form-check-label">Single Top</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="multi_top" name="multi_top" value=<?php echo $detail->multi_top?> <?php echo $detail->multi_top==1 ? 'checked' : '' ?>>
                <label class="form-check-label">Multi Top</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="asst" name="asst" value=<?php echo $detail->asst?> <?php echo $detail->asst==1 ? 'checked' : '' ?>>
                <label class="form-check-label">Asst</label>
            </div>
        </div>
          
    </div>
    <!-- <div class="form-group mt-3">
        <label class="mb-2" for="pl">3PL</label>
        <input type="checkbox" class="form-control" id="pl" name="pl">
    </div> -->
    <div class="row mt-5" style="justify-content: center;">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <a class="btn btn-success" href="<?php echo site_url('/container/one/'.$detail->shipment_id)?>">Back</a>
            <button class="btn btn-primary" type="submit">SAVE Detail</button>
        </div>
        <div class="col-md-3"></div>
    </div>
</form>