<h1 class="mt-4"><?php echo $header_title?></h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"></li>
</ol>
<div class="row">
    <table class="table table-bordered">
        <tbody>   
            <tr class="table-success">
                <td>SKU :</td>
                <td><?php echo $detail->style?></td>
                <td>3PL NEW :</td>
                <td><?php echo ($detail->pl_new==1 ? '<i class="fa-solid fa-check" style="color: #2df41f;"></i>' :'<i class="fa-solid fa-xmark" style="color: red;"></i>'); ?></td>
                <td>ASST :</td>
                <td><?php echo ($detail->asst==1 ? '<i class="fa-solid fa-check" style="color: #2df41f;"></i>' :'<i class="fa-solid fa-xmark" style="color: red;"></i>'); ?></td>
                <td>SINGLE TOP :</td>
                <td><?php echo ($detail->single_top==1 ? '<i class="fa-solid fa-check" style="color: #2df41f;"></i>' :'<i class="fa-solid fa-xmark" style="color: red;"></i>'); ?></td>
                <td>MULTI TOP :</td>
                <td><?php echo ($detail->multi_top==1 ? '<i class="fa-solid fa-check" style="color: #2df41f;"></i>' :'<i class="fa-solid fa-xmark" style="color: red;"></i>'); ?></td>
                <td>PO :</td>
                <td><?php echo $detail->po?></td>
            </tr>
            <tr class="table-primary">
                <td>Description :</td>
                <td colspan='5'><?php echo $detail->description?></td>
                <td>Description2 :</td>
                <td colspan='5'><?php echo $detail->description?></td>
            </tr>
            <tr class="table-info">
                <td>HTS :</td>
                <td><?php echo $detail->hts?></td>
                <td>PCS/CARTON :</td>
                <td><?php echo $detail->pcs_carton?></td>
                <td>CTN :</td>
                <td><?php echo $detail->ctn?></td>
                <td>TOTAL :</td>
                <td><?php echo $detail->total?></td>
                <td>UOM :</td>
                <td><?php echo $detail->uom?></td>
                <td>RCVD :</td>
                <td><?php echo $detail->rcvd?></td>
            </tr>
            <tr class="table-warning">
                <td>UPC :</td>
                <td colspan='5'><?php echo $detail->upc?></td>
                <td>NOTES :</td>
                <td colspan='5'><?php echo $detail->notes?></td> 
            </tr>
            <tr class="table-active">
                <td>Length :</td>
                <td colspan='2'><?php echo $detail->length?></td> 
                <td>Width :</td>
                <td colspan='2'><?php echo $detail->width?></td> 
                <td>Height :</td>
                <td colspan='2'><?php echo $detail->height?></td> 
                <td>Weight :</td>
                <td colspan='2'><?php echo $detail->weight?></td> 
            </tr>
            <tr class="table-dark">
                <td>CBM :</td>
                <td colspan='5'><?php echo $detail->cbm?></td>
                <td>PRICE :</td>
                <td colspan='5'><?php echo $detail->price?></td>
            </tr>
        </tbody>
    </table>
    <a class="btn btn-success" href="<?php echo site_url('/container/one/'.$detail->shipment_id)?>">Back</a>
</div>