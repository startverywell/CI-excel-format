<?php
    $this->load->helper('form');
?>
<link rel="stylesheet" href="<?php echo base_url();?>public/css/one.css">
<!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>ISL DETAIL</strong></h2>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" name="savedetail">
                            <input type="hidden" name="data" value="" id="detail_data">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li id="shipment"><strong>SHIPMENT</strong></li>
                                <li id="header_icon"><strong>ISL HEADER</strong></li>
                                <li id="header_copy"><strong>HEADER COPY</strong></li>
                                <li class="active" id="packing"><strong>ISL DETAIL</strong></li>
                                <li id="container"><strong>CONTAINER/PACKING LIST</strong></li>
                                <li id="confirm"><strong>CREATE QB BILL</strong></li>
                                <li id="confirm"><strong>REVIEW CONTAINERS</strong></li>
                                <li id="download"><strong>GENERATE</strong></li>
                            </ul>
                            <!-- fieldsets -->
                            <fieldset></fieldset>
                            <fieldset>
                                <div class="form-card mp-5">
                                    <h2 class="fs-title mb-2">ISL DETAIL</h2>
                                    <h3 style="text-align:center; color:red">
                                        Please Confirm ISL DETAILS
                                    </h3>
                                    <!-- <div id="exampleParent">
                                        <div id="example1"></div>
                                    </div> -->
                                </div>
                                <a type="button" class="previous action-button-previous" href="<?php echo site_url('container/copy/'.$shipment_id)?>">Previous</a>
                                <a href="<?php echo site_url('container/one/'.$shipment_id)?>" class="action-button" id="create_container">Confirm</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
