<?php

    function mail_registrering($fornavn, $etternavn, $fodselsar, $adresse,
                $postnummer, $poststed, $kommune, $telefonnummer, $e_postadresse) {
        // recipient
        //$to = "registrering@terningkast7.org";
        $to = "ivarhk@gmail.com";
        // subject
        $subject = "Nytt medlem: ".mb_convert_encoding("$etternavn, $fornavn", "UTF-8", "ISO-8859-1");

        // message
        $message = "
        <html>
        <head>
        <title>Nytt medlem: $etternavn, $fornavn</title>
        <style type=\"text/css\">
            body {
            background-color: #e1e1e1;
            background-image: url('http://terningkast7.org/test/images/email_top_2.gif');
            background-repeat: no-repeat;
            background-position: center top;
            }
            #page {
            width: 760px;
            padding: 20px;
            margin: 132px auto 35px;
            background: #fff;
            font-size: 12px;
            color: #0f0f0f;
            }
            h1 { font-size: 1.5em;}
            h3 { font-size: 1.2em;}
            * { font-family: \"Helvetica\", \"Arial\", sans-serif;}
            td, th { margin: 2px; font-size: 10px; text-align: left;}
            td { font-size: 12px; overflow: hidden;}
        </style></head>
        <body><div id=\"page\">
        <h1>Nytt medlem: $etternavn, $fornavn</h1>
        <table width=\"760\"><tr><th>Etternavn, Fornavn:</th>
        <th>F.&aring;r:</th><th>Adresse:</th><th>Postnr:</th><th>Poststed:</th>
        <th>Kommune:</th><th>Tlf.:</th><th>E-post:</th><th>Medlem siden</th></tr>
        <tr><td>$etternavn, $fornavn</td><td>$fodselsar</td>
        <td>$adresse</td><td>$postnummer</td><td>$poststed</td><td>$kommune</td>
        <td>$telefonnummer</td><td>$e_postadresse</td><td>".date("d.m.y")."</td>
        </tr></table>
        <p>Mvh. Terningkast7</p>
        </div></body>
        </html>
        ";

        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        // From headers
        $headers .= 'From: Terningkast7 Automail <automail@terningkast7.org>' . "\r\n";

        // Mail it
        return mail($to, $subject, $message, $headers);

    }

    function mail_til_medlem($fornavn, $etternavn, $e_postadresse) {
        // recipient
        $to = $e_postadresse;

        // subject
        $subject = "Velkommen som nytt medlem i Terningkast7!";

        // message
        $message = "
        <html>
        <head>
        <title>Velkommen som nytt medlem i Terningkast7!</title>
        <style type=\"text/css\">
            body {
            background-color: #e1e1e1;
            background-image: url('http://terningkast7.org/test/images/email_top.gif');
            background-repeat: no-repeat;
            background-position: center top;
            }
            #page {
            width: 505px;
            padding: 20px;
            margin: 132px auto 35px;
            background: #fff;
            font-size: 12px;
            color: #0f0f0f;
            }
            h1 { font-size: 1.5em;}
            h3 { font-size: 1.2em;}
            * { font-family: \"Helvetica\", \"Arial\", sans-serif;}
        </style>
        </head>
        <body><div id=\"page\">
        <h1>Velkommen som medlem i Terningkast7!</h1>
        <p>Hei $fornavn $etternavn, og velkommen som nytt medlem i Terningkast7. 
        Vi setter stor pris p&aring; at du har valgt &aring; bli med oss, og vi 
        h&aring;per og tror at du fort kan f&aring; mye moro ut av det selv 
        ogs&aring;.</p>
        <p>N&aring;r det gjelder medlemskontigenten p&aring; kr 50,- kan den 
        betales p&aring; to m&aring;ter. Enten kan du ta kontakt med en av oss 
        i styret, og gj&oslash;re opp kontant, eller du kan betale inn summen 
        til v&aring;r konto med kontonummer</p>
        <h4>KONTONUMMER</h4>
        <p>NB! Dersom du betaler det direkte inn p&aring; kontoen, er det 
        viktig at du skriver det fulle navnet ditt i meldingsfeltet, slik at vi 
        lettere kan se hvem betalingen gjelder. </p>
        <p>Vi gleder oss til &aring; se deg p&aring; fremtidige spillkvelder og 
        andre arrangementer!</p>
        <p>Mvh. Terningkast7</p>
        </div></body>
        </html>
        ";

        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        // From headers
        $headers .= 'From: Terningkast7 <registrering@terningkast7.org>' . "\r\n";

        // Mail it
        return mail($to, $subject, $message, $headers);

    }
    
    function mail_oops($fornavn, $etternavn, $e_postadresse) {
        // recipient
        //$to = "registrering@terningkast7.org";
        $to = "ivarhk@gmail.com";
        // subject
        $subject = "Feil ved registrering av nytt medlem: ".mb_convert_encoding("$etternavn, $fornavn", "UTF-8", "ISO-8859-1");

        // message
        $message = "
        <html>
        <head>
        <title>Feil ved registrering av nytt medlem: $etternavn, $fornavn</title>
        <style type=\"text/css\">
            body {
            background-color: #e1e1e1;
            background-image: url('http://terningkast7.org/test/images/email_top.gif');
            background-repeat: no-repeat;
            background-position: center top;
            }
            #page {
            width: 505px;
            padding: 20px;
            margin: 132px auto 35px;
            background: #fff;
            font-size: 12px;
            color: #0f0f0f;
            }
            h1 { font-size: 1.5em;}
            h3 { font-size: 1.2em;}
            * { font-family: \"Helvetica\", \"Arial\", sans-serif;}
        </style>
        </head>
        <body><div id=\"page\">
        <h1>Feil ved registrering av nytt medlem: $etternavn, $fornavn</h1>
        <p>Denne mailen er sendt for &aring; fortelle deg at noe gikk galt ved
        registeringen av det nye medlemmet $fornavn $etternavn, slik at 
        vedkommende ikke fikk mottatt noen bekreftelse p&aring; sitt nye medlemskap p&aring; 
        e-post.</p>
        <p>Kunne du v&aelig;rt en engel &aring; tatt kontakt med $fornavn? Sett at han/hun 
        ikke er et tulle-medlem, selvsagt. E-postadressen er 
        <a href=\"mailto:$e_postadresse\">$e_postadresse</a>. (Det kan godt ha v&aelig;rt en 
        feil i adressen som utl&oslash;ste feilen, bare s&aring; det er sagt).</p>
        <p>PS.: Det er meningen at du allikevell skal ha mottatt e-posten med 
        informasjon om vedkommende.</p>
        <p>Mvh. Terningkast7</p>
        </div></body>
        </html>
        ";

        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        // From headers
        $headers .= 'From: Terningkast7 Automail <automail@terningkast7.org>' . "\r\n";

        // Mail it
        return mail($to, $subject, $message, $headers);

    }
    
    
    
    
    
    
    
    
    
    foreach($_POST as $k => $v) ${$k} = mb_convert_encoding($v, "ISO-8859-1", "UTF-8");

    // RUN FAILSAFE STUFFS HERE (MOST JS THOUGH)


    if(!mail_registrering($fornavn, $etternavn, $fodselsar, $adresse,
            $postnummer, $poststed, $kommune, $telefonnummer, $e_postadresse)) {
        header("location:./?p=registrering_feilet");
        die("Oops");
    }
    
    if(!mail_til_medlem($fornavn, $etternavn, $e_postadresse)) {
        mail_oops($fornavn, $etternavn, $e_postadresse);
        header("location:./?p=registrering_feilet");
        die("Oops");
    }
    
    
    header("location:./?p=registrering_fullfort");
?>