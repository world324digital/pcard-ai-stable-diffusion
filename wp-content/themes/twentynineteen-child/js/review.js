$(document).ready(function () {
    $('#post-card').hide();
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const id = urlParams.get('id');
    getCardInfo(id);

    // var imageUrl = localStorage.getItem('image');
    // if (imageUrl != undefined) {
    //     $('#card-left-image .result-image').attr('style', "background: transparent url(" + imageUrl + ") 0% 0% no-repeat padding-box;");
    //     $('#card-left-image .result-image').attr('data-url', imageUrl);
    //     $('#evolve-card-image img').attr('src', imageUrl);
    //     $('#evolve-card-image img').attr('style', 'width: 120px;');
    // }

    $('#btn-buy-credit').click(function () {
        $('#wow-modal-id-2').trigger('click');
    })

    $('.download-icon').click(function () {
        var imageUrl = $(this).parent('.result-image').data('url');
        $('#wow-modal-window-1').find('.down-image img').attr('src', imageUrl);
        $('#wow-modal-id-1').trigger('click');
    })

    $('#share-image').click(function () {
        $('#wow-modal-close-1').trigger('click');
        $('#wow-modal-id-3').trigger('click');
    })

    

    function getCardInfo(id) {
        var data = {
            'action': 'get_cardinfo_action',
            'id': id,
        };

        $.ajax({
            type: 'POST',
            url: CONFIG.ajaxUrl,
            data: data,
            success: function (response) {
                var result = JSON.parse(response);
                if (result.status == 'succeeded') {
                    // if (result.card_image.length > 0) {
                        $('#card-left-image .result-image').attr('style', "background: transparent url(" + result.card_image[0] + ") 0% 0% no-repeat padding-box;");
                        $('#card-left-image .result-image').attr('data-url', result.card_image[0]);
                        $('#evolve-card-image img').attr('src', result.card_image[0]);
                        $('#evolve-card-image img').attr('style', 'width: 120px;');
                        $('#from-name > div').html('From: ' + result.from_name[0]);
                        $('#to-name > div').html('To: ' + result.to_name[0]);
                        $('#card-title h3').html('Hey ' + result.to_name[0]);
                        $('#card-message > div').html('<p>' + result.message[0] + '</p>');
                        $('#from h3').html(result.from_name[0]);
                        $('#post-card').show();
                    // }
                } else if (result.status == 'failed') {
                    getCardInfo(id);
                }
            }
        });
    }
}); 