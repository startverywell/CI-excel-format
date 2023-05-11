<main>
    <div class="container px-4">
        <h1 class="mt-4">GENERATE SHIPMENT HEADER</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"></li>
        </ol>
        <form id="set_header" action="<?php echo site_url('setheader/save');?>" method="POST">
            <?php echo validation_errors(); ?>  
            <?php echo form_open('form'); ?>  
            <div class="form-group mt-3">
                <label class="mb-2" for="date_entered">DATE ENTERED</label>
                <input type="text" class="form-control" id="date_entered" name="date_entered" placeholder="YYYY-mm-dd">
            </div>
            <div class="form-group mt-3">
                <label class="mb-2" for="shipment_type">SELECT SHIPMENT TYPE</label>
                <select id="shipment_type" class="form-control">
                    <option selected value="DOM">DOM</option>
                    <option value="PTD">PTD</option>
                    <option value="FOB">FOB</option>
                    <option value="MDDP">MDDP</option>
                </select>
            </div>
            <div class="form-group mt-3">
                <label class="mb-2" for="factory">FACTORY</label>
                <input type="text" class="form-control" id="factory" name="factory" placeholder="Factory name">
            </div>
            <div class="form-group mt-3">
                <label class="mb-2" for="carrier">CARRIER</label>
                <input type="text" class="form-control" id="carrier" name="carrier" placeholder="CARRIER">
            </div>
            <div class="form-group mt-3">
                <label class="mb-2" for="bl">BL#</label>
                <input type="text" class="form-control" id="bl" name="bl" placeholder="BL#">
            </div>
            <div class="form-group mt-3">
                <label class="mb-2" for="bill_date">BILL/INV DATE</label>
                <input type="text" class="form-control" id="bill_date" name="bill_date" placeholder="BILL/INV DATE">
            </div>
            <div class="form-group mt-3">
                <label class="mb-2" for="doc_date">DOCS RCVD DATE</label>
                <input type="text" class="form-control" id="doc_date" name="doc_date" placeholder="DOCS RCVD DATE">
            </div>
            <div class="form-group mt-3">
                <label class="mb-2" for="bill">Bill#</label>
                <input type="text" class="form-control" id="bill" name="bill" placeholder="Bill#">
            </div>
            <div class="form-group mt-3">
                <label class="mb-2" for="amount">Amount</label>
                <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount">
            </div>
            <div class="row mt-5" style="justify-content: center;">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <button class="btn btn-primary" type="submit" id="head_save">SAVE SHIPMENT HEADER</button>
                </div>
                <div class="col-md-3"></div>
            </div>
        </form>
    </div>
</main>