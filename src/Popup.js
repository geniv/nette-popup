$(document).ready(function () {
    if ($(".nette-popup")[0]) {
        $("body").addClass("nette-popup-on");
    }
    $(".nette-popup-manual-close").on("click", function(event) {
        $(".nette-popup.on").addClass("out end").removeClass("on"); // nejspis se vubec nema jak provest
        $("body").removeClass("nette-popup-on");
    });
});
