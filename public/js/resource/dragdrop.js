$(document).ready(function() {
    $('#ship-table').DataTable();
    $('#upload1').change(function() {
        fake_path = document.getElementById('upload1').value;
        file_name = fake_path.split("\\").pop();
        $('#name1').text(file_name + " file(s) selected");

    });
    $('#upload2').change(function() {
        fake_path = document.getElementById('upload2').value;
        file_name = fake_path.split("\\").pop();
        $('#name2').text(file_name + " file(s) selected");
    });
    $('#upload3').change(function() {
        fake_path = document.getElementById('upload3').value;
        file_name = fake_path.split("\\").pop();
        $('#name3').text(file_name + " file(s) selected");
    });
    $('#add_more').on("click", function(e) {

        // var ajaxData = new FormData();
        // ajaxData.append('action', 'uploadImages');

        // $.each($("input[type=file]"), function(i, obj) {
        //     $.each(obj.files, function(j, file) {
        //         ajaxData.append('upload[' + j + ']', file);
        //     })
        // });
        // console.log(ajaxData.length)
        let fileInput1 = document.getElementById('upload1');
        let fileInput2 = document.getElementById('upload2');
        let fileInput3 = document.getElementById('upload3');

        let files1 = fileInput1.files;
        let files2 = fileInput2.files;
        let files3 = fileInput3.files;

        let formData = new FormData();

        for (let i = 0; i < files1.length; i++) {
            formData.append(fileInput1.name, files1[i]);
        }

        for (let i = 0; i < files2.length; i++) {
            formData.append(fileInput2.name, files2[i]);
        }

        for (let i = 0; i < files3.length; i++) {
            formData.append(fileInput3.name, files3[i]);
        }

        uploadFiles(formData);
    });
});

function uploadFiles(formData) {
    if ($('#folder_name').val() == "") {
        alert("input the FileName");
        return;
    }
    if ($('#upload1').val() == "") {
        alert("Please add the first upload file.");
        return;
    }
    if ($('#upload2').val() == "") {
        alert("Please add the second upload file.");
        return;
    }
    if ($('#upload3').val() == "") {
        alert("Please add the third upload file.");
        return;
    }
    $.ajax({
        url: base_url + '/dragdrop/fileUpload/' + $('#folder_name').val(),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        dataType: 'json',
    });
}