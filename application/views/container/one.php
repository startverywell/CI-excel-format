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
                        <form id="msform" action="<?php echo site_url('container/save');?>" method="POST">
                            <?php echo form_hidden('shipment_id', $shipment_id);?>
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li id="shipment"><strong>SHIPMENT</strong></li>
                                <li id="header_icon"><strong>ISL HEADER</strong></li>
                                <li id="header_copy"><strong>HEADER COPY</strong></li>
                                <li id="packing"><strong>ISL DETAIL</strong></li>
                                <li class="active" id="container"><strong>CONTAINER/PACKING LIST</strong></li>
                                <li id="confirm"><strong>CREATE QB BILL</strong></li>
                                <li id="confirm"><strong>UPDATE QB PO's</strong></li>
                                <li id="download"><strong>GENERATE</strong></li>
                            </ul>
                            <!-- fieldsets -->
                            <fieldset></fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title mb-5">CONTAINER Information</h2>
                                    <input type="text" id= "name" name="name" placeholder="CONTAINER NAME"/>
                                    <div class="row">
                                        <!-- DataTable -->
                                        <table id="container-table" class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Shipment Name</th>
                                                    <th>Container Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $no = 1;
                                                    if ($containerList != false) {
                                                        foreach ($containerList as $container) {
                                                            echo '<tr>';
                                                            echo '<td>'.$no++.'</td>';
                                                            echo '<td>'.$container->shipment_name.'</td>';
                                                            echo '<td>'.$container->name.'</td>';
                                                            echo '<td>
                                                                    <a class="btn" href="'.site_url('/container/read/'.$container->id).'">
                                                                        <i class="fa-solid fa-eye" style="color: green;"></i>  
                                                                        Read
                                                                    </a> 
                                                                    <a class="btn" href="'.site_url('/container/edit/'.$container->id).'">
                                                                        <i class="fa-solid fa-pencil fa-beat-fade" style="color: blue;"></i>
                                                                        Edit
                                                                    </a>
                                                                    <a class="btn btn-default" href="'.site_url('/setdetails/edit/'.$container->id).'">
                                                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 
                                                                        Edit Data
                                                                    </a>
                                                                    <a class="btn btn-default" href="'.site_url('/setdetails/inputData/'.$container->id).'">
                                                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 
                                                                        Add Data
                                                                    </a>
                                                                    <a class="btn" href="'.site_url('/container/delete/'.$container->id).'">
                                                                        <i class="fa-regular fa-trash-can" style="color: red;"></i>
                                                                        Delete
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
                                <!-- <input type="button" class="action-button-previous"/> -->
                                <a type="button" class="previous action-button-previous" href="<?php echo site_url('setdetails/one/'.$shipment_id)?>">Previous</a>
                                <input type="submit" class="action-button" id="create_container" value="SAVE"/>
                                <a href="<?php echo site_url('billcheck/billone/'.$shipment_id)?>" class="action-button" id="create_container">Next Step</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
