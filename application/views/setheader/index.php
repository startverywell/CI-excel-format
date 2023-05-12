<h1 class="mt-4">Shipment Headers</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"></li>
</ol>
<div class="row">
    <div class="col-md-6"></div>
    <div class="col-md-3"></div>
    <div class="col-md-3">
        <a class="btn btn-primary" href="./setheader/create">
            <i class="fa-solid fa-plus" style="color: #40f000;"></i>
            Shipment Headers
        </a>
    </div>
</div>
<div class="row">
    <!-- DataTable -->
    <table id="header-table" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Shipment Name</th>
                <th>Added</th>
                <th>Type</th>
                <th>Factory</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1;
                if ($headerList != false) {
                    foreach ($headerList as $header) {
                        echo '<tr>';
                        echo '<td>'.$no++.'</td>';
                        echo '<td>'.$header->name.'</td>';
                        echo '<td>'.$header->date_entered.'</td>';
                        echo '<td>'.$header->shipment_type.'</td>';
                        echo '<td>'.$header->factory.'</td>';
                        echo '<td>
                            <a class="btn" href="./setheader/read/'.$header->id.'">
                                <i class="fa-solid fa-eye" style="color: green;"></i>  
                                Read
                            </a> 
                            <a class="btn" href="./setheader/edit/'.$header->id.'">
                                <i class="fa-solid fa-pencil fa-beat-fade" style="color: blue;"></i>
                                Edit
                            </a> 
                            <a class="btn" href="./setheader/delete/'.$header->id.'">
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
