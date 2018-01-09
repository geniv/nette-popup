$(document).ready(function () {
    $(".nette-overlay-open").on("click", function (event) {
        event.preventDefault();

        var specificNetteOverlay = $(this).data("specific");
        $("body").addClass("nette-overlay-on");
        $(".nette-overlay[data-specific='" + specificNetteOverlay + "']").addClass("on");
        $(".nette-overlay.out[data-specific='" + specificNetteOverlay + "']").removeClass("out end");

        if ($(".nette-overlay[data-specific='" + specificNetteOverlay + "'] form")[0]) {
            $(".nette-overlay[data-specific='" + specificNetteOverlay + "'] form").find("input[type='text']").first().focus();
        }
    });

    $(".nette-overlay-close, .nette-overlay-backdrop").on("click", function (event) {
        event.preventDefault();
        $(".nette-overlay.on").addClass("out").removeClass("on");
        $("body").removeClass("nette-overlay-on");
        $(".nette-overlay").one("webkitAnimationEnd oanimationend msAnimationEnd animationend", function () {
            $(".nette-overlay.out").addClass("end");
        });
    });
});

$(document).keyup(function (e) {
    if (e.keyCode == 27) {
        $(".nette-overlay.on").addClass("out").removeClass("on");
        $("body").removeClass("nette-overlay-on");
        $(".nette-overlay").one("webkitAnimationEnd oanimationend msAnimationEnd animationend", function () {
            $(".nette-overlay.out").addClass("end");
        });
    }
});
