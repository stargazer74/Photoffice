<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>{PAGETITLE}</title>
        <link href="./view/css/style.css" rel="stylesheet" type="text/css" />
        <!-- BEGIN CSSINCLUDES -->
        <link href="./view/css/{CSS}.css" rel="stylesheet" type="text/css" />
        <!-- END CSSINCLUDES -->
        <script type="text/javascript" src="./view/js/jquery-2.1.1.js"></script>
        <script type="text/javascript">
            // jquery.tools.min.js (history-Feature von .tabs()) greift auf $.browser
            // zu, das jQuery seit Version 1.9 nicht mehr liefert.
            if (!$.browser) {
                $.browser = { msie: /trident|msie/i.test(navigator.userAgent), version: '0' };
            }
            // jquery.fancybox-1.3.1.pack.js prüft $.support.opacity, das es seit
            // jQuery 1.9 nicht mehr gibt - ohne den Shim nimmt Fancybox fälschlich
            // den alten IE-Fallback (style.removeAttribute("filter")).
            if ($.support && typeof $.support.opacity === 'undefined') {
                $.support.opacity = true;
            }
        </script>
        <!-- BEGIN JSINCLUDES -->
        <script type="text/javascript" src="./view/js/{JAVASCRIPT}.js"></script>
        <!-- END JSINCLUDES -->
    </head>
    <body>
        <div id="logo_banner">
            <div id="logo">
                <div id="version_number">
                    Version {VERSION_NUMBER}
                </div>
            </div>
        </div>
		{CAMBACKGROUND}
        {NAVIGATIONBLOCK}
        {INFORMATIONBLOCK}
		{CONTENTBLOCK}
    </body>
</html>
