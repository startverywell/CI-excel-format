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
                        <form id="msform" action="<?php echo site_url('setheader/save');?>" method="POST">
                            <?php echo form_hidden('shipment_id', $shipment_id);?>
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li id="shipment"><strong>SHIPMENT</strong></li>
                                <li class="active" id="header_icon"><strong>ISL HEADER</strong></li>
                                <li id="header_copy"><strong>HEADER COPY</strong></li>
                                <li id="packing"><strong>ISL DETAIL</strong></li>
                                <li id="container"><strong>CONTAINER/PACKING LIST</strong></li>
                                <li id="confirm"><strong>CREATE QB BILL</strong></li>
                                <li id="confirm"><strong>REVIEW CONTAINERS</strong></li>
                                <li id="download"><strong>GENERATE</strong></li>
                            </ul>
                            <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title mb-1">HEADER Information</h2>
                                    <h5 class="mb-5">SHIPMENT NAEM : <?php echo $shipment_name?></h2>
                                    <div class="row">
                                        <div class="col-2">
                                            <label class="pay">DATE ENTERED</label>
                                        </div>
                                        <div class="col-4">
                                            <?php echo form_input(array('name' => 'date_entered','placeholder'=>"MM-DD-YYYY"));?>
                                        </div>
                                        <div class="col-2">
                                            <label class="pay">BILL/INV DATE</label>
                                        </div>
                                        <div class="col-4">
                                            <?php echo form_input(array('name' => 'bill_date','placeholder'=>"MM-DD-YYYY"));?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">
                                            <label class="pay">SHIPMENT TYPE*</label>
                                        </div>
                                        <div class="col-4">
                                            <?php echo form_dropdown('shipment_type', ['DOM'=>'DOM','PTD'=>'PTD','FOB'=>'FOB','MDDP'=>'MDDP'], '', ['class'=>'list-dt']); ?> 
                                        </div>
                                        <div class="col-2">
                                            <label class="pay">DOCS RCVD DATE</label>
                                        </div>
                                        <div class="col-4">
                                            <?php echo form_input(array('name' => 'docs_date','placeholder'=>"MM-DD-YYYY"));?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">
                                            <label class="pay">FACTORY</label>
                                        </div>
                                        <div class="col-4">
                                            <?php echo form_input(array('name' => 'factory','placeholder'=>"Factory name"));?>
                                        </div>
                                        <div class="col-2">
                                            <label class="pay">BILL#</label>
                                        </div>
                                        <div class="col-4">
                                            <?php echo form_input(array('name' => 'bill','placeholder'=>"BILL#"));?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">
                                            <label class="pay">CARRIER</label>
                                        </div>
                                        <div class="col-4">
                                            <?php echo form_input(array('name' => 'carrier','placeholder'=>"CARRIER"));?>
                                        </div>
                                        <div class="col-2">
                                            <label class="pay">Amount</label>
                                        </div>
                                        <div class="col-4">
                                            <?php echo form_input(array('name' => 'amount','placeholder'=>"Amount"));?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">
                                            <label class="pay">BL#</label>
                                        </div>
                                        <div class="col-10">
                                            <?php echo form_input(array('name' => 'bl','placeholder'=>"BL#"));?>
                                        </div>
                                        
                                    </div>
                                </div>
                                <input type="submit" class="action-button" id="create_header" value="Next Step"/>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
