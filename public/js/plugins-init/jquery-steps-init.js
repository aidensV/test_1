(function($) {
    "use strict"

    var form = $("#step-form-horizontal");
    form.children('div').steps({
        headerTag: "h4",
        bodyTag: "section",
        autoFocus: true,
        transitionEffect: "slideLeft",
        labels:
            {
                finish: "simpan",
                next: "selanjutnya",
                previous:"kembali",
            },
        onStepChanging: function (event, currentIndex, newIndex)
        {
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinished:function (event,currentIndex) {
            return form.submit();
        }
    });






})(jQuery);