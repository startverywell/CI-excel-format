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

    // $('#create_shipment').on("click", function(e) {

    //     if ($('#name').val() == "") {
    //         alert("input the FileName");
    //         return;
    //     }
    //     if ($('#upload1').val() == "") {
    //         alert("Please add the first upload file.");
    //         return;
    //     }
    //     if ($('#upload2').val() == "") {
    //         alert("Please add the second upload file.");
    //         return;
    //     }
    //     if ($('#upload3').val() == "") {
    //         alert("Please add the third upload file.");
    //         return;
    //     }

    //     let fileInput1 = document.getElementById('upload1');
    //     let fileInput2 = document.getElementById('upload2');
    //     let fileInput3 = document.getElementById('upload3');
    //     let fileInput4 = document.getElementById('upload4');

    //     let files1 = fileInput1.files;
    //     let files2 = fileInput2.files;
    //     let files3 = fileInput3.files;
    //     let files4 = fileInput4.files;

    //     let formData = new FormData();

    //     for (let i = 0; i < files1.length; i++) {
    //         formData.append(fileInput1.name, files1[i]);
    //     }

    //     for (let i = 0; i < files2.length; i++) {
    //         formData.append(fileInput2.name, files2[i]);
    //     }

    //     for (let i = 0; i < files3.length; i++) {
    //         formData.append(fileInput3.name, files3[i]);
    //     }

    //     for (let i = 0; i < files4.length; i++) {
    //         formData.append(fileInput4.name, files4[i]);
    //     }
    //     formData.append('name', $('#name').val());

    //     $.ajax({
    //         url: base_url + '/dragdrop/save',
    //         data: formData,
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         type: 'POST',
    //         dataType: 'json',
    //         success: function (req) {
    //             next_func($('#create_shipment'));
                
    //         }
    //     });

    //     // next_func($('#create_shipment'));
    // });
});