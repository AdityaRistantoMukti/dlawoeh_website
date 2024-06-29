//smooth-scroll
$("document").ready(function () {
    var nav_height = 70;

    $("a[data-role='smoothscroll']").click(function (e) {
        e.preventDefault();

        var position = $($(this).attr("href")).offset().top - nav_height;

        $("body, html").animate(
            {
                scrollTop: position,
            },
            1000
        );
        return false;
    });
});
