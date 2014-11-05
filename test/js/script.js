$.initSetup = function() {
    
    // Variables
    
    $.expanded = false;
    $.reduced = true;
    $.page = false;
    $.initPage = false;
    $.loadingPage = false;
    
    // Style
 
    $.updateRedirectStyle();
    
    $("#main").css("margin-top", $(window).height() * 0.4 - 60);
    $("#logo").css("top", $(window).height() * 0.4 - 90);
}

$.updateRedirectStyle = function() {
    var width = $(window).width();
    var height = $(window).height();
    
    $("#redirect").css({
        "width": width,
        "height": height,
        "left": width
    });
    $("#redirect img").css({
        "left": (width - $("#redirect img").width())/2,
        "top": (height - $("#redirect img").height())/2,
    })
}

$.mainSizes = function(usePage) {
    if (usePage == undefined) usePage = true;
    var height = 300;
    var heightAlt = $("#page").height() + 180;
    if(!usePage) var heightAlt = $("#hiddencontent").height() + 180;
    if (heightAlt > height) height = heightAlt;
    var marginTop = 40;
    var marginTopAlt = ($(window).height() - height) * 0.4 - 20;
    if (marginTopAlt > marginTop) marginTop = marginTopAlt;
    return [height, marginTop];
}

$.updateMainScale = function(usePage, complete) {
    if (usePage == undefined) usePage = true;
    if (complete == undefined || !complete) complete = function() {};
    
    if($.reduced) {
        console.log("updating reduced #main scaling");
        $("#main").animate({"margin-top": $(window).height() * 0.4 - 60}, {
            "duration": 500,
            "queue": true
        });
        $("#logo").animate({
            "top": $(window).height() * 0.4 - 90
        }, {
            "duration": 500,
            "queue": true,
            "complete": function() {complete();}
        });
        return;
    }
    
    if($.expanded) {
        console.log("updating expanded #main scaling");
        var height = $.mainSizes(usePage)[0];
        var marginTop = $.mainSizes(usePage)[1];
        $("#main").animate({"height": height, "margin-top": marginTop}, {
            "duration": 500,
            "queue": true
        });
        $("#logo").animate({
            "top": marginTop - 30
        }, {
            "duration": 500,
            "queue": true,
            "complete": function() {complete();}
        });
    }
}

$.go = function(page, addState, complete) {
    if (page == undefined) page = false;
    else if ([false, "info", "registrer", "spill", "facebook"].indexOf(page) == -1) {
        throw "error: Page \"" + page + "\" does not exist";
    }
    if (complete == undefined || !complete) complete = function() {};
    if (addState == undefined) addState = true;
    
    console.log("go(" + page + ", " + addState + ")");
    
    if (page == "facebook") {
        $.redirect('https://www.facebook.com/pages/Terningkast7/326959084072998');
        return;
    }
    
    if(addState) window.history.pushState({"page": page}, "", "?p=" + page);
    
    if(page) loadPage(page, complete);
    else reduce(complete);
    
    
    function expand(complete) {
        if ($.expanded) { complete(); return;}


        console.log("\texpanding");

        $.reduced = false;
        $("#main").animate({
            "height": 300,
            "margin-top": $(window).height() * 0.4 - 140
        }, {
            "duration": 500,
            "queue": true
        });
        $("#logo").animate({
            "top": $(window).height() * 0.4 - 170
        }, {
            "duration": 500,
            "queue": true,
            "complete": function(){ $.expanded = true; complete();}
        });
    }
    
    function reduce(complete) {
        if ($.reduced) { complete(); return;}
        if ($.page) { emptyPage(function(){ reduce(complete); }); return;}
        
    
        console.log("\treducing");
        
        $.expanded = false;
        $("#load").css("visibility", "hidden");
        $("#main").animate({
            "height": 100,
            "margin-top": $(window).height() * 0.4 - 60
        }, {
            "duration": 500,
            "queue": true
        });
        $("#logo").animate({
            "top": $(window).height() * 0.4 - 90
        }, {
            "duration": 500,
            "queue": true,
            "complete": function(){
                $("#load").css("visibility", "visible");
                $.reduced = true; complete();
            }
        });
    }
    
    function loadPage(page, complete) {
        if(!$.expanded) { expand(function(){ loadPage(page, complete);}); return;}

        if ($.page == page) { complete(); return;}
        else if($.page) { emptyPage(function(){ loadPage(page, complete);});return;}
        
    
        console.log("\tloading page: " + page);
        $.loadingPage = true;

        $("#" + page + " img").attr("src", "images/" + page + "_h.gif")
            .data("src", "images/" + page + "_h.gif");
        var content = new $("<div />").attr("id","content");
        content.load("pages/" + page + ".php", function(){
            $("#hiddencontent").html(content.html());
            $.updateMainScale(false);
            $("#load").animate({"opacity": 0}, {
                "duration": 500,
                "queue": true,
                "complete": function(){
                    $("#load").css("display", "none");
                    $("#page").css("opacity", 0).html($("#load")).append(content.html());
                    $.replaceCufon();
                    $.updateMainScale();
                    $("#page").animate({"opacity": 1}, {
                        "duration": 500,
                        "complete": function(){
                            $.page = page;
                            $.loadingPage = false;
                            complete();
                        }
                    });
                }
            });
        });
    }
    
    function emptyPage(complete) {
        if (!$.page) { complete(); return;}

    
        console.log("\temptying page");

        $("#page").animate({
            "opacity": 0
        }, {
            "duration": 500,
            "complete": function(){
                $("#page").html($("#load")).css("opacity", 1);
                $("#load").css({"display": "block", "opacity": 1});
                $("#" + $.page + " img").attr("src", "images/" + $.page + ".gif")
                    .data("src", "images/" + $.page + ".gif");
                $("#hiddencontent").html("");
                $.page = false; complete();
            }
        });
    }
}

