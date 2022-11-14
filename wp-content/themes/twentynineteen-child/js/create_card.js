$(document).ready(function () {
    $('.postcard-preview').hide();
    $('.preview-controls').hide();
    $('.greetingcard-preview').hide();
    $('#agree-checkbox').val(0);
    var cardType = "";
    // $("#card-form").validate();

    $("#to_check").hide();
    $("#to_email_check").hide();
    $("#from_check").hide();
    $("#from_email_check").hide();
    $("#greeting_card_title_check").hide();
    $("#greeting_to_check").hide();
    $("#greeting_to_email_check").hide();
    $("#greeting_from_check").hide();
    $("#greeting_from_email_check").hide();
    let toError = true;
    let fromError = true;
    let fromEmailError = true;
    let toEmailError = true;
    let greetingCardTitleError = true;
    let greetingToError = true;
    let greetingFromError = true;
    let greetingFromEmailError = true;
    let greetingToEmailError = true;
    let isAgreeTerms = false;

    // $("#to").keyup(function () {
    //     validateName('to');
    // });

    // $("#from").keyup(function () {
    //     validateName('from');
    // });

    // $("#to_email").keyup(function () {
    //     validateEmail('to');
    // });

    // $("#from_email").keyup(function () {
    //     validateEmail('from');
    // });

    function validateName(name) {
        if (name == 'to') {
            let to = $("#to").val();
            if (to.length == "") {
                $("#to_check").show();
                toError = true;
                return false;
            } else {
                $("#to_check").hide();
                toError = false;
            }
        } else if (name == 'from') {
            let from = $("#from").val();
            if (from.length == "") {
                $("#from_check").show();
                fromError = true;
                return false;
            } else {
                $("#from_check").hide();
                fromError = false;
            }
        } else if (name == 'greeting_from') {
            let from = $("#greeting_from").val();
            if (from.length == "") {
                $("#greeting_from_check").show();
                greetingFromError = true;
                return false;
            } else {
                $("#greeting_from_check").hide();
                greetingFromError = false;
            }
        } else if (name == 'greeting_card_title') {
            let cardTitle = $("#greeting_card_title").val();
            if (cardTitle.length == "") {
                $("#greeting_card_title_check").show();
                greetingCardTitleError = true;
                return false;
            } else {
                $("#greeting_card_title_check").hide();
                greetingCardTitleError = false;
            }
        } else {
            let to = $("#greeting_to").val();
            if (to.length == "") {
                $("#greeting_to_check").show();
                greetingToError = true;
                return false;
            } else {
                $("#greeting_to_check").hide();
                greetingToError = false;
            }
        }
    }

    function validateEmail(email) {
        let regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
        if (email == 'to') {
            let toEmail = $('#to_email').val();
            let s = toEmail;
            if (regex.test(s) && s != '') {
                $("#to_email_check").hide();
                toEmailError = false;
            } else {
                $("#to_email_check").show();
                toEmailError = true;
            }
        } else if (email == 'from'){
            let fromEmail = $('#from_email').val();
            let s1 = fromEmail;
            if (regex.test(s1) && s1 != '') {
                $("#from_email_check").hide();
                fromEmailError = false;
            } else {
                $("#from_email_check").show();
                fromEmailError = true;
            }
        } else if (email == 'greeting_to'){
            let toEmail = $('#greeting_to_email').val();
            let s = toEmail;
            if (regex.test(s) && s != '') {
                $("#greeting_to_email_check").hide();
                greetingToEmailError = false;
            } else {
                $("#greeting_to_email_check").show();
                greetingToEmailError = true;
            }
        } else {
            let fromEmail = $('#greeting_from_email').val();
            let s1 = fromEmail;
            if (regex.test(s1) && s1 != '') {
                $("#greeting_from_email_check").hide();
                greetingFromEmailError = false;
            } else {
                $("#greeting_from_email_check").show();
                greetingFromEmailError = true;
            }
        }
    }

    function validateTerms() {
        isAgreeTerms = $('#agree-checkbox').val() == 1;
    }


    var imageUrl = localStorage.getItem('image');
    if (imageUrl != undefined) {
        $('#front-card img').attr('src', imageUrl);
        $('#greeting-front-card img').attr('src', imageUrl);
    }

    $('#btn-buy-credit').click(function () {
        $('#wow-modal-id-2').trigger('click');
    });

    $('#post-card1').on('click', function () {
        $('.greetingcard-preview').hide();
        $('.postcard-preview').show();
        $('.preview-controls').show();
        cardType = 'postcard';
    });

    $('#greeting-card').on('click', function () {
        $('.postcard-preview').hide();
        $('.greetingcard-preview').show();
        $('.preview-controls').show();
        cardType = 'greetingcard';
    });

    $('.agree-section label, .agree-section input').on('click', function () {
        var checkValue = $('#agree-checkbox').val();
        $('#agree-checkbox').val(Math.abs(checkValue - 1));
    });

    $('#btn-send-digital').on('click', function (e) {
        e.preventDefault();
        validateTerms();
        if (cardType == 'postcard') {
            validateName('to');
            validateName('from');
            validateEmail('to');
            validateEmail('from');
            if (!toError && !fromError && !toEmailError && !fromEmailError && isAgreeTerms) {
                saveCardInfo(cardType);
            }
        } else {
            validateName('greeting_to');
            validateName('greeting_card_title');
            validateName('greeting_from');
            validateEmail('greeting_to');
            validateEmail('greeting_from');
            if (!greetingToError && !greetingFromError && !greetingToEmailError && !greetingFromEmailError && !greetingCardTitleError && isAgreeTerms) {
                saveCardInfo(cardType);
            }
        }


        // $('#card-form').validate();
    });

    function saveCardInfo(cardType) {
        var data = null;
        if (cardType == 'postcard') {
            data = {
                'action': 'save_postcard_action',
                'to': $('#to').val(),
                'from': $('#from').val(),
                'to_email': $('#to_email').val(),
                'from_email': $('#from_email').val(),
                'msg': $('#msg').val(),
                'card_image': imageUrl,
                'card_type': cardType
            };
        } else {
            data = {
                'action': 'save_postcard_action',
                'title': $('#greeting_card_title').val(),
                'to': $('#greeting_to').val(),
                'from': $('#greeting_from').val(),
                'to_email': $('#greeting_to_email').val(),
                'from_email': $('#greeting_from_email').val(),
                'msg': $('#greeting_msg').val(),
                'card_image': imageUrl,
                'card_type': cardType
            };
        }

        $.ajax({
            type: 'POST',
            url: CONFIG.ajaxUrl,
            data: data,
            success: function (response) {
                var result = JSON.parse(response);
                if (result.status == 'succeeded' && result.id != '') {
                    window.location.href = CONFIG.siteUrl + '/finish-page?id=' + result.id;
                } else {
                    alert('Something went wrong! Please try again.');
                }
            }
        });
    }
});