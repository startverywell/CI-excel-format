<?php
    $this->load->helper('form');
?>
<link rel="stylesheet" href="<?php echo base_url();?>public/css/one.css">
<!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>CREATE A CONTAINER</strong></h2>
                <p>Fill all form field to go to next step</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" >
                            <?php echo form_hidden('shipment_id', $shipment_id);?>
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li id="shipment"><strong>SHIPMENT</strong></li>
                                <li id="header_icon"><strong>ISL HEADER</strong></li>
                                <li class="active" id="header_copy"><strong>HEADER COPY</strong></li>
                                <li id="container"><strong>ISL DETAIL</strong></li>
                                <li id="packing"><strong>PACKING LIST</strong></li>
                                <li id="confirm"><strong>CREATE QB BILL</strong></li>
                                <li id="confirm"><strong>UPDATE QB PO's</strong></li>
                                <li id="download"><strong>GENERATE</strong></li>
                            </ul>
                            <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <div class="row mt-3">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>NAME</th>
                                                    <th>DATE ENTERED</th>
                                                    <th>TYPE</th>
                                                    <th>FACTORY</th>
                                                    <th>CARRIER</th>
                                                    <th>BL#</th>
                                                    <th>BILL/INV DATE</th>
                                                    <th>DOCS RCVD DATE</th>
                                                    <th>BILL#</th>
                                                    <th>AMOUNT</th>
                                                </tr>
                                            </thead>
                                            <tbody>   
                                                <tr class="table-primary">
                                                    <td><?php echo $header->shipment_name?></td>
                                                    <td><?php echo $header->date_entered?></td>
                                                    <td><?php echo $header->shipment_type?></td>
                                                    <td><?php echo $header->factory?></td>
                                                    <td><?php echo $header->carrier?></td>
                                                    <td><?php echo $header->bl?></td>
                                                    <td><?php echo $header->bill_date?></td>
                                                    <td><?php echo $header->docs_date?></td>
                                                    <td><?php echo $header->bill?></td>
                                                    <td><?php echo $header->amount?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- <input type="button" class="action-button-previous"/> -->
                                <a href="<?php echo site_url('container/one/'.$shipment_id)?>" class="action-button" id="create_container"/>Next Step</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
