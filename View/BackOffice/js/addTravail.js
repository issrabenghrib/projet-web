document.addEventListener("DOMContentLoaded", function() {

    var typetravailElement = document.getElementById("typetravail");
    var dureeElement = document.getElementById("duree");
    var formElement = document.getElementById("addTravailForm");

    // Validate TypeTravail
    typetravailElement.addEventListener("keyup", function() {
        var typetravailErrorElement = document.getElementById("typetravail_error");
        var typetravailValue = typetravailElement.value;

        if (typetravailValue.length < 3) {
            typetravailErrorElement.innerHTML = "Le TypeTravail doit contenir au moins 3 caractères";
            typetravailErrorElement.style.color = "red";
        } else {
            typetravailErrorElement.innerHTML = "Correct";
            typetravailErrorElement.style.color = "green";
        }
    });

    // Validate Duree
    dureeElement.addEventListener("keyup", function() {
        var dureeErrorElement = document.getElementById("duree_error");
        var dureeValue = dureeElement.value;
        var pattern = /^[0-9]+(\.[0-9]+)?$/; // Pattern for positive number, including decimals

        if (!pattern.test(dureeValue) || dureeValue.length === 0) {
            dureeErrorElement.innerHTML = "La Duree doit être un nombre positif";
            dureeErrorElement.style.color = "red";
        } else {
            dureeErrorElement.innerHTML = "Correct";
            dureeErrorElement.style.color = "green";
        }
    });

    // Handle form submission
    formElement.addEventListener("submit", function(event) {
        var valid = true;

        // Validate TypeTravail before submit
        var typetravailValue = typetravailElement.value;
        var typetravailErrorElement = document.getElementById("typetravail_error");
        if (typetravailValue.length < 3) {
            typetravailErrorElement.innerHTML = "Le TypeTravail doit contenir au moins 3 caractères";
            typetravailErrorElement.style.color = "red";
            valid = false;
        }

        // Validate Duree before submit
        var dureeValue = dureeElement.value;
        var dureeErrorElement = document.getElementById("duree_error");
        var pattern = /^[0-9]+(\.[0-9]+)?$/; // Pattern for positive number, including decimals
        if (!pattern.test(dureeValue) || dureeValue.length === 0) {
            dureeErrorElement.innerHTML = "La Duree doit être un nombre positif";
            dureeErrorElement.style.color = "red";
            valid = false;
        }

        // If the form is not valid, prevent submission and show alert
        if (!valid) {
            event.preventDefault(); // Prevent form submission
            alert("Veuillez corriger les erreurs avant de soumettre.");
        }
    });
});
