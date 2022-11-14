$(document).ready(function () {
    var isEvovledResult = false;
    var loadingImageUrl = $('#evolve-img img').attr('src');
    var prompt = '';
    var imageUrl = '';
    init_page();

    $("body").on("click", "#evolve-img img, #prompt-text", function () {
        if (prompt != undefined && prompt != null && prompt != '') {
            $('#prompt-text div').empty();
            $('#prompt-text div').append('<p>' + prompt + '</p>');
            $('#btn-create-card').hide();
            $('#filter-section').show();
        }
    });

    $('.heart-icon').click(function () {
        if ($(this).find('i').hasClass('fa fa-heart-o')) {
            $(this).find('i').removeClass('fa fa-heart-o');
            $(this).find('i').addClass('fa fa-heart');
            $(this).find('i').attr('style', 'color:#e53b75;');
        } else {
            $(this).find('i').removeClass('fa fa-heart');
            $(this).find('i').addClass('fa fa-heart-o');
            $(this).find('i').removeAttr('style');
        }
    });

    $('.result-image').click(function () {
        $('.result-image').removeClass('selected');
        $(this).addClass('selected');
        $('.modifier-container').show();
    });

    $('.download-icon').click(function () {
        var imageUrl = $(this).parent('.result-image').data('url');
        $('#wow-modal-window-1').find('.down-image img').attr('src', imageUrl);
        $('#wow-modal-id-1').trigger('click');
    })

    $('#share-image').click(function () {
        $('#wow-modal-close-1').trigger('click');
        $('#wow-modal-id-3').trigger('click');
    })

    $('#btn-buy-credit').click(function () {
        $('#wow-modal-id-2').trigger('click');
    })
    
    $('#btn-create-card').click(function () {
        var imageUrl = $('.result-image.selected').data('url');
        if (imageUrl != undefined && imageUrl != '') {
            localStorage.setItem('image', imageUrl);
            window.location.href = CONFIG.siteUrl + '/create-card';
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

    $('#btn-evolve').click(function (e) {
        e.preventDefault();
        var format = $('#format').find(":selected").attr("value");
        var style = $("#style").find(":selected").attr("value");;
        var time = $("#time").find(":selected").attr("value");;
        var perspective = $("#perspective").find(":selected").attr("value");

        if (isEvovledResult) {
            if ($('.result-image.selected').length > 0) {
                var selectedImageUrl = $('.result-image.selected').data('url');
                if (selectedImageUrl != undefined) {
                    localStorage.setItem('image', selectedImageUrl);
                    console.log('selected image url', selectedImageUrl);
                    $('.evolve-result-toggle').show();
                    $('#btn-create-card').show();
                    $('.result-image').attr('style', "background: transparent url(" + loadingImageUrl + ") 0% 0% no-repeat padding-box;");
                    init_page();
                }
            } else {
                alert('Please select image for evolve first!');
            }
        } else {
            var text = '';
            if (format != undefined) {
                text += ' ' + format;
            }
            if (style != undefined) {
                text += ' ' + style;
            }
            if (time != undefined) {
                text += ' ' + time;
            }
            if (perspective != undefined) {
                text += ' ' + perspective;
            }
            if (text != ''){
                getEvovleResults(text);
            } else {
                alert('Please select modifiers!');
            }
        }
        // var imageUrl = $('.result-image.selected').data('url');
        // if (imageUrl != undefined && imageUrl != '') {
        //     localStorage.setItem('image', imageUrl);
        //     window.location.href = CONFIG.siteUrl + '/evolve-image';
        // }
    })

    function init_page () {
        isEvovledResult = false;
        prompt = localStorage.getItem('prompt');
        imageUrl = localStorage.getItem('image');
    
        if (imageUrl != undefined && imageUrl != '') {
            $('#evolve-img img').attr('src', imageUrl);
        }
        $('#evolve-results').hide();
        $('.evolve-results-title').hide();

        $('#filter-section').hide();
    }

    function getEvovleResults(text) {
        var data = {
            'action': 'evolve_action',
            'prompt': prompt + text,
            'init_image': imageUrl
        };

        $.ajax({
            type: 'POST',
            url: CONFIG.ajaxUrl,
            data: data,
            success: function (response) {
                var result = JSON.parse(response);
                if (result.id != undefined) {
                    $('#evolve-results').show();
                    $('.evolve-results-title').show();
                    $('.evolve-result-toggle').hide();
                    getPredictResultsOfKLMS(result.id);
                }
            }
        });
    }

    function getPredictResultsOfKLMS(id) {
        var data = {
            'action': 'klms_predict_result_action',
            'id': id,
        };

        $.ajax({
            type: 'POST',
            url: CONFIG.ajaxUrl,
            data: data,
            success: function (response) {
                var result = JSON.parse(response);
                if (result.status == 'succeeded' && result.output.length >= 3) {
                    $('#image1').attr('style', "background: transparent url(" + result.output[0] + ") 0% 0% no-repeat padding-box;");
                    $('#image2').attr('style', "background: transparent url(" + result.output[1] + ") 0% 0% no-repeat padding-box;");
                    $('#image3').attr('style', "background: transparent url(" + result.output[2] + ") 0% 0% no-repeat padding-box;");
                    $('#image1').attr('data-url', result.output[0]);
                    $('#image2').attr('data-url', result.output[1]);
                    $('#image3').attr('data-url', result.output[2]);
                    $('#btn-create-card').show();
                    isEvovledResult = true;
                } else if (result.status == 'processing' || result.status == 'starting') {
                    getPredictResultsOfKLMS(id);
                }
            }
        });
    }
}); 