<h1 class="mt-4"><?php echo $header->shipment_name?></h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"></li>
</ol>
<div class="row">
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
        </tbody>
    </table>
</div>