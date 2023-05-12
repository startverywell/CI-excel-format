
window.onload = function () {
    var spread = new GC.Spread.Sheets.Workbook(document.getElementById("ss"));
    initSpread(spread);
};

function initSpread(spread) {
    spread.suspendPaint();
    var sheet = spread.getActiveSheet();
    spread.options.allowCopyPasteExcelStyle = false;
    sheet.options.allowCellOverflow = true;

    sheet.setColumnCount(26);
    sheet.getCell(0, 0).value("PO#");
    sheet.getCell(0, 1).value("STYLE");
    sheet.getCell(0, 2).value("DESCRIPTION");
    sheet.getCell(0, 3).value("HTS");
    sheet.getCell(0, 4).value("PCS/CARTON");
    sheet.getCell(0, 5).value("CTN");
    sheet.getCell(0, 6).value("TOTAL");
    sheet.getCell(0, 7).value("UOM");
    sheet.getCell(0, 8).value("DS");
    sheet.getCell(0, 9).value("CUSTOMER");
    sheet.getCell(0, 10).value("SHIP");
    sheet.getCell(0, 11).value("CANCEL");
    sheet.getCell(0, 12).value("CUSTOMER PO");
    sheet.getCell(0, 13).value("SO");
    sheet.getCell(0, 14).value("INV");
    sheet.getCell(0, 15).value("EXT REQ");
    sheet.getCell(0, 16).value("RCVD");
    sheet.getCell(0, 17).value("SHORT/OVER");
    sheet.getCell(0, 18).value("NOTES");
    sheet.getCell(0, 19).value("UPC");
    sheet.getCell(0, 20).value("Length");
    sheet.getCell(0, 21).value("Width");
    sheet.getCell(0, 22).value("Height");
    sheet.getCell(0, 23).value("Weight");
    sheet.getCell(0, 24).value("CBM");
    sheet.getCell(0, 25).value("Price");

    sheet.getRange(0, 0, 1, 26).backColor("#D9D9FF");
    sheet.getRange(0, 0, 1, 26).hAlign(GC.Spread.Sheets.HorizontalAlign.center);
    sheet.getRange(0, 0, 1, 26).setBorder(new GC.Spread.Sheets.LineBorder("Black", GC.Spread.Sheets.LineStyle.thin), {all: true});
    sheet.getRange(0, 0, 1, 26).setBorder(new GC.Spread.Sheets.LineBorder("Green", GC.Spread.Sheets.LineStyle.dotted), {innerHorizontal: true});
    sheet.getRange(0, 0, 0, 26).locked(true);

    
    
    // loadSaleDataAnalysisTable(sheet, 1, 0, true);
    spread.resumePaint();

    // Resume dirty cells
    sheet.resumeDirty();
}

$('#save_excel_button').click(function(){
    // Get the activesheet from the DOM element "ss"
    var ss = GC.Spread.Sheets.findControl(document.getElementById("ss"));
    var sheet = ss.getActiveSheet();
    // Store the dirty cells information in the dirtyCells variable
    var dirtyCells = sheet.getDirtyCells(1, 1, 150, 26);
    // Get the HTML <div> element "msg" by id, this will be created in Step 2
    var div = document.getElementById("msg");
    // Display the JSON string in the div element to visualize the changed cell information
    div.innerHTML = JSON.stringify(dirtyCells, null, 4);

    let container_id = $('#container_id').val();
    let formData = {'container_id': container_id, 'data':JSON.stringify(dirtyCells, null, 4)};
    // Note: Post changes to your database

    $.ajax({
        url: base_url + '/setdetails/save',
        data: formData,
        type: 'POST',
        dataType: 'json',
    });
});