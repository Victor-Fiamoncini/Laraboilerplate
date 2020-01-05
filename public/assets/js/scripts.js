$(function() {
    const passwordStrength = $('div.password-strength').hide()
    const messageSpan = passwordStrength.find('span')

    /**
     * @description Change the value of the text as well as its class
     * @param {number} numberOfChars
     */
    const getMessageSpanValue = numberOfChars => {
        if (numberOfChars >= 0 && numberOfChars <= 5) {
            messageSpan
                .addClass('text-danger')
                .removeClass('text-yellow text-success')
                .text('weak')
        } else if (numberOfChars >= 6 && numberOfChars < 9) {
            messageSpan
                .addClass('text-yellow')
                .removeClass('text-danger text-success')
                .text('medium')
        } else if (numberOfChars >= 9) {
            messageSpan
                .addClass('text-success')
                .removeClass('text-yellow text-danger')
                .text('large')
        }
    }

    $('input[name="password"]').bind('keydown', 'change', function() {
        getMessageSpanValue($(this).val().length)
        passwordStrength.fadeIn()
    })

    /**
     * Messages fade out
     */
    setTimeout(() => {
        $('div.alert-dismissible').fadeOut(300)
    }, 5000)

    /**
     * Autocomplete address infos
     */
    $('input[name="zipcode"]').focusout('mouseleave', function() {
        const input = $(this)
        input.siblings('small').hide()

        $.ajax({
            url: `https://viacep.com.br/ws/${input.val()}/json/`,
            type: 'GET',
            dataType: 'json',
            success: response => {
                if (response.erro) {
                    input.siblings('small').fadeIn(300).text('Invalid zipcode')
                    return
                }
                input.siblings('small').fadeOut(300).text('')
                $('input[name="street"]').val(response.logradouro)
                $('input[name="complement"]').val(response.complemento)
                $('input[name="neighborhood"]').val(response.bairro)
                $('input[name="city"]').val(response.localidade)
                $('input[name="state"]').val(response.uf)
            }
        })
    })

    /**
     * Input file style
     */
    $('input[type="file"]').change(function() {
        $(this)
            .siblings('.custom-file-label')
            .addClass('selected')
            .find('small')
            .text('File selected')
            .addClass('text-success')
            .siblings('i')
            .addClass('color-success')
    })

    /**
     * Mask for form inputs
     */
    $('input[name="date_of_birth"]').mask('00/00/0000')
    $('input[name="zipcode"]').mask('00000-000')
    $('input[name="cell"]').mask('(00) 00000-0000')
    $('input[name="telephone"]').mask('0000-0000')
    $('input[name="document_company"]').mask('00.000.000/0000-00', { reverse: true })
    $('input[name="document_company_secondary"]').mask('99.999.999-9')
})
