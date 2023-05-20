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
                        <form id="msform" action="<?php echo site_url('dragdrop/save');?>" method="POST" enctype="multipart/form-data">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="shipment"><strong>SHIPMENT</strong></li>
                                <li id="header_icon"><strong>ISL HEADER</strong></li>
                                <li id="header_copy"><strong>HEADER COPY</strong></li>
                                <li id="packing"><strong>ISL DETAIL</strong></li>
                                <li id="container"><strong>CONTAINER/PACKING LIST</strong></li>
                                <li id="confirm"><strong>CONFIRM QB BILL CREATED</strong></li>
                                <li id="confirm"><strong>REVIEW CONTAINERS</strong></li>
                                <li id="download"><strong>GENERATE</strong></li>
                            </ul>
                            <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title mb-5">SHIPMENT Information</h2>
                                    <div class="col-3">
                                        <label class="pay">SHIPMENT NAME(S#)</label>
                                    </div>
                                    <div class="col-9">
                                        <?php echo form_input(array('name' => 'name','placeholder'=>"S#"));?>
                                    </div>
                                    <!-- <input type="text" id= "name" name="name" placeholder="Folder Name"/> -->
                                    <div class="row mt-5">
                                        <div class="col-md-3">
                                            <div class="card bg-success text-white mb-4">
                                                <input class="file-upload" id="upload1" name="input_1_name" type="file" value="">
                                                <p class="card-body" id="name1">Drag your Bill of Lading file here or click in this area.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card bg-info text-white mb-4">
                                                <input class="file-upload" id="upload2" name="input_2_name" type="file" value="">
                                                <p class="card-body" id="name2">Drag your invoice file here or click in this area.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card bg-primary text-white mb-4">
                                                <input class="file-upload" id="upload3" name="input_3_name" type="file" value="">
                                                <p class="card-body" id="name3">Drag your paking list here or click in this area.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card bg-danger text-white mb-4">
                                                <input class="file-upload" id="upload4" name="input_4_name[]" type="file" value="" multiple>
                                                <p class="card-body" id="name4">Drag your extra file here or click in this area.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" name="next" class="action-button" value="Next Step" id="create_shipment"/>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
