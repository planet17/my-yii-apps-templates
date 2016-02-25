/** Created by planet17 on 06.10.15. */
$(document).ready(function() {
    /**
     * For start works of popup-form (modal) run init function
     * @type {{init: Function}}
     * need param jQuery
     */
    var callbackOrderForm = ({
        init: function ($) {
            /** set current link and jQuery */
            var _t = this; _t.$ = $;
            /** set data and links to that object */
            _t.$wrapper = $('div.md-modal#call-modal');
            _t.$form = _t.$wrapper.find('form#sendMeOrder');
            _t.action = _t.$form.attr('action');
            _t.$buttonSend = _t.$form.find('input[type=submit]');
            /** set data to additional buttons */
            _t.$buttonsModal = $('.btn.modal');
            _t.$buttonsClose = $('.md-close');
            /**
             * set eventHandler to form beforeSubmit cause it workaround
             * for fix double fired of submit from yii.js and custom scripts
             */
            _t.$form.on('beforeSubmit', function () { _t.send(); return false; });
            /**
             * set eventHandler for showing popupWindow (modal)
             */
            _t.$buttonsModal.click(function () {
                if ($(this).data('modal') == _t.$wrapper.attr('id')) {
                    _t.$wrapper.addClass('md-show');
                } else {
                    console.error("Id\'s is different\n" + $(this).data('modal') + ' == ' + _t.$wrapper.attr('id') );
                }

            });
            /**
             * set eventHandler for hide popupWindow (modal)
             */
            _t.$buttonsClose.click(function () {
                _t.$wrapper.removeClass('md-show');});
        },
        send: function () {
            var _t = this; var d = _t.$form.serialize();
            _t.$.ajax({
                url: _t.action, type: 'POST', data: d, dataType: 'json',
                beforeSend: function () { },
                success: function () { alert(_t.msg.scs); },
                error: function () { alert(_t.msg.err); },
                complete: function () {
                    setTimeout(function () { _t.$wrapper.removeClass('md-show'); }, 1500);
                }
            });
        },
        $: ({}), $wrapper: ({}), action: ({}), $form: ({}), $buttonSend: ({}), $buttonsModal: ({}),
        msg: ({
            scs: 'Заявки обрабатываются в порядке очереди',
            err: 'Ошибка отправки сообщения'
        })
    });

    callbackOrderForm.init(jQuery);

    /**
     * SLIDERS
     * use Swiper 3.3.0 by Vladimir Kharlampidi from http://www.idangero.us/
     * Requirement including file:
     *      /promo/js/nolimits4web.swiper.js
     */
    var $sliderObjects = $('.swiper-container');
    var swipers = [];

    $.each($sliderObjects, function( i, obj ) {

        var swiper = new Swiper(obj, {
            pagination: $(obj).find('.swiper-pagination'),
            slidesPerView: 3, paginationClickable: !0, spaceBetween: 100,
            nextButton: $(obj).find('.swiper-button-next'),
            prevButton: $(obj).find('.swiper-button-prev'),
            grabCursor: !0, loop: !0
        });

        swipers.push(swiper);
    });

    /** PLUSO */
    (function() {
        if (window.pluso)
            if (typeof window.pluso.start == "function") return;
        if (window.ifpluso == undefined) {
            window.ifpluso = 1;
            var d = document,
                s = d.createElement('script'),
                g = 'getElementsByTagName';
            s.type = 'text/javascript';
            s.charset = 'UTF-8';
            s.async = true;
            s.src = ('https:' == window.location.protocol ? 'https' : 'http') + '://share.pluso.ru/pluso-like.js';
            var h = d[g]('body')[0];
            h.appendChild(s);
        }
    })();

});