<h1 class="mt-4"><?php echo $shipment->name?></h1>
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
                <td><?php echo $shipment->name?></td>
            </tr>
            <tr class="table-success">
                <td>Input File 1</td>
                <td><?php echo $shipment->input_1_name?></td>
            </tr>
            <tr class="table-success">
                <td>Input File 2</td>
                <td><?php echo $shipment->input_2_name?></td>
            </tr>
            <tr class="table-success">
                <td>Input File 3</td>
                <td><?php echo $shipment->input_3_name?></td>
            </tr>
            <tr class="table-success">
                <td>Input File 4</td>
                <td><?php echo $shipment->input_4_name?></td>
            </tr>
            <tr class="table-info">
                <td>Output File 1</td>
                <td><?php echo $shipment->out_1_name?></td>
            </tr>
            <tr class="table-info">
                <td>Output File 2</td>
                <td><?php echo $shipment->out_2_name?></td>
            </tr>
            <tr class="table-info">
                <td>Output File 3</td>
                <td><?php echo $shipment->out_3_name?></td>
            </tr>
            <tr class="table-info">
                <td>Output File 4</td>
                <td><?php echo $shipment->out_4_name?></td>
            </tr>
        </tbody>
    </table>
</div>