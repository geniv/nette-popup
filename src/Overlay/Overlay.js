$(document).ready(function () {
    $(".overlay-open").on("click", function (event) {
        event.preventDefault();

        var specificOverlay = $(this).data("specific");
        $("body").addClass("overlay-on");
        $(".overlay[data-specific='" + specificOverlay + "']").addClass("on");
        $(".overlay.out[data-specific='" + specificOverlay + "']").removeClass("out end");

        if ($(".overlay[data-specific='" + specificOverlay + "'] form")[0]) {
            $(".overlay[data-specific='" + specificOverlay + "'] form").find("input[type='text']").first().focus();
        }

        // $.scrollTo(".overlay[data-specific=" + specificOverlay + "]", 700, {
        //     easing: "easeOutExpo",
        //     interrupt: true,
        //     offset: {
        //         left: 0,
        //         top: 0
        //     }
        // });
    });

    $(".overlay-close, .overlay-backdrop").on("click", function (event) {
        event.preventDefault();
        $(".overlay.on").addClass("out").removeClass("on");
        $("body").removeClass("overlay-on");
        $(".overlay").one("webkitAnimationEnd oanimationend msAnimationEnd animationend", function () {
            $(".overlay.out").addClass("end");
        });
    });


});

// $(window).load(function () {
// });


$(document).keyup(function (e) {
    if (e.keyCode == 27) {
        $(".overlay.on").addClass("out").removeClass("on");
        $(".overlay").one("webkitAnimationEnd oanimationend msAnimationEnd animationend", function () {
            $(".overlay.out").addClass("end");
        });
    }
});
