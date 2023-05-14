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
    $('#upload4').change(function() {
        fake_path = document.getElementById('upload4').value;
        file_name = fake_path.split("\\").pop();
        $('#name4').text(file_name + " file(s) selected");
    });
});
