<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">DragDrop</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"></li>
        </ol>
        <form class="form-upload" name="uploadImages" id="uploadImages" action="<?php echo site_url('dragdrop/fileUpload');?>" method="POST" enctype="multipart/form-data">
            <div class="row mb-5">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                                    <input type="text" class="form-control" id="folder_name" name="folder_name" placeholder="Add Folder">
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="row" style="justify-content: center; text-align:center;">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <input class="file-upload" id="upload1" name="upload[]" type="file" value="">
                        <p class="card-body" id="name1">Drag your Bill of Lading file here or click in this area.
                        </p>
                    </div>
                </div>
                <div class="col-xl-1 col-md-6"></div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <input class="file-upload" id="upload2" name="upload[]" type="file" value="">
                        <p class="card-body" id="name2">Drag your invoice file here or click in this area.
                        </p>
                    </div>
                </div>
                <div class="col-xl-1 col-md-6"></div>
                <div class="col-xl-3 col-md-6">
                                    <div class="card bg-danger text-white mb-4">
                        <input class="file-upload" id="upload3" name="upload[]" type="file" value="">
                        <p class="card-body" id="name3">Drag your paking list here or click in this area.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row mt-5" style="justify-content: center;">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <button class="upload-buton" type="button" id="add_more">Submit</button>
                </div>
                <div class="col-md-3"></div>
            </div>
        </form>
    </div>
</main>