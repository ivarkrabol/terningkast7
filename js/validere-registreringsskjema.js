// Test fødselsår
function testFodselsar(form) {
    $("#fodselsar legend",form).css("color", "#41a681");
    var input = $("#fodselsar input",form);
    var currentYear = new Date().getFullYear();

    input.val(input.val().replace(/\s/g,""));

    // [19]00 - [20]99
    var patt1 = /^(19|20)?\d\d$/;
    if(!patt1.test(input.val())) {
        $("#fodselsar legend",form).css("color", "#b92439");
        $.registreringsProblemer += "Vennligst fyll inn korrekt fødselsår. \n";
        return false;
    }

    // 1900 - 2099
    var patt2 = /^\d\d$/;
    if(patt2.test(input.val())) {
        if(parseInt(input.val(), 10) > currentYear-2000) {
            input.val("19" + input.val());
        } else {
            input.val("20" + input.val());
        }
    }

    // 1900 - ~2000
    if(parseInt(input.val(), 10) > currentYear-13) {
        $("#fodselsar legend",form).css("color", "#b92439");
        $.registreringsProblemer += "Du kan desverre ikke være medlem før året du fyller 13 år. \n";
        return false;
    }
    return true;
}

// Test telefonnummer
function testPostnummer(form) {
    $("#postnummer legend",form).css("color", "#41a681");
    var input = $("#postnummer input",form);

    input.val(input.val().replace(/\s/g,""));

    // 0 - 9999
    var patt1 = /^\d{1,4}$/;
    if(!patt1.test(input.val())) {
        $("#postnummer legend",form).css("color", "#b92439");
        $.registreringsProblemer += "Vennligst fyll inn korrekt postnummer. \n";
        input.val("");
        return false;
    }

    // Sette kommune hvis den er der
    var kommuner = {
        2313: "Stange",
        2314: "Hamar",
        2315: "Hamar",
        2316: "Hamar",
        2317: "Hamar",
        2318: "Hamar",
        2319: "Hamar",
        2320: "Ringsaker",
        2321: "Hamar",
        2322: "Hamar",
        2324: "Hamar",
        2335: "Stange",
        2353: "Ringsaker",
        2373: "Ringsaker",
        2380: "Ringsaker",
        2385: "Ringsaker",
        2386: "Ringsaker",
        2411: "Elverum",
        2817: "Gjøvik",
        2821: "Gjøvik"
    };

    $("#kommune").val("");
    if (kommuner[input.val()] != null) {
        $("#kommune").val(kommuner[input.val()]);
    }
    
    input.val(("0000"+input.val()).substr(-4));
    return true;
}

// Test telefonnummer
function testTelefonnummer(form) {
    $("#telefonnummer legend",form).css("color", "#41a681");
    var input = $("#telefonnummer input",form);

    input.val(input.val().replace(/\s/g,""));
    input.val(input.val().replace(/^(\+|00)47/,""));

    // 00000000 - 99999999
    var patt1 = /^(\d{8})?$/;
    if(!patt1.test(input.val())) {
        $("#telefonnummer legend",form).css("color", "#b92439");
        $.registreringsProblemer += "Vennligst fyll inn korrekt telefonnummer eller la feltet stå tomt. \n";
        if(input.val().length <= 3) input.val("");
        return false;
    }

    return true;
}

// Test e-postadresse
function testE_postadresse(form) {
    $("#e-postadresse legend",form).css("color", "#41a681");
    var input = $("#e-postadresse input",form);

    input.val(input.val().replace(/\s/g,""));

    // gyldig -postadresse
    var patt1 = /^([A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4})?$/i;
    if(!patt1.test(input.val())) {
        $("#e-postadresse legend",form).css("color", "#b92439");
        $.registreringsProblemer += "Vennligst fyll inn korrekt e-postadresse eller la feltet stå tomt. \n";
        return false;
    }
    return true;
}

// Test vedtekter
function testVedtekter(form) {
    $("#vedtekter legend",form).css("color", "#41a681");
    var input = $("#vedtekter input",form);

    // avkrysset
    if(!input.prop("checked")) {
        $("#vedtekter legend",form).css("color", "#b92439");
        $.registreringsProblemer += "Vennligst les gjennom og godta vedtektene. \n";
        return false;
    }
    return true;
}

// Test resten
function testTextinputs(form) {
    
    var textinputs = ["fornavn", "etternavn", "adresse", "poststed"];
    var no_problem = true;
    
    for(var i in textinputs) {
        $("#" + textinputs[i] + " legend",form).css("color", "#41a681");
        var input = $("#" + textinputs[i] + " input",form);

        // A-Å 0-9 - .
        var patt1 = /^[A-ZÆØÅ0-9\.,\- ]+$/i;
        if(!patt1.test(input.val())) {
            $("#" + textinputs[i] + " legend",form).css("color", "#b92439");
            $.registreringsProblemer += "Vennligst fyll inn korrekt " + textinputs[i] + ". \n";
            no_problem = false;
        }
    }
    return no_problem;
}


$.validerRegistrering = function(form) {
    $.registreringsProblemer = "";
    
    var no_problem = true;
    no_problem = testTextinputs(form) && no_problem;
    no_problem = testFodselsar(form) && no_problem;
    no_problem = testPostnummer(form) && no_problem;
    no_problem = testTelefonnummer(form) && no_problem;
    no_problem = testE_postadresse(form) && no_problem;
    no_problem = testVedtekter(form) && no_problem;
    return no_problem;
};