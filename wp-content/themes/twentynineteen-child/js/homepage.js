$(document).ready(function () {
    $('#btn-create').click(function (e) {
        e.preventDefault();
        var prompt = $('#prompt').val();

        if (prompt != '') {
            var data = {
                'action': 'predict_action',
                'prompt': prompt,
            };

            $.ajax({
                type: 'POST',
                url: CONFIG.ajaxUrl,
                data: data,
                success: function (response) {
                    var result = JSON.parse(response);
                    
                    // Generatign 6 images
                    // if (result.klms != undefined && result.ddim != undefined) {
                    //     localStorage.setItem('prompt', prompt);
                    //     window.location.href = CONFIG.siteUrl + '/create-image?id1=' + result.klms + '&id2=' + result.ddim;
                    // }
                    
                    // Generating 3 images 
                    if (result.klms != undefined) {
                        localStorage.setItem('prompt', prompt);
                        window.location.href = CONFIG.siteUrl + '/create-image?id1=' + result.klms;
                    } else if (result.status == 'failed') {
                        alert(result.message);
                    }
                }
            });

        } else {
            return false;
        }
    })

    $('.hover-text i').click(function () {
        var visibility =  $(this).parent().find('.tooltip-text').css('visibility');
        if (visibility == 'hidden') {
            $(this).parent().find('.tooltip-text').css({visibility: 'visible'});
        } else {
            $(this).parent().find('.tooltip-text').css({visibility: 'hidden'});
        }
    });
});