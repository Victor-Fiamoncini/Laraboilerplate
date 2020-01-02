$(function() {
    const passwordStrength = $('div.password-strength').hide()
    const messageSpan = passwordStrength.find('span')

    /**
     * @description Change the value of the text as well as its class
     * @param {number} numberOfChars
     */
    const getMessageSpanValue = numberOfChars => {
        let messages = {
            0: () => messageSpan
                .addClass('text-danger')
                .removeClass('text-yellow text-success')
                .text('weak'),
            6: () => messageSpan
                .addClass('text-yellow')
                .removeClass('text-danger text-success')
                .text('medium'),
            10: () => messageSpan
                .addClass('text-success')
                .removeClass('text-yellow text-danger')
                .text('large'),
            default: () => {}
        }
        return (messages[numberOfChars] || messages.default)()
    }

    $('input[name="password"]').bind('keydown', 'change', function() {
        getMessageSpanValue($(this).val().length)
        passwordStrength.fadeIn()
    })
})
