<?php
    $this->load->helper('form');
?>
<link rel="stylesheet" href="<?php echo base_url();?>public/css/one.css">
<!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>CREATE QB BILL</strong></h2>
                <p>Click CHECK button to go to next step</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" action="<?php echo site_url('billcheck/update');?>" method="POST">
                            <?php echo form_hidden('id', $header->id);?>
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li id="shipment"><strong>SHIPMENT</strong></li>
                                <li id="header_icon"><strong>ISL HEADER</strong></li>
                                <li id="header_copy"><strong>HEADER COPY</strong></li>
                                <li id="packing"><strong>ISL DETAIL</strong></li>                           
                                <li id="container"><strong>CONTAINER/PACKING LIST</strong></li>
                                <li class="active" id="confirm"><strong>CREATE QB BILL</strong></li>
                                <li id="confirm"><strong>UPDATE QB PO's</strong></li>
                                <li id="download"><strong>GENERATE</strong></li>
                            </ul>
                            <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title mb-2">CREATE QB BILL</h2>
                                    <h4 class="mb-5"><?php echo $header->shipment_name?></h4>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Field</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>   
                                            <tr class="table-primary">
                                                <td>Shipment Name</td>
                                                <td><?php echo $header->shipment_name?></td>
                                            </tr>
                                            <tr class="table-success">
                                                <td>DATE ENTERED </td>
                                                <td><?php echo $header->date_entered?></td>
                                            </tr>
                                            <tr class="table-success">
                                                <td>SHIPMENT TYPE</td>
                                                <td><?php echo $header->shipment_type?></td>
                                            </tr>
                                            <tr class="table-success">
                                                <td>FACTORY</td>
                                                <td><?php echo $header->factory?></td>
                                            </tr>
                                            <tr class="table-success">
                                                <td>CARRIER</td>
                                                <td><?php echo $header->carrier?></td>
                                            </tr>
                                            <tr class="table-info">
                                                <td>BL#</td>
                                                <td><?php echo $header->bl?></td>
                                            </tr>
                                            <tr class="table-info">
                                                <td>BILL/INV DATE</td>
                                                <td><?php echo $header->bill_date?></td>
                                            </tr>
                                            <tr class="table-info">
                                                <td>DOCS RCVD DATE</td>
                                                <td><?php echo $header->docs_date?></td>
                                            </tr>
                                            <tr class="table-info">
                                                <td>Bill#</td>
                                                <td><?php echo $header->bill?></td>
                                            </tr>
                                            <tr class="table-info">
                                                <td>Amount</td>
                                                <td><?php echo $header->amount?></td>
                                            </tr>
                                            <tr class="table-success">
                                                <td>BILL# CHECK</td>
                                                <td>
                                                    <?php echo ($header->bill_check==1 ? '<i class="fa-solid fa-check" style="color: #2df41f;"></i>' :'<i class="fa-solid fa-xmark" style="color: red;"></i>'); ?>
                                                </td>
                                            </tr>
                                            <tr class="table-success">
                                                <td>PO# CHECK</td>
                                                <td>
                                                    <?php echo ($header->po_check==1 ? '<i class="fa-solid fa-check" style="color: #2df41f;"></i>' :'<i class="fa-solid fa-xmark" style="color: red;"></i>'); ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- <input type="button" class="action-button-previous"/> -->
                                <a type="button" class="previous action-button-previous" href="<?php echo site_url('/container/one/'.$header->shipment_id)?>">Previous</a>
                                <input type="submit" class="action-button" id="check_bill"  value="CHECK"/>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
