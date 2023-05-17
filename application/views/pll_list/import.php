<h1 class="mt-4">FILE LOAD</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active"></li>
</ol>
<form class="form-upload" name="uploadImages" id="uploadImages" action="<?php echo site_url('pllist/importData');?>" method="POST" enctype="multipart/form-data">
    <div class="row mt-5" style="text-align:center;">
        <div class="col-xl-11 col-md-11">
            <div class="card bg-primary text-white mb-4">
                <input class="file-upload" id="upload_pl" name="upload_pl" type="file">
                <p class="card-body" id="name_pl">Drag your 3PL-LIST file here or click in this area.
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