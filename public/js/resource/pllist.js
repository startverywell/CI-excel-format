$(document).ready(function() {
    $('#pl-table').DataTable();

    $('#upload_pl').change(function() {
        fake_path = document.getElementById('upload_pl').value;
        file_name = fake_path.split("\\").pop();
        $('#name_pl').text(file_name + " file(s) selected");
    });
});
