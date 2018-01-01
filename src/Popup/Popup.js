$(document).ready(function () {
    $(".nette-popup-open").on("click", function(event) {
        event.preventDefault();

        var specificNettePopup = $(this).data("specific");
        $("body").addClass("nette-popup-on");
        $(".nette-popup[data-specific='" + specificNettePopup + "']").addClass("on");
        $(".nette-popup.out[data-specific='" + specificNettePopup + "']").removeClass("out end");
    });

    $(".nette-popup-close, .nette-popup-backdrop").on("click", function(event) {
        event.preventDefault();
        $(".nette-popup.on").addClass("out").removeClass("on");
        $("body").removeClass("nette-popup-on");
        $(".nette-popup").one("webkitAnimationEnd oanimationend msAnimationEnd animationend", function() {
            $(".nette-popup.out").addClass("end");
        });
    });
});

$(document).keyup(function(e) {
    if (e.keyCode == 27) {
        $(".nette-popup.on").addClass("out").removeClass("on");
        $("body").removeClass("nette-popup-on");
        $(".nette-popup").one("webkitAnimationEnd oanimationend msAnimationEnd animationend", function() {
            $(".nette-popup.out").addClass("end");
        });
    }
});
