<!DOCTYPE html>
<html>
<head>
<title>Oppdaterer spilloversikt</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">
    body {
    background-color: #e1e1e1;
    background-image: url('http://terningkast7.org/images/email_top_2.gif');
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

    $spill_bgg_simplexml = simplexml_load_file('http://www.boardgamegeek.com/xmlapi/collection/terningkast7?own=1');
    
    
    $spill_local_simplexml = simplexml_load_file('spill.xml');
    
    
    $spillutvalg = array();
    foreach($spill_bgg_simplexml->item as $spill_bgg_item) {
        $bgg_stats = $spill_bgg_item->stats->attributes();
        
        $spill_spill = array();
        
        print_r("Game: $spill_bgg_item->name, id: {$spill_bgg_item->attributes()->objectid}\n");
        foreach($spill_local_simplexml->spill as $spill_local_spill) {
            $new = true;
            $spill_local_spill->match = false;
            if ("$spill_local_spill->id" == "{$spill_bgg_item->attributes()->objectid}") {
                print_r("Found matching id: $spill_local_spill->navn\n");
                $new = false;
                $spill_spill = $spill_local_spill;
                $spill_local_spill->match = true;
                break;
            }
        }
        if($new) {
            print_r("No matches, adding new game.\n");
            $spill_spill = array(
                "navn" => $spill_bgg_item->name,
                "id" => $spill_bgg_item->attributes()->objectid,
                "utgittår" => $spill_bgg_item->yearpublished,
                "bilde" => $spill_bgg_item->image,
                "thumb" => $spill_bgg_item->thumbnail,
                "antallspillere" => $bgg_stats->minplayers." - ".$bgg_stats->maxplayers,
                "spilletid" => $bgg_stats->playingtime,
                "beskrivelse" => "",
                "destroyed" => "false"
                );
        }
        $spillutvalg[] = $spill_spill;
    }
    
    foreach($spill_local_simplexml->spill as $spill_local_spill) {
        if(!$spill_local_spill->match) {
            print_r("No match found for game: $spill_local_spill->navn,"
                    ."id: $spill_local_spill->id. Marked as destroyed.\n");
        }
    }
    
   
    print_r("\n\n");
    
    $output_xml = "<?xml version='1.0' encoding='UTF-8'?>\n<root>\n";
    foreach($spillutvalg as $spill) {
        $output_xml .= "\t<spill>\n";
        foreach($spill as $k => $v) $output_xml .= "\t\t<$k>".htmlspecialchars ($v)."</$k>\n";
        $output_xml .= "\t</spill>\n";
    }
    $output_xml .= "</root>";
    
    print_r("DATA:\n".htmlspecialchars($output_xml)."\n\n");
    
    rename("spill.xml", "spill.xml.old");
    print_r("renaming spill.xml -> spill.xml.old\n");
    if (file_put_contents("spill.xml", $output_xml) === false) {
        rename("spill.xml.old", "spill.xml");
        print_r("file_put_contents failed. renaming spill.xml.old -> spill.xml\n");
    }
    else {
        unlink("spill.xml.old");
        print_r("file_put_contents successful. deleting spill.xml.old\n");
    }
    
    
    echo "\nSpillioversikten er oppdatert";
?>
</pre>
<p>Gå til <a href="http://terningkast7.org/?p=spill">SPILLOVERSIKTEN</a> for å se resultatet.</p>
</div></body>
</html>