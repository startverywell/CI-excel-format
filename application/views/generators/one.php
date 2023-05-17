<?php
    $this->load->helper('form');
?>
<link rel="stylesheet" href="<?php echo base_url();?>public/css/one.css">
<!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>GENERATE</strong></h2>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" action="<?php echo site_url('/generators/make');?>" method="POST" name="savedetail">
                            <?php echo form_hidden('shipment_id', $shipment_id);?>
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li id="shipment"><strong>SHIPMENT</strong></li>
                                <li id="header_icon"><strong>ISL HEADER</strong></li>
                                <li id="header_copy"><strong>HEADER COPY</strong></li>
                                <li id="container"><strong>ISL DETAIL</strong></li>
                                <li id="packing"><strong>PACKING LIST</strong></li>
                                <li id="confirm"><strong>CREATE QB BILL</strong></li>
                                <li id="confirm"><strong>UPDATE QB PO's</strong></li>
                                <li class="active" id="download"><strong>GENERATE</strong></li>
                            </ul>
                            <!-- fieldsets -->
                            <fieldset></fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title mb-2">GENERATE</h2>
                                </div>
                                <input type="submit" class="action-button" id="create_details" value= "GENERATE"/>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
