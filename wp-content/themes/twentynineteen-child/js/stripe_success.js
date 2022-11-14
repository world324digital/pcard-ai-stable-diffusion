$(document).ready(function () {
    var credit_product_id = localStorage.getItem('credit_product_id');
    if (credit_product_id != undefined) {
        addCredits();
    }

    function addCredits() {
        var data = {
            'action': 'add_credits_action',
            'credit_product_id': credit_product_id,
        };

        $.ajax({
            type: 'POST',
            url: CONFIG.ajaxUrl,
            data: data,
            success: function (response) {
                var result = JSON.parse(response);
                localStorage.removeItem('credit_product_id');
                console.log(result.credits);
                if (result.status == 'success') {
                    $('#credit-value').text(result.credits.toString());
                    $('#credit-shortcode div').text("You currently have " + result.credits.toString() + " credits.");
                }
            }
        });
    }
}); 