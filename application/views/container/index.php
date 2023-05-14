
<h1 class="mt-4">CONTAINER</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"></li>
</ol>
<div class="row">
    <div class="col-md-6"></div>
    <div class="col-md-3"></div>
    <div class="col-md-3">
        <a class="btn btn-primary" href="<?php echo site_url('/container/create')?>">
            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> 
            Create Container
        </a>
    </div>
</div>
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
