<!DOCTYPE html>
<html>
<head>
<title>Oppdaterer spilloversikt</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">
    body {
    background-color: #e1e1e1;
    background-image: url('http://terningkast7.org/test/images/email_top_2.gif');
    background-repeat: no-repeat;
    background-position: center top;
    font-family: "Helvetica", "Arial", sans-serif;
    }
    #page {
    width: 760px;
    padding: 20px;
    margin: 132px auto 35px;
    background: #fff;
    font-size: 12px;
    color: #0f0f0f;
    }
    h1 {
    font-size: 1.5em;
    font-family: "Helvetica", "Arial", sans-serif;
    }
</style>
</head>
<body><div id="page">
<h1>Oppdaterer spilloversikt</h1>
<pre>
<?php

    $bgg_simplexml = simplexml_load_file('http://www.boardgamegeek.com/xmlapi/collection/terningkast7?own=1');
    
    
    $local_simplexml = simplexml_load_file('spill.xml');
    
    
    $a = 0; // Added games counter
    $r = 0; // Removed games counter
    
    $spillutvalg = array();
    foreach($bgg_simplexml->item as $bgg_item) {
        $bgg_stats = $bgg_item->stats->attributes();
        
        $spill = array();
        
        echo "Game: $bgg_item->name, id: {$bgg_item->attributes()->objectid}\n";
        $new = true;
        foreach($local_simplexml->spill as $local_spill) {
            if ("$local_spill->id" == "{$bgg_item->attributes()->objectid}") {
                echo "Found match: $local_spill->navn\n";
                $new = false;
                $spill = $local_spill;
                break;
            }
        }
        if($new) {
            echo "No match, adding new game.\n";
            $spill = array(
                "navn" => $bgg_item->name,
                "id" => $bgg_item->attributes()->objectid,
                "utgittår" => $bgg_item->yearpublished,
                "bilde" => $bgg_item->image,
                "thumb" => $bgg_item->thumbnail,
                "antallspillere" => $bgg_stats->minplayers." - ".$bgg_stats->maxplayers,
                "spilletid" => $bgg_stats->playingtime,
                "beskrivelse" => "",
                "destroyed" => "false"
                );
            $a++;
        }
        $spillutvalg[] = $spill;
    }
    
    foreach($local_simplexml->spill as $local_spill) {
        if(!in_array($local_spill, $spillutvalg)) {
            echo "No match found for game: $local_spill->navn,"
                    ."id: $local_spill->id. Marked as destroyed.\n";
            $local_spill->destroyed = "true";
            $spillutvalg[] = $local_spill;
            $r++;
        }
    }
    
   
    echo "\n\n";
    
    $output_xml = "<?xml version='1.0' encoding='UTF-8'?>\n<root>\n";
    foreach($spillutvalg as $spill) {
        $output_xml .= "\t<spill>\n";
        foreach($spill as $k => $v) $output_xml .= "\t\t<$k>".htmlspecialchars ($v)."</$k>\n";
        $output_xml .= "\t</spill>\n";
    }
    $output_xml .= "</root>";
    
    echo "DATA:\n".htmlspecialchars($output_xml)."\n\n";
    
    rename("spill.xml", "spill.xml.old");
    echo "renaming spill.xml -> spill.xml.old\n";
    if (file_put_contents("spill.xml", $output_xml) === false) {
        rename("spill.xml.old", "spill.xml");
        echo "file_put_contents failed. renaming spill.xml.old -> spill.xml\n";
    }
    else {
        unlink("spill.xml.old");
        echo "file_put_contents successful. deleting spill.xml.old\n";
    }
    
    
    echo "\nSpillioversikten er oppdatert\nAntall lagt til: $a\nAntall fjernet: $r\n"
            . "Totalt antall etter oppdatering: ".count($spillutvalg);
?>
</pre>
<p>Gå til <a href="../?p=spill">SPILLOVERSIKTEN</a> for å se resultatet.</p>
</div></body>
</html>