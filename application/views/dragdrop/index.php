<h1 class="mt-4">SHIPMENT</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"></li>
</ol>
<div class="row">
    <div class="col-md-6"></div>
    <div class="col-md-3"></div>
    <div class="col-md-3">
        <a class="btn btn-primary" href="<?php echo site_url('/dragdrop/createOne')?>">
            <i class="fa-solid fa-plus" style="color: #40f000;"></i>
            Create Shipment
        </a>
    </div>
</div>
<div class="row">
    <!-- DataTable -->
    <table id="ship-table" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>input file 1</th>
                <th>input file 2</th>
                <th>input file 3</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1;
                if ($shipList != false) {
                    foreach ($shipList as $shipData) {
                        echo '<tr>';
                        echo '<td>'.$no++.'</td>';
                        echo '<td>'.$shipData->name.'</td>';
                        echo '<td>'.$shipData->input_1_name.'</td>';
                        echo '<td>'.$shipData->input_2_name.'</td>';
                        echo '<td>'.$shipData->input_3_name.'</td>';
                        echo '<td>
                            <a class="btn" href="'.site_url('/dragdrop/read/'.$shipData->id).'">
                                <i class="fa-solid fa-eye" style="color: green;"></i> 
                                READ
                            </a> 
                            <a class="btn" href="'.site_url('/dragdrop/edit/'.$shipData->id).'">
                            <i class="fa-regular fa-pencil" style="color: red;"></i>
                            EDIT</a>
                            <a class="btn" href="'.site_url('/dragdrop/delete/'.$shipData->id).'">
                            <i class="fa-regular fa-trash-can" style="color: red;"></i>
                            DELETE</a>
                            <a class="btn" href="'.site_url('/container/one/'.$shipData->id).'">
                            <i class="fa-regular fa-star" style="color: blue;"></i>
                            WIZARD</a>
                            </td>';
                        echo '</tr>';
                    }
                }
            ?>
        </tbody>
    </table>
    <!-- /.DataTable -->
</div>
