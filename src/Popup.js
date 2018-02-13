$(document).ready(function () {
    if ($(".nette-popup")[0]) {
        $("body").addClass("nette-popup--shown");
    }
    $(".nette-popup__close--manual").on("click", function(event) {
        $("body").removeClass("nette-popup--shown");
    });
});
