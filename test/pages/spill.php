<h2>Spilloversikt</h2>
<p>Dette er en oversikt over spillene vi har tilgjengelig hos Terningkast7</p>

<?php

    $spill_simple_xml = simplexml_load_file("../xml/spill.xml");
    
    foreach($spill_simple_xml->spill as $spill) {
        if($spill->destroyed == "true") continue;
        
        foreach($spill as $k => $v) ${$k} = $v;
        
        $timer = (int)($spilletid / 60);
        if ($timer > 0) $timer .= "t ";
        else $timer = "";
        $minutter = ($spilletid % 60);
        
        $lav = "";
        if(!isset($beskrivelse) || !$beskrivelse) $lav = " lav";
        
        echo "<div class=\"spill\" onclick=\"$.redirect('http://boardgamegeek.com/boardgame/$id')\">\n";
        echo "\t<h3 class=\"navn\">$navn <span class=\"utgittår\">($utgittår)</span></h3>\n";
        echo "\t<div class=\"bilde\"><img src=\"$thumb\" alt=\"$navn\"></div>\n";
        echo "\t<div class=\"spillere$lav\">$antallspillere</div>\n";
        echo "\t<div class=\"spilletid$lav\">$timer{$minutter}m</div>\n";
        echo "\t<div class=\"beskrivelse\">$beskrivelse</div>\n";
        echo "\t<div class=\"clearer\"></div>\n";
        echo "</div>\n\n";
    }
    

?>

<p>Data er hentet fra <a href="http://boardgamegeek.com/" alt="BoardGameGeek.com">BoardGameGeek.com</a>.</p>