///<reference path="jquery.js" />
///<reference path="jqueryEasing.js" />

$("document").ready(function () {
    $(".show").click(function () {
        console.log("in Show");
        el = $(this);

        if (el.hasClass("hide")) {
            el.removeClass('hide');
            $("#top").stop(false, true).slideUp(400, 'easeOutBack');
        } else {
            el.addClass('hide');
            $("#top").stop(false, true).slideDown(400, 'easeOutBack');
        }
    });

    $(".r-nav-header").click(function () {
        console.log("in r-nav");
        var el = $(this);

        if (el.hasClass("hide")) {
            el.removeClass('hide');
            el.css("background-image", "url(img/tru.png)");
            //console.log(el.parent(".r-navigation").html());
            el.parent(".r-navigation").children("ul").slideDown(400, 'easeOutBack');
        } else {
            el.addClass('hide');
            el.css("background-image", "url(img/cong.png)");
            //console.log(el.parent(".r-navigation").html());
            el.parent(".r-navigation").children("ul").slideUp(400, 'easeOutBack');
        }


    });
});
