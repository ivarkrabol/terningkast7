<!DOCTYPE html>
<html>
    <head>
        <title>Terningkast7</title>
        <link rel="icon" type="image/png" href="favicon.png">
        <link rel="stylesheet" type="text/css" href ="style.css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="js/cufon-yui.js"></script>
        <script type="text/javascript" src="js/bank-gothic_400.font.js"></script>
        <script type="text/javascript" src="js/cufon-replace.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="js/validere-registreringsskjema.js"></script>
        <script type="text/javascript">
            $(function() {
                $.initSetup();
               
                $("#nav li").hover(function(){
                    var img = $("img", this);
                    var src = img.attr("src");
                    img.data("src", src);
                    img.attr("src", "images/" + $("a", this).attr("id") + "_h.gif");
                }, function() {
                    var img = $("img", this);
                    img.attr("src", img.data("src"));
                });
                
                if(<?php echo isset($_GET["p"])?"true":"false" ?>) {
                    //setTimeout(function(){$.instant("<?=$_GET["p"]?>");}, 500);
                    $.instant("<?=$_GET["p"]?>");
                    $.initPage = true;
                }
                
                window.setInterval(function(){
                    if($(window).data("width") != $(window).width()) {
                        $.updateRedirectStyle();
                    }
                    $(window).data("width", $(window).width());
                    
                    var page = $("#page");
                    if (page.data("height") != page.height()
                        || $(window).data("height") != $(window).height()) {
                        if (!$.loadingPage) $.updateMainScale();
                    }
                    page.data("height", page.height());
                    $(window).data("height",$(window).height());
                }, 300);
                
                
                window.setInterval(function(){
                    $.updateRedirectStyle();
                    if (!$.loadingPage) $.updateMainScale();
                }, 5000);
                
            });

            window.onpopstate = function(e) {
                if($.initPage == true) {
                    $.initPage = false;
                    return;
                }
                if (e.state == undefined || e.state.page == undefined) {
                    $.go(false, false);
                } else $.go(e.state.page, false);
            };
        </script>
    </head>
    <body>
        <div id="super"><div id="center">
            <img id="logo" src="images/logo.png" alt="Logo" onclick="$.go()">
            
            <div id="main">
                <div id="header">
                    <h1>Terningkast<span style="display: none;">7</span></h1>
                    <ul id="nav">
                        <li><a id="info" href="javascript:$.go('info')" title="Informasjon"><img src="images/info.gif" alt="Informasjon"></a></li>
                        <li><a id="registrer" href="javascript:$.go('registrer')" title="Registrer deg"><img src="images/registrer.gif" alt="Registrer deg"></a></li>
                        <li><a id="spill" href="javascript:$.go('spill')" title="Spilloversikt"><img src="images/spill.gif" alt="Spilloversikt"></a></li>
                        <li><a id="facebook" href="javascript:$.go('facebook')" title="Besøk oss på Facebook">
                                <img src="images/facebook.gif" alt="Besøk oss på Facebook"></a></li>
                    </ul>
                </div>
                <div id="page">
                    <img id="load" src="images/load2.gif">
                </div>
                <div id="hiddencontent"></div>
            </div>
        </div></div>
        <div id="redirect">
            <img src="images/load.gif" alt="Redirecting...">
        </div>
    </body>
</html>
