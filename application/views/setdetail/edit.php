<h1 class="mt-4">INPUT DATAS : <?php echo $header_title;?></h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"></li>
</ol>
<div class="row">
    <a class="btn btn-success" href="<?php echo site_url('/container/one/'.$shipment_id)?>">Back</a>      
    <!-- DataTable -->
    <table id="detail-table" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>PO#</th>
                <th>SKU</th>
                <th>DESCRIPTION</th>
                <th>HTS</th>
                <th>PCS/CARTON</th>
                <th>CTN</th>
                <th>TOTAL</th>
                <th>Price</th>
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
                if ($data != false) {
                    foreach ($data as $detali) {
                        echo '<tr>';
                        echo '<td>'.$no++.'</td>';
                        echo '<td>'.$detali->po.'</td>';
                        echo '<td>'.$detali->style.'</td>';
                        echo '<td>'.$detali->description.'</td>';
                        echo '<td>'.$detali->hts.'</td>';
                        echo '<td>'.$detali->pcs_carton.'</td>';
                        echo '<td>'.$detali->ctn.'</td>';
                        echo '<td>'.$detali->total.'</td>';
                        echo '<td>'.$detali->price.'</td>';
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
</div>>