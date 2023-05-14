<?php
    $this->load->helper('form');
?>
<link rel="stylesheet" href="<?php echo base_url();?>public/css/one.css">
<!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>CREATE A SHIPMENT</strong></h2>
                <p>Fill all form field to go to next step</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" action="<?php echo site_url('container/save');?>" method="POST">
                            <?php echo form_hidden('shipment_id', $shipment_id);?>
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li id="payment"><strong>SHIPMENT</strong></li>
                                <li class="active" id="payment"><strong>HEADER</strong></li>
                                <li id="payment"><strong>CONTAINER</strong></li>
                                <li id="confirm"><strong>PACKING LIST</strong></li>
                                <li id="confirm"><strong>CHECK BILL</strong></li>
                                <li id="confirm"><strong>CHECK PO</strong></li>
                                <li id="confirm"><strong>GENERATE</strong></li>
                            </ul>
                            <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title mb-5">HEADER Information</h2>
                                    <input type="text" id= "name" name="name" placeholder="CONTAINER NAME"/>
                                
                                <input type="submit" name="next" class="action-button" value="Next Step" id="create_header"/>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
