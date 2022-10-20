$( document ).ready(function() {


    console.log('11111');


    $('#lng_select').on('change', function() {
        let lng = $(this).val();

        console.log(lng);

        $.ajax({
            url: LNG_AJAX,
            type: 'post',
            data: {lng: lng, _csrf: yii.getCsrfToken()}
        }).done(function (response) {
            document.location.reload();
        });
    });



    $('#order-form').on('beforeSubmit', function () {
        let form = $(this);
        $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serializeArray()
            }
        )
            .done(function(data) {
                if(data.success) {
                    let alert = $('.alert-success');
                    alert.removeClass('d-none');
                    setTimeout(function() {
                        alert.addClass('d-none')
                    }, 5000);
                }
            })
            .fail(function () {

            })
        return false;
    })

});