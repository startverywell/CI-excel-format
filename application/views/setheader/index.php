<h1 class="mt-4">Shipment Headers</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"></li>
</ol>
<div class="row">
    <div class="col-md-6"></div>
    <div class="col-md-3"></div>
    <div class="col-md-3">
        <a class="btn btn-primary" href="./setheader/create">
            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> 
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
                        echo '<td><a class="btn btn-primary" href="'.base_url('Dragdrop/read/'.$header->id).'"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Read</a> <a class="btn btn-default" href="'.base_url('Dragdrop/update/'.$header->id).'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a> <a class="btn btn-danger" href="'.base_url('Dragdrop/delete/'.$header->id).'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</a></td>';
                        echo '</tr>';
                    }
                }
            ?>
        </tbody>
    </table>
    <!-- /.DataTable -->
</div>
