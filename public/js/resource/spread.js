
window.onload = function () {
    // colHeaders: ['PO#', 'STYLE', 'DESCRIPTION', 'DESCRIPTION2', 'HTS', 'PCS/CARTON', 'CTN', 'TOTAL', 'UOM', 'DS', 'CUSTOMER', 'SHIP', 'CANCEL', 'CUSTOMER PO', 'SO', 'INV', 'EXT REQ' ,'RCVD', 'SHORT/OVER', 'NOTES', 'UPC' ,'Length', 'Width', 'Height', 'Weight', 'CBM', 'Price'],
        
    const example = document.querySelector('#example');
    const exampleParent = document.querySelector('#exampleParent');

    // generate an array of arrays with dummy data
    const data = new Array(20) // number of rows
    .fill()
    .map((_, row) => new Array(28) // number of columns
        .fill()
        .map((_, column) => ``)
    );

    const hot = new Handsontable(example, {
        data,
        rowHeaders: true,
        colHeaders: ['PO#', 'STYLE','ASST','ST', 'MT', 'DESCRIPTION', 'DESCRIPTION2', 'HTS', 'PCS/CARTON', 'CTN', 'TOTAL', 'UOM', 'DS', 'CUSTOMER', 'SHIP', 'CANCEL', 'CUSTOMER PO', 'SO', 'INV', 'EXT REQ' ,'RCVD', 'SHORT/OVER', 'NOTES', 'UPC' ,'Length', 'Width', 'Height', 'Weight', 'CBM', 'Price'],
        width: '100%',
        height: 'auto',
        // height: '100%',
        rowHeights: 23,
        colWidths: 100,
        columns: [
            {
                type: 'text'
            },
            {
                type: 'text'
            },
            {
                type: 'checkbox'
            },
            {
                type: 'checkbox'
            },
            {
                type: 'checkbox'
            },
            {
                type: 'text'
            },
            {
                type: 'text'
            },
            {
                type: 'text'
            },
            {
                type: 'text'
            },
            {
                type: 'text'
            },
            {
                type: 'text'
            },
            {
                type: 'text'
            },
            {
                type: 'text'
            },
            {
                type: 'text'
            },
            {
                type: 'text'
            },
            {
                type: 'text'
            },
            {
                type: 'text'
            },
            {
                type: 'text'
            },
            {
                type: 'text'
            },
            {
                type: 'text'
            },
            {
                type: 'text'
            },
            {
                type: 'text'
            },
            {
                type: 'text'
            },
            {
                type: 'text'
            },
            {
                type: 'text'
            },
            {
                type: 'text'
            },
            {
                type: 'text'
            },
            {
                type: 'text'
            },

            {
                type: 'text'
            },
            {
                type: 'text'
            },
        ],
        fixedColumnsStart: 2,
        licenseKey: 'non-commercial-and-evaluation'
    });

    exampleParent.style.height = '510px';
    hot.refreshDimensions();

    
    $('#save_excel_button').click(function(){
        let container_id = $('#container_id').val();
        let shipment_id = $('#shipment_id').val();
        let formData = {'container_id': container_id, 'data':JSON.stringify(hot.getData())};

        $.ajax({
            url: base_url + '/setdetails/save',
            data: formData,
            type: 'POST',
            dataType: 'json',
        },function(response){
            alert('SUCCESS');
            window.location.href = response;
        });
        window.location.href = base_url + '/container/one/'+shipment_id    ;
    });
};

