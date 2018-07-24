$(document).ready(function () {
    if ($(".nette-popup")[0]) {
        $("body").addClass("nette-popup--shown");
    }
    $(".nette-popup__close--manual").on("click", function(event) {
        $("body").removeClass("nette-popup--shown");
    });
});

$(document).keyup(function (event) {
    if (event.keyCode == 27) {
        if ($("body").hasClass("nette-popup--shown")) {
            $.nette.ajax($(".nette-popup__close--manual").attr("href"));
            $("body").removeClass("nette-popup--shown");
        }
    }
});
