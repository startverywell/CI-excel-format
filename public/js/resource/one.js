$(document).ready(function(){
    
    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;

    let next_func = (e) => {
        current_fs = $(e).parent();
        next_fs = $(e).parent().next();
        
        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
        
        //show the next fieldset
        next_fs.show(); 
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;
    
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({'opacity': opacity});
            }, 
            duration: 600
        });
    }
    
    $(".next").click(function(){
        
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();
        
        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
        
        //show the next fieldset
        next_fs.show(); 
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;
    
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({'opacity': opacity});
            }, 
            duration: 600
        });
    });
    
    $(".previous").click(function(){
        
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
        
        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
        
        //show the previous fieldset
        previous_fs.show();
    
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;
    
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({'opacity': opacity});
            }, 
            duration: 600
        });
    });


    
    $('.radio-group .radio').click(function(){
        $(this).parent().find('.radio').removeClass('selected');
        $(this).addClass('selected');
    });
    
    $(".submit").click(function(){
        return false;
    });

    const example = document.querySelector('#example1');
    const exampleParent = document.querySelector('#exampleParent');

    // generate an array of arrays with dummy data
    const data = new Array(17) // number of rows
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

    exampleParent.style.height = '810px';
    exampleParent.style.overflow = 'scroll';
    hot.refreshDimensions();

    
    $('#create_details').click(function(){
        let data = JSON.stringify(hot.getData());
        $('#detail_data').val(data);
        $('form[name="savedetail"]').submit();
    });
});