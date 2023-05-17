<h1 class="mt-4">3PL LIST</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"></li>
</ol>
<div class="row mb-3">
    <div class="col-md-6"></div>
    <div class="col-md-3"></div>
    <div class="col-md-3">
        <a class="btn btn-primary" href="<?php echo site_url('/pllist/create')?>">
            <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
            Add 3PL
        </a>
        <a class="btn btn-success" href="<?php echo site_url('/pllist/export')?>">
            <i class="fa-solid fa-circle-down fa-beat" style="color: #ffffff;"></i>
            Export Excel
        </a>
        <a class="btn btn-info" href="<?php echo site_url('/pllist/import')?>">
            <i class="fa-solid fa-circle-arrow-up fa-beat-fade" style="color: #fafafa;"></i>
            Import Excel
        </a>
    </div>
</div>
<div class="row">
    <!-- DataTable -->
    <table id="pl-table" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>SKU</th>
                <th>Description</th>
                <th>Description2</th>
                <th>Qty</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1;
                if ($pl_list != false) {
                    foreach ($pl_list as $pl) {
                        echo '<tr>';
                        echo '<td>'.$no++.'</td>';
                        echo '<td>'.$pl->sku.'</td>';
                        echo '<td>'.$pl->description.'</td>';
                        echo '<td>'.$pl->description2.'</td>';
                        echo '<td>'.$pl->qty.'</td>';
                        echo '<td>
                            <a class="btn" href="'.site_url('/pllist/read/'.$pl->id).'">
                                <i class="fa-solid fa-eye" style="color: green;"></i> 
                                Read
                            </a> 
                            <a class="btn" href="'.site_url('/pllist/edit/'.$pl->id).'">
                            <i class="fa-regular fa-pencil" style="color: red;"></i>
                            Edit</a>
                            <a class="btn" href="'.site_url('/pllist/delete/'.$pl->id).'">
                            <i class="fa-regular fa-trash-can" style="color: red;"></i>
                            Delete</a>
                            </td>';
                        echo '</tr>';
                    }
                }
            ?>
        </tbody>
    </table>
    <!-- /.DataTable -->
</div>
