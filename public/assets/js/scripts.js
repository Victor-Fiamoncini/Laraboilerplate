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
})
