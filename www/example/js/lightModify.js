$(document).ready(function () {
    var questionConstructHelper = ({
            p: ({
                rb:({ classWithID: 'questionform-answerstypes', classFieldWithID: false, buttonBlockPath: false,}),
                ib:({ classWithID: 'questionform-answerstexts', classFieldWithID: false})
            }),
            constructOtherValues: function(){
                this.p.rb.classFieldWithID = 'field-'+ this.p.rb.classWithID;
                this.p.rb.buttonBlockPath = 'div.form-group[class*="'+this.p.rb.classFieldWithID+'"]';

                this.p.ib.classFieldWithID = 'field-'+ this.p.ib.classWithID;
                this.p.ib.buttonBlockPath = 'div.form-group[class*="'+this.p.ib.classFieldWithID+'"]';
            },
            aA: function () {


                var $lstButton = $(this.p.rb.buttonBlockPath+':last');
                var classNameString = $lstButton.attr('class');
                var classesName = classNameString.split(' ');
                for (var c in classesName) {
                    if (classesName[c].search(this.p.rb.classFieldWithID) != -1) {
                        var classId = classesName[c].replace(this.p.rb.classFieldWithID+'-', '').trim();
                        break;
                    }
                }
                var cnt = parseInt(classId) + 1;
                /** input */
                var $inputBlock = $('<div>').addClass('form-group').addClass(this.p.ib.classFieldWithID+'-' + cnt).addClass('required');
                var $iBL = $('<label>').addClass('control-label').attr('for', this.p.ib.classWithID+'-' + cnt).text('Answer text');
                var $iBI = $('<input>').attr('type', 'text').attr('id', this.p.ib.classWithID+'-' + cnt).addClass('form-control').attr('name', 'QuestionForm[answersTexts][' + cnt + ']').attr('required','required');
                var $dH = $('<div>').addClass('help-block');
                $inputBlock.append($iBL).append($iBI).append($dH);
                /** radio-buttons */
                var $radioButtons = $('<div>').addClass('form-group').addClass(this.p.rb.classFieldWithID+'-' + cnt);
                var $rBL1 = $('<label>').addClass('control-label').attr('for', 'projects_status').text('Does answer correct?');
                var $rBD = $('<div>').attr('id', 'projects_status').attr('data-toggle', 'buttons');

                var $rBL2 = $('<label>').addClass('btn').addClass('btn-default').addClass('active');
                var $rBI2 = $('<input>').attr('type', 'radio').addClass('project-status-btn').attr('name', 'QuestionForm[answersTypes][' + cnt + ']').val('0');
                $rBL2.append($rBI2).append('Нет');

                var $rBL3 = $('<label>').addClass('btn').addClass('btn-default');
                var $rBI3 = $('<input>').attr('type', 'radio').addClass('project-status-btn').attr('name', 'QuestionForm[answersTypes][' + cnt + ']').val('1');
                $rBL3.append($rBI3).append('Да');

                $rBD.append($rBL2).append($rBL3);
                $radioButtons.append($rBL1).append($rBD).append($dH);

                $lstButton.after($radioButtons).after($inputBlock);
            },
            rA: function(){
                $(this.p.rb.buttonBlockPath+':last').remove();
                $(this.p.ib.buttonBlockPath+':last').remove();
            }
        });

    questionConstructHelper.constructOtherValues();
    $('button.extendingFAdd').click(function () { questionConstructHelper.aA(); });
    $('button.extendingFRemove').click(function () { questionConstructHelper.rA(); });

    $('form').submit(function(e) {
        var cnt = [0, 0];
        $.each($(questionConstructHelper.p.rb.buttonBlockPath), function( i, v ) {
            var c = $(v).find('input:checked').val();
            if(c == 0 || c  === undefined){ cnt[0]++; } else if (c == 1) { cnt[1]++; }
        });
        if (!( cnt[0] > 0 && cnt [1] > 0)) {
            e.preventDefault();
            alert('You need at least one wrong and one wrong answer!');
        }
    });

    $(".myInfo").animate({opacity: 1.0}, 3000).slideUp("slow");
});