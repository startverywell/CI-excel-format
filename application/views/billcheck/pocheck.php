<?php
    $this->load->helper('form');
?>
<h1 class="mt-4">EDIT SHIPMENT HEADER</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"></li>
</ol>
<form id="set_header" action="<?php echo site_url('billcheck/checkall');?>" method="POST">
    <?php echo validation_errors(); ?>  
    <?php echo form_open('form'); ?> 
    <?php echo form_hidden('id', $header->id);?>
    <table class="table">
        <thead>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>   
            <tr class="table-primary">
                <td>Shipment Name</td>
                <td><?php echo $header->shipment_name?></td>
            </tr>
            <tr class="table-success">
                <td>DATE ENTERED </td>
                <td><?php echo $header->date_entered?></td>
            </tr>
            <tr class="table-success">
                <td>SHIPMENT TYPE</td>
                <td><?php echo $header->shipment_type?></td>
            </tr>
            <tr class="table-success">
                <td>FACTORY</td>
                <td><?php echo $header->factory?></td>
            </tr>
            <tr class="table-success">
                <td>CARRIER</td>
                <td><?php echo $header->carrier?></td>
            </tr>
            <tr class="table-info">
                <td>BL#</td>
                <td><?php echo $header->bl?></td>
            </tr>
            <tr class="table-info">
                <td>BILL/INV DATE</td>
                <td><?php echo $header->bill_date?></td>
            </tr>
            <tr class="table-info">
                <td>DOCS RCVD DATE</td>
                <td><?php echo $header->docs_date?></td>
            </tr>
            <tr class="table-info">
                <td>Bill#</td>
                <td><?php echo $header->bill?></td>
            </tr>
            <tr class="table-info">
                <td>Amount</td>
                <td><?php echo $header->amount?></td>
            </tr>
            <tr class="table-success">
                <td>BILL# CHECK</td>
                <td>
                    <?php echo ($header->bill_check==1 ? '<i class="fa-solid fa-check" style="color: #2df41f;"></i>' :'<i class="fa-solid fa-xmark" style="color: red;"></i>'); ?>
                </td>
            </tr>
            <tr class="table-success">
                <td>PO# CHECK</td>
                <td>
                    <?php echo ($header->po_check==1 ? '<i class="fa-solid fa-check" style="color: #2df41f;"></i>' :'<i class="fa-solid fa-xmark" style="color: red;"></i>'); ?>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="row mt-5" style="justify-content: center;">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <?php echo ($header->bill_check==1 ? '<button class="btn btn-primary" type="submit">CHECK SHIPMENT DETAILS</button>' :'<a class="btn btn-danger" href="./billcheck/edit/'.$header->id.'">PLEASSE CHECK SHIPMENT HEADER</a>'); ?>
        </div>
        <div class="col-md-3"></div>
    </div>
</form>
