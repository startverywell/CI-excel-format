<h1 class="mt-4">FILE LOAD</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"></li>
</ol>
<form class="form-upload" name="uploadImages" id="uploadImages" action="<?php echo site_url('upc/importData');?>" method="POST" enctype="multipart/form-data">
    <div class="row mt-5" style="text-align:center;">
        <div class="col-xl-11 col-md-11">
            <div class="card bg-primary text-white mb-4">
                <input class="file-upload" id="upload_upc" name="upload_upc" type="file">
                <p class="card-body" id="name_upc">Drag your UPC-LIST file here or click in this area.
                </p>
            </div>
        </div>
    </div>
    <div class="row mt-5" style="justify-content: center;">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <button class="upload-buton" type="submit">UPLADE DATA</button>
        </div>
        <div class="col-md-3"></div>
    </div>
</form>