<h1 class="mt-4">SHIPMENT CHECK</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"></li>
</ol>
<div class="row">
    <!-- DataTable -->
    <table id="check-table" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Shipment Name</th>
                <th>Added</th>
                <th>Type</th>
                <th>Factory</th>
                <th>BILL Check</th>
                <th>PO Check</th>
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
                        echo '<td>'.($header->bill_check==1 ? '<i class="fa-solid fa-check" style="color: #2df41f;"></i>' :'').'</td>';
                        echo '<td>'.($header->po_check==1 ? '<i class="fa-solid fa-check" style="color: #2df41f;"></i>' :'').'</td>';
                        echo '<td>
                            <a class="btn" href="./setheader/read/'.$header->id.'">
                                <i class="fa-solid fa-eye" style="color: green;"></i>  
                                Read
                            </a> 
                            <a class="btn" href="./billcheck/edit/'.$header->id.'">
                                <i class="fa-solid fa-check fa-beat-fade" style="color: blue;"></i>
                                Check STEP 4
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
