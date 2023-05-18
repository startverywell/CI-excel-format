$(document).ready(function() {
    $('#pl-table').DataTable();

    $('#upload_pl').change(function() {
        fake_path = document.getElementById('upload_pl').value;
        file_name = fake_path.split("\\").pop();
        $('#name_pl').text(file_name + " file(s) selected");
    });

    $('#upload_upc').change(function() {
        fake_path = document.getElementById('upload_upc').value;
        file_name = fake_path.split("\\").pop();
        $('#name_upc').text(file_name + " file(s) selected");
    });
});
