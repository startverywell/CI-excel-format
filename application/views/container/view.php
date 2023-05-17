<h1 class="mt-4"><?php echo $container->shipment_name?></h1>
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
                <td><?php echo $container->shipment_name?></td>
            </tr>
            <tr class="table-success">
                <td>Container Name </td>
                <td><?php echo $container->name?></td>
            </tr>
        </tbody>
    </table>
</div>
<a class="btn btn-success" href="<?php echo site_url('/container/one/'.$container->shipment_id)?>">Back</a>