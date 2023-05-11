<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Shipment</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"></li>
        </ol>
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <a class="btn btn-primary" href="./dragdrop/create">
                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> 
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
                                echo '<td><a class="btn btn-primary" href="'.base_url('Dragdrop/read/'.$shipData->id).'"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Read</a> <a class="btn btn-default" href="'.base_url('Dragdrop/update/'.$shipData->id).'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a> <a class="btn btn-danger" href="'.base_url('Dragdrop/delete/'.$shipData->id).'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</a></td>';
                                echo '</tr>';
                            }
                        }
                    ?>
                </tbody>
            </table>
            <!-- /.DataTable -->
        </div>
    </div>
</main>