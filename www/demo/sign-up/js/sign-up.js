/**
 * Created by planet17 on 08.03.16.
 * Time: 16:20
 */
$(function() {
    var formID = 'signUP';
    var $form = $('#' + formID);
    var linkFormAction = '/demo/sign-up/';
    var inputDataId = 'up-email';
    var $inputM = $form.find('#' + inputDataId);
    var valuesCSRF = $form.find('input[name="_csrf"]').val();
    var $helpBlockWrapper;

    var displayNextStep = function displayNextStep(){
        console.log("NextStepInit'");
    };

    var displayError = function displayError(errArray) {
        console.error(errArray);
        /* setTimeout cause we need wait until yii.js works will be done */
        setTimeout(function(){

            if ($helpBlockWrapper = getHelperWrapper()){
                var msg = errArray.join('<br>');
                $helpBlockWrapper.text(msg);
            }
            onChangeSetStateWrapperClassHelper(true);

        }, 100);
    };

    var getHelperWrapper = function getHelperWrapper(){
        var wrapperResponse = $inputM.parent().find('.help-block');
        return ( wrapperResponse.length > 0 ) ? wrapperResponse : null;
    };

    var onChangeSetStateWrapperClassHelper = function onChangeSetStateWrapperClassHelper(flag) {
        var $wrapper = $inputM.parent();
        $wrapper.toggleClass('has-success', (!flag) );
        $wrapper.toggleClass('has-error', (flag) );
    };

    var fnChecker = function fnChecker() {
        var valuesEmail = $inputM.val();
        if ( valuesEmail.length === 0) { return; }
        $.ajax({
            url: linkFormAction,
            dataType: "json",
            method: "POST",
            data: ({
                "_csrf": valuesCSRF,
                "Up": ({"email": valuesEmail}),
                "ajax": formID
            })
        }).done(function (r) {
            if ( (typeof r[inputDataId]) == "undefined") {
                onChangeSetStateWrapperClassHelper(false);
                displayNextStep();
            } else {
                displayError(r[inputDataId]);
            }
        }).fail(function (r) {
            console.error('Something wrong! Ajax-request has failed');
            console.error(r);
        });

    };
    var $checkBtn = $('#checkingMailUniqueness');
    $checkBtn.on('click', fnChecker);

    /* TODO formHandler = init(formID, [({data}), ... ]) */
    /* DATA:
    * ({ name: selector })
    * ex: [
    *   ({ "_csrf"      :   "input[name="_csrf"]"   }),
    *   ({ "Up[email]"  :   "#up-email"             }),
    * ],
    *
    * !!!Also need add automation get of name, if developer don't fill that
    * Need to change structure. Ok, than try some like:
    * data = [ [param1] [, [param2]] ]
    * paramN
    * [ selector [, name ] ],
    * ["input[name="_csrf"]"],
    * [#up-email]
    * */
});

