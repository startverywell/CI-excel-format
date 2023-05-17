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
                            <?php echo form_hidden('shipmpent_id', $shipmpent_id);?>
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li id="payment"><strong>SHIPMENT</strong></li>
                                <li id="payment"><strong>ISL HEADER</strong></li>
                                <li id="header_copy"><strong>HEADER COPY</strong></li>
                                <li id="payment"><strong>ISL DETAIL</strong></li>
                                <li id="confirm"><strong>PACKING LIST</strong></li>
                                <li id="confirm"><strong>CHECK BILL</strong></li>
                                <li id="confirm"><strong>CHECK PO</strong></li>
                                <li id="confirm"><strong>GENERATE</strong></li>
                                <li class="active" id="confirm"><strong>SUCCESS</strong></li>
                            </ul>
                            <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title text-center">Success !</h2>
                                    <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-3">
                                            <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image">
                                        </div>
                                    </div>
                                    <br><br>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
