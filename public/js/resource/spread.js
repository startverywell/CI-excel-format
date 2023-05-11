
window.onload = function () {
    var spread = new GC.Spread.Sheets.Workbook(document.getElementById("ss"));
    initSpread(spread);
};

function initSpread(spread) {
    spread.suspendPaint();
    var sheet = spread.getActiveSheet();
    spread.options.allowCopyPasteExcelStyle = false;
    sheet.options.allowCellOverflow = true;
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
    sheet.getRange(0, 0, 0, 25).locked(true);
    
    // loadSaleDataAnalysisTable(sheet, 1, 0, true);
    spread.resumePaint();

    // Resume dirty cells
    sheet.resumeDirty();

    

}

function loadSaleDataAnalysisTable(sheet, startRow, startCol, haveTitle) {
    var spread = sheet.parent;
    if (!spread) {
        return;
    }
    spread.suspendPaint();
    if (startRow === undefined) {
        startRow = 0;
    }
    if (startCol === undefined) {
        startCol = 0;
    }
    if (sheet.getRowCount(GC.Spread.Sheets.SheetArea.viewport) - startRow < 19 ||
            sheet.getColumnCount(GC.Spread.Sheets.SheetArea.viewport) - startCol < 10) {
        return;
    }

    spread.options.referenceStyle = GC.Spread.Sheets.ReferenceStyle.r1c1;

    if (haveTitle) {
        sheet.addSpan(startRow + 0, startCol + 1, 1, 10);
        sheet.setRowHeight(startRow + 0, 40);
        sheet.setValue(startRow + 0, startCol + 1, "Sale Data Analysis");
        sheet.getCell(startRow + 0, startCol + 1).font("bold 30px arial");
        sheet.getCell(startRow + 0, startCol + 1).vAlign(GC.Spread.Sheets.VerticalAlign.center);
    }
    sheet.addSpan(startRow + 1, startCol + 1, 1, 3);
    sheet.setValue(startRow + 1, startCol + 1, "Store");
    sheet.addSpan(startRow + 1, startCol + 4, 1, 7);
    sheet.setValue(startRow + 1, startCol + 4, "Goods");
    sheet.addSpan(startRow + 2, startCol + 1, 1, 2);
    sheet.setValue(startRow + 2, startCol + 1, "Area");
    sheet.addSpan(startRow + 2, startCol + 3, 2, 1);
    sheet.setValue(startRow + 2, startCol + 3, "ID");
    sheet.addSpan(startRow + 2, startCol + 4, 1, 2);
    sheet.setValue(startRow + 2, startCol + 4, "Fruits");
    sheet.addSpan(startRow + 2, startCol + 6, 1, 2);
    sheet.setValue(startRow + 2, startCol + 6, "Vegetables");
    sheet.addSpan(startRow + 2, startCol + 8, 1, 2);
    sheet.setValue(startRow + 2, startCol + 8, "Foods");
    sheet.addSpan(startRow + 2, startCol + 10, 2, 1);
    sheet.setValue(startRow + 2, startCol + 10, "Total");
    sheet.setValue(startRow + 3, startCol + 1, "State");
    sheet.setValue(startRow + 3, startCol + 2, "City");
    sheet.setValue(startRow + 3, startCol + 4, "Grape");
    sheet.setValue(startRow + 3, startCol + 5, "Apple");
    sheet.setValue(startRow + 3, startCol + 6, "Potato");
    sheet.setValue(startRow + 3, startCol + 7, "Tomato");
    sheet.setValue(startRow + 3, startCol + 8, "Sandwich");
    sheet.setValue(startRow + 3, startCol + 9, "Hamburger");
    sheet.addSpan(startRow + 4, startCol + 1, 7, 1);
    sheet.addSpan(startRow + 4, startCol + 2, 3, 1);
    sheet.addSpan(startRow + 7, startCol + 2, 3, 1);
    sheet.addSpan(startRow + 10, startCol + 2, 1, 2);
    sheet.setValue(startRow + 10, startCol + 2, "Sub Total:");
    sheet.addSpan(startRow + 11, startCol + 1, 7, 1);
    sheet.addSpan(startRow + 11, startCol + 2, 3, 1);
    sheet.addSpan(startRow + 14, startCol + 2, 3, 1);
    sheet.addSpan(startRow + 17, startCol + 2, 1, 2);
    sheet.setValue(startRow + 17, startCol + 2, "Sub Total:");
    sheet.addSpan(startRow + 18, startCol + 1, 1, 3);
    sheet.setValue(startRow + 18, startCol + 1, "Total:");
    sheet.setValue(startRow + 4, startCol + 1, "NC");
    sheet.setValue(startRow + 4, startCol + 2, "Raleigh");
    sheet.setValue(startRow + 7, startCol + 2, "Charlotte");
    sheet.setValue(startRow + 4, startCol + 3, "001");
    sheet.setValue(startRow + 5, startCol + 3, "002");
    sheet.setValue(startRow + 6, startCol + 3, "003");
    sheet.setValue(startRow + 7, startCol + 3, "004");
    sheet.setValue(startRow + 8, startCol + 3, "005");
    sheet.setValue(startRow + 9, startCol + 3, "006");
    sheet.setValue(startRow + 11, startCol + 1, "PA");
    sheet.setValue(startRow + 11, startCol + 2, "Philadelphia");
    sheet.setValue(startRow + 14, startCol + 2, "Pittsburgh");
    sheet.setValue(startRow + 11, startCol + 3, "007");
    sheet.setValue(startRow + 12, startCol + 3, "008");
    sheet.setValue(startRow + 13, startCol + 3, "009");
    sheet.setValue(startRow + 14, startCol + 3, "010");
    sheet.setValue(startRow + 15, startCol + 3, "011");
    sheet.setValue(startRow + 16, startCol + 3, "012");
    for (var i = 4; i < 10; i++) {
        sheet.setFormula(startRow + 10, startCol + i, "=SUM(R[-6]C:R[-1]C");
        sheet.setFormula(startRow + 17, startCol + i, "=SUM(R[-6]C:R[-1]C");
        sheet.setFormula(startRow + 18, startCol + i, "=R[-8]C + R[-1]C");
    }
    sheet.setFormula(startRow + 18, startCol + 10, "=R[-8]C + R[-1]C");
    for (var i = startRow; i < 14 + startRow; i++) {
        sheet.setFormula(4 + i, startCol + 10, "=SUM(RC[-6]:RC[-1])");
    }
    sheet.getRange(startRow + 1, startCol + 1, 3, 10).backColor("#D9D9FF");
    sheet.getRange(startRow + 4, startCol + 1, 15, 3).backColor("#D9FFD9");
    sheet.getRange(startRow + 1, startCol + 1, 3, 10).hAlign(GC.Spread.Sheets.HorizontalAlign.center);
    sheet.getRange(startRow + 1, startCol + 1, 18, 10).setBorder(new GC.Spread.Sheets.LineBorder("Black", GC.Spread.Sheets.LineStyle.thin), {all: true});
    sheet.getRange(startRow + 4, startCol + 4, 3, 6).setBorder(new GC.Spread.Sheets.LineBorder("Green", GC.Spread.Sheets.LineStyle.dotted), {innerHorizontal: true});
    sheet.getRange(startRow + 7, startCol + 4, 3, 6).setBorder(new GC.Spread.Sheets.LineBorder("Green", GC.Spread.Sheets.LineStyle.dotted), {innerHorizontal: true});
    sheet.getRange(startRow + 11, startCol + 4, 3, 6).setBorder(new GC.Spread.Sheets.LineBorder("Green", GC.Spread.Sheets.LineStyle.dotted), {innerHorizontal: true});
    sheet.getRange(startRow + 14, startCol + 4, 3, 6).setBorder(new GC.Spread.Sheets.LineBorder("Green", GC.Spread.Sheets.LineStyle.dotted), {innerHorizontal: true});
    fillSampleData(sheet, new GC.Spread.Sheets.Range(startRow + 4, startCol + 4, 6, 6));
    fillSampleData(sheet, new GC.Spread.Sheets.Range(startRow + 11, startCol + 4, 6, 6));

    function fillSampleData(sheet, range) {
        for (var i = 0; i < range.rowCount; i++) {
            for (var j = 0; j < range.colCount; j++) {
                sheet.setValue(range.row + i, range.col + j, Math.ceil(Math.random() * 300));
            }
        }
    };

    spread.options.referenceStyle = GC.Spread.Sheets.ReferenceStyle.a1;

    spread.resumePaint();
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