import "./bootstrap";
import "~resources/scss/app.scss";
import "~icons/bootstrap-icons.scss";
import * as bootstrap from "bootstrap";
import.meta.glob(["../img/**"]);


// Codice JS vanilla
//Bottone disabilita bottone form
document.addEventListener('DOMContentLoaded', function () {
    const btnSend = document.getElementById('btnSend');
    const requiredFields = document.querySelectorAll('input[required]');

    //funzione per la verifica di tutti i campi
    function checkRequiredFields() {
        //setto in maniera che i campi siano già compilati (tanto nel controllo ci entro ugualmente)
        let allFilled = true;
        //faccio un check su tutti i campi e se qualcuno non è compilato setto la variabile su false
        requiredFields.forEach(field => {
            if (!field.value) {
                allFilled = false;
            }
        });
        //abilitazione pulsante
        btnSend.disabled = !allFilled;
    }

    //ogni volta che l'utente scrive ('input') viene eseguita la funzione
    requiredFields.forEach(field => {
        field.addEventListener('input', checkRequiredFields);
    });

    checkRequiredFields();
});