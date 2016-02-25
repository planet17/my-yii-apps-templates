var obVanParts_space = obVanParts_space || ({});
obVanParts_space.pl17__helpers = obVanParts_space.pl17__helpers || ({
    /**
     * Function for error-output to the console
     * @param errMsg — exception what you get when after try-catch construction
     * @param [arrMsg] — array of helpers information if you wanna send
     */
    errorMsg: function pl17__helpersFunc__errorConsole(errMsg, arrMsg) {
        var stringDefinitionSpace = 'tryCatchError::obVanParts_space.pl17__helpers::';
        var stringScriptContinue = 'Anyway this exception is not crashed script working';
        console.warn(stringDefinitionSpace + errMsg);
        if (this.jsElemExist(arrMsg)) {
            for (var i in arrMsg) {
                /* TODO CREATE GROUPED MESSAGES */
                console.info(stringDefinitionSpace + arrMsg[i]);
            }
        }
        console.info(stringDefinitionSpace + stringScriptContinue);
    },
    /**
     * jQuery style for checking does element what you you need is exist at page
     * @param $elem — must jQueryObject
     * @returns {boolean}
     * N: you must compare @elem with string 'undefined'
     * Cause typeof every time return string
     */
    // if(typeof $elem!='undefined'){if($elem.length){return true;}}return false;
    jQElemExist: function pl17__helpersFunc__isExistElem__jq($elem) {
        if (typeof $elem != 'undefined') {
            if ($elem.length) {
                return true;
            }
        }
        return false;
    },
    jsElemExist: function pl17__helpersFunc__isExistElem__js($elem) {
        /* TODO: Now functionality the same like jQElemExist */
        /* TODO SOME isDefined : return (item !== undefined) && (item != null); */
        /* And can check the variables, but idk about element at page */
        /* cause now we do that */
        return this.jQElemExist($elem);
    },
    /**
     * TODO WRITE DESCRIPTION FOR GETTING A WORK EVENT
     * @returns {*}
     */
    jsGetBrowserTransitionEndEvent: function transitionEndEventNameByModernizrImproved () {
        var i;
        var undefined;
        var el = document.createElement('div');
        var transitions = {
            'transition':'transitionend',
            'OTransition':'otransitionend',  // oTransitionEnd in very old Opera
            'MozTransition':'transitionend',
            'WebkitTransition':'webkitTransitionEnd'
        };
        for (i in transitions) {
            if (transitions.hasOwnProperty(i) && el.style[i] !== undefined) {
                return transitions[i];
            }
        }
        //TODO: throw 'TransitionEnd event is not supported in this browser';
        return false;
    },
    jQNeedParamAJQuery: function pl17__helpersFunc__example($, obj) {
        return $(obj);
    },
    jQAjaxCbG : function pl17__helpersFuncCallBackingAjax($, cLink, getParams, f1, f2, f3, f4, obj){
        $.ajax({
            url: cLink,
            type: 'GET',
            data: getParams,
            dataType: 'json',
            beforeSend: function () { f2(obj); },
            success: function (json) { f1(json, obj); },
            complete: function () { f3(obj); },
            error: function () { f4(); }
        });
    }
});
