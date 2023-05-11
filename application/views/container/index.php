
<h1 class="mt-4">Container</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"></li>
</ol>
<div class="row">
    <div class="col-md-6"></div>
    <div class="col-md-3"></div>
    <div class="col-md-3">
        <a class="btn btn-primary" href="./container/create">
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
                                <a class="btn btn-primary" href="'.base_url('container/read/'.$container->id).'">
                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                    Read
                                </a> 
                                <a class="btn btn-default" href="'.base_url('container/update/'.$container->id).'">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 
                                    Edit
                                </a>
                                <a class="btn btn-default" href="./setdetails/inputData/'.$container->id.'">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 
                                    Input Data
                                </a>
                                <a class="btn btn-danger" href="'.base_url('container/delete/'.$container->id).'">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 
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