$.redirect = function(location) {

        
    console.log("\tredirecting to " + location);
    $.loadingPage = true;
        
    $.updateRedirectStyle();
    $("#redirect").css("opacity", 1);
    $("#super").animate({"right": $(window).width()}, {"duration": 1000, "queue": true});
    $("#redirect").animate({"left": 0}, {"duration": 1000, "queue": true, "complete": function(){
        setTimeout(function(){ window.location.href = location;},800);
    }});
}


$.instant = function(page) {
    if (page == undefined) page = false;
    else if ([false, "info", "registrer", "spill", "registrering_fullfort",
            "registrering_feilet"].indexOf(page) == -1) return;
    
    
    console.log("instant(" + page + ")");
    
    if (page == "facebook") {
        redirect('https://www.facebook.com/pages/Terningkast7/326959084072998');
        return;
    }
    
    window.history.replaceState({"page": page}, "", "?p=" + page);
    
    if(page) loadPage(page, function() {});
    else reduce(function() {});
    
    
    
    function expand(complete) {
        if ($.expanded) { complete(); return;}

    
        console.log("\texpanding");

        $.reduced = false;
        $("#main").css({"height": 300, "margin-top": $(window).height() * 0.4 - 140});
        $("#logo").css("top", $(window).height() * 0.4 - 170);
        $.expanded = true; complete();
    }
    
    function reduce(complete) {
        if ($.reduced) { complete(); return;}
        if ($.page) { emptyPage(function(){ reduce(complete); }); return;}

    
        console.log("\treducing");
        
        $.expanded = false;
        $("#main").css({"height": 100,"margin-top": $(window).height() * 0.4 - 60});
        $("#logo").css("top", $(window).height() * 0.4 - 90);
        $.reduced = true; complete();
    }
    
    function loadPage(page, complete) {
        if(!$.expanded) { expand(function(){ loadPage(page, complete);}); return;}

        if ($.page == page) { complete(); return;}
        else if($.page) { emptyPage(function(){ loadPage(page, complete);});return;}

    
        console.log("\tloading page: " + page);
        $.loadingPage = true;

        $("#" + page + " img").attr("src", "images/" + page + "_h.gif")
            .data("src", "images/" + page + "_h.gif");
        var content = new $("<div />").attr("id","content");
        content.load("pages/" + page + ".php", function(){
            $("#hiddencontent").html(content.html());
            var height = $.mainSizes(false)[0];
            var marginTop = $.mainSizes(false)[1];
            $("#main").css({"height": height, "margin-top": marginTop});
            $("#logo").css("top", marginTop-30);
            $("#load").css("display", "none");
            $("#page").html($("#load")).append(content.html());
            $.replaceCufon();
            $.page = page;
            $.loadingPage = false;
            complete();
        });
    }
    
    function emptyPage(complete) {
        if (!$.page) { complete(); return;}

    
        console.log("\temptying page");

        $("#page").html($("#load"));
        $("#load").css({"display": "block", "opacity": 1});
        $("#" + $.page + " img").attr("src", "images/" + $.page + ".gif")
            .data("src", "images/" + $.page + ".gif");
        $("#hiddencontent").html("");
        $.page = false; complete();
    }


    function redirect(location) {
        console.log("\tredirecting to: " + location);
        
        window.location.href = location;
    }
}