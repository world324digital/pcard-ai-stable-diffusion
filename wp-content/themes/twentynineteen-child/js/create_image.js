$(document).ready(function () {
    $('.modifier-container').hide();

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const predictId1 = urlParams.get('id1');
    // const predictId2 = urlParams.get('id2');

    getPredictResultsOfKLMS(predictId1);
    // getPredictResultsOfDDIM(predictId2);

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

    $('#download-image').click(function () {
        var url = $('.down-image').find('img').attr('src');
        $('.down-image a').remove(); 
        var fileName = "AI image.png";
        download(url, fileName);
    });

    $('.hover-text i').click(function () {
        var visibility =  $(this).parent().find('.tooltip-text').css('visibility');
        if (visibility == 'hidden') {
            $(this).parent().find('.tooltip-text').css({visibility: 'visible'});
        } else {
            $(this).parent().find('.tooltip-text').css({visibility: 'hidden'});
        }
    });

    function download(source, filename){
        var el = document.createElement("a");
        el.setAttribute("href", source);
        el.setAttribute("download", filename);
        el.setAttribute("target", '_blank');
        document.body.appendChild(el);
        el.click();
        el.remove();
    }

    $('.download-icon').click(function () {
        var imageUrl = $(this).parent('.result-image').data('url');
        $('#wow-modal-window-1').find('.down-image img').attr('src', imageUrl);
        $('#wow-modal-id-1').trigger('click');
        $('#image-share').attr('style', "background: transparent url(" + imageUrl + ") 0% 0% no-repeat padding-box;");
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

    $('#btn-evolve').click(function () {
        var imageUrl = $('.result-image.selected').data('url');
        if (imageUrl != undefined && imageUrl != '') {
            localStorage.setItem('image', imageUrl);
            window.location.href = CONFIG.siteUrl + '/evolve-image';
        }
    })

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

                } else if (result.status == 'processing' || result.status == 'starting') {
                    getPredictResultsOfKLMS(predictId1);
                }
            }
        });
    }

    function getPredictResultsOfDDIM(id) {
        var data = {
            'action': 'ddim_predict_result_action',
            'id': id,
        };

        $.ajax({
            type: 'POST',
            url: CONFIG.ajaxUrl,
            data: data,
            success: function (response) {
                var result = JSON.parse(response);
                if (result.status == 'succeeded' && result.output.length >= 3) {
                    $('#image4').attr('style', "background: transparent url(" + result.output[0] + ") 0% 0% no-repeat padding-box;");
                    $('#image5').attr('style', "background: transparent url(" + result.output[1] + ") 0% 0% no-repeat padding-box;");
                    $('#image6').attr('style', "background: transparent url(" + result.output[2] + ") 0% 0% no-repeat padding-box;");
                    $('#image4').attr('data-url', result.output[0]);
                    $('#image5').attr('data-url', result.output[1]);
                    $('#image6').attr('data-url', result.output[2]);
                } else if (result.status == 'processing' || result.status == 'starting') {
                    getPredictResultsOfDDIM(predictId2);
                }
            }
        });
    }
});