$(document).ready(function() {
    $('#detail-table').DataTable();
    $('#single_top').click(function() {
        let single_value = $('input[name="single_top"]').val();
        single_value = single_value == 1 ? 0 : 1;
        $('input[name="single_top"]').val(single_value);
    });

    $('#multi_top').click(function() {
        let multi_value = $('input[name="multi_top"]').val();
        multi_value = multi_value == 1 ? 0 : 1;
        $('input[name="multi_top"]').val(multi_value);
    });

    $('#asst').click(function() {
        let asst_value = $('input[name="asst"]').val();
        asst_value = asst_value == 1 ? 0 : 1;
        $('input[name="asst"]').val(asst_value);
    });
});