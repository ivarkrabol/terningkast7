<script type="text/javascript">
    $("#registreringsskjema").submit(function(){
        if(!$.validerRegistrering(this)){
            $("#problem").css("display", "none").text($.registreringsProblemer).fadeIn();
            $.updateMainScale();
            return false;
        } else return true;
    });
</script>

<h2>Registrer deg</h2>
<p>Om du ønsker å bli medlem i Terningkast7, kan du benytte dette 
    registreringsskjemaet vi har laget. Medlemskapet koster kr 50,- per 
    medlemsår, og går med til å dekke enkel bevertning til spillkvelder, samt 
    innkjøp av nye spill! Betalingen kan enten gjøres per instrukser som du 
    mottar på e-post når du registerer deg, eller du kan ta kontakt med en av 
    styremedlemmene.</p>
<pre id="problem"></pre>
<form id="registreringsskjema" action="utfor_registrering.php" method="POST" onsubmit="false">
    <fieldset id="fornavn" class="half">
        <legend>Fornavn</legend>
        <input name="fornavn" type="text">
    </fieldset>
    <fieldset id="etternavn" class="half">
        <legend>Etternavn</legend>
        <input name="etternavn" type="text">
    </fieldset>
    <fieldset id="fodselsar" class="half">
        <legend>Fødselsår</legend>
        <input name="fodselsar" type="number" min="1900" max="<?php echo date("Y"); ?>">
    </fieldset>
    <fieldset id="adresse" class="half">
        <legend>Adresse</legend>
        <input name="adresse" type="text">
    </fieldset>
    <fieldset id="postnummer" class="half">
        <legend>Postnummer</legend>
        <input name="postnummer" type="number" min="1" max="9999">
    </fieldset>
        <input id="kommune" name="kommune" type="hidden" value="">
    <fieldset id="poststed" class="half">
        <legend>Poststed</legend>
        <input name="poststed" type="text">
    </fieldset>
    <fieldset id="telefonnummer" class="half">
        <legend>Telefonnummer</legend>
        <input name="telefonnummer" type="number" min="10000000" max="004799999999">
    </fieldset>
    <fieldset id="e-postadresse" class="half">
        <legend>E-postadresse</legend>
        <input name="e_postadresse" type="email">
    </fieldset>
    <fieldset id="vedtekter">
        <legend>Vedtekter</legend>
        <input type="checkbox">
        <label for="vedtekter">Jeg har lest og godtar <a href="files/Vedtekter.pdf" target="_new">vedtektene</a>.</label>
    </fieldset>
    <fieldset id="registrer">
        <input name="registrer" type="submit" value="Send">
    </fieldset>
</form>
<div class="clearer"></div>