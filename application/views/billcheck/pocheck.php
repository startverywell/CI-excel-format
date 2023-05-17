<?php
    $this->load->helper('form');
?>
<link rel="stylesheet" href="<?php echo base_url();?>public/css/one.css">
<!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>UPDATE QB PO's</strong></h2>
                <p>Click CHECK button to go to next step</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" action="<?php echo site_url('billcheck/checkall');?>" method="POST">
                            <?php echo form_hidden('id', $header->id);?>
                            <?php echo form_hidden('shipment_id', $header->shipment_id);?>
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li id="shipment"><strong>SHIPMENT</strong></li>
                                <li id="header_icon"><strong>ISL HEADER</strong></li>
                                <li id="header_copy"><strong>HEADER COPY</strong></li>
                                <li id="container"><strong>ISL DETAIL</strong></li>
                                <li id="packing"><strong>PACKING LIST</strong></li>
                                <li id="confirm"><strong>CREATE QB BILL</strong></li>
                                <li class="active" id="confirm"><strong>UPDATE QB PO's</strong></li>
                                <li id="download"><strong>GENERATE</strong></li>
                            </ul>
                            <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title mb-2">UPDATE QB PO's</h2>
                                    <h4 class="mb-5"><?php echo $header->shipment_name?></h4>
                                    <div class="row">
                                        <!-- DataTable -->
                                        <table id="detail-table" class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Container</th>
                                                    <th>PO#</th>
                                                    <th>SKU</th>
                                                    <th>DESCRIPTION</th>
                                                    <th>3PL NEW?</th>
                                                    <th>ASST</th>
                                                    <th>SINGLE TOPS</th>
                                                    <th>MULTI TOPS</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $no = 1;
                                                if ($details != false) {
                                                    foreach ($details as $detali) {
                                                        echo '<tr>';
                                                        echo '<td>'.$no++.'</td>';
                                                        echo '<td>'.$detali->container_name.'</td>';
                                                        echo '<td>'.$detali->po.'</td>';
                                                        echo '<td>'.$detali->style.'</td>';
                                                        echo '<td>'.$detali->description.'</td>';
                                                        echo '<td>'.($detali->pl_new==1 ? '<i class="fa-solid fa-check" style="color: #2df41f;"></i>' :'').'</td>';
                                                        echo '<td>'.($detali->asst==1 ? '<i class="fa-solid fa-check" style="color: #2df41f;"></i>' :'').'</td>';
                                                        echo '<td>'.($detali->single_top==1 ? '<i class="fa-solid fa-check" style="color: #2df41f;"></i>' :'').'</td>';
                                                        echo '<td>'.($detali->multi_top==1 ? '<i class="fa-solid fa-check" style="color: #2df41f;"></i>' :'').'</td>';
                                                        echo '<td>
                                                                <a class="btn" href="../../setdetails/view/'.$detali->id.'">
                                                                    <i class="fa-solid fa-eye" style="color: green;"></i>
                                                                </a> 
                                                                <a class="btn" href="../../setdetails/updateView/'.$detali->id.'">
                                                                    <i class="fa-solid fa-pencil fa-beat-fade" style="color: blue;"></i>
                                                                </a>
                                                                <a class="btn" href="../../setdetails/delete/'.$detali->id.'">
                                                                    <i class="fa-regular fa-trash-can" style="color: red;"></i>
                                                                </a>
                                                            </td>';
                                                        echo '</tr>';
                                                    }
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                        <!-- /.DataTable -->
                                    </div>
                                </div>
                                <a type="button" class="previous action-button-previous" href="<?php echo site_url('/billcheck/billone/'.$header->shipment_id)?>">Previous</a>
                                <input type="submit" class="action-button" id="check_bill"  value="CREATE"/>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
