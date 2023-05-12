$(document).ready(function() {
    $('#excel_btn').click(function(){
        let shipment_id = $('#shipment_id').val();
        $.post(base_url+'/generators/excel', { 
            shipment_id:shipment_id
        }, function(response){
            alert(response);
        });
    });
});