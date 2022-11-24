$(document).ready(function () {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const id = urlParams.get('id');

    var imageUrl = localStorage.getItem('image');
    if (imageUrl != undefined) {
        $('#front-image').attr('style', "background: transparent url(" + imageUrl + ") 0% 0% no-repeat padding-box;");
        $('#front-image').attr('data-url', imageUrl);
        $('#image-share').attr('style', "background: transparent url(" + imageUrl + ") 0% 0% no-repeat padding-box;");
    }

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

    $('#btn-view').click(function (e) {
        e.preventDefault();
        window.location.href = CONFIG.siteUrl + '/view-card?id=' + id;
    })
}); 