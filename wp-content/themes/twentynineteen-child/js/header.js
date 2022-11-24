$(document).ready(function () {
    getUserCredits();

    $('.create-header a').click(function (e) {
        e.preventDefault();
        var prompt = $('#prompt').val();
        prompt = "Landscape with a Light Blue Haze on a Clear Mirror Lake";


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
    });

    $('.credit-menu').click(function () {
        $('#wow-modal-id-2').trigger('click');
    });

    $('.pricing-item .item-right input[type="submit"]').click(function (e) {
        e.preventDefault();
        var product_id = $(this).parent().find('input[name="wpsc_product_id"]').val();
        var parent_form = $(this).parent();
        localStorage.removeItem('credit_product_id');
        localStorage.setItem('credit_product_id', product_id);
        parent_form.submit();
    });

    function getUserCredits() {
        $.ajax({
            type: 'POST',
            url: CONFIG.ajaxUrl,
            data: {
                'action': 'get_user_credits_action'
            },
            success: function (response) {
                var result = "0";
                if (response) {
                    result = JSON.parse(response);
                }
                $('#credit-value').text(result);
                $('.credit_value').text(result);
            }
        });
    }
});