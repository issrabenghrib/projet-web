document.addEventListener("DOMContentLoaded", function() {

    var form = document.getElementById("addOuvrierForm");
    var nomelement = document.getElementById("nom");
    var prenomelement = document.getElementById("prenom");
    var ageelement = document.getElementById("age");

    // Function to validate 'nom' field (letters and spaces, at least 3 characters)
    function validateNom() {
        var nomErrorElement = document.getElementById("nom_error");
        var nomErrorValue = nomelement.value.trim();
        var pattern = /^[A-Za-z\s]+$/;  // Only letters and spaces allowed

        if (!pattern.test(nomErrorValue) || nomErrorValue.length < 3) {
            nomErrorElement.innerHTML = "Le nom doit contenir uniquement des lettres et des espaces, et au moins 3 caractères.";
            nomErrorElement.style.color = "red";
            return false; // Validation failed
        } else {
            nomErrorElement.innerHTML = "Correct";
            nomErrorElement.style.color = "green";
            return true; // Validation passed
        }
    }

    // Function to validate 'prenom' field (letters and spaces, at least 3 characters)
    function validatePrenom() {
        var prenomErrorElement = document.getElementById("prenom_error");
        var prenomErrorValue = prenomelement.value.trim();
        var pattern = /^[A-Za-z\s]+$/;  // Only letters and spaces allowed

        if (!pattern.test(prenomErrorValue) || prenomErrorValue.length < 3) {
            prenomErrorElement.innerHTML = "Le prénom doit contenir uniquement des lettres et des espaces, et au moins 3 caractères.";
            prenomErrorElement.style.color = "red";
            return false; // Validation failed
        } else {
            prenomErrorElement.innerHTML = "Correct";
            prenomErrorElement.style.color = "green";
            return true; // Validation passed
        }
    }

    // Function to validate 'age' field (a valid number between 0 and 120)
    function validateAge() {
        var ageErrorElement = document.getElementById("age_error");
        var ageErrorValue = ageelement.value.trim();
        var pattern = /^\d+$/;  // Only numbers allowed

        if (!pattern.test(ageErrorValue) || ageErrorValue < 18 || ageErrorValue > 70) {
            ageErrorElement.innerHTML = "L'âge doit être un nombre entre 18 et 70.";
            ageErrorElement.style.color = "red";
            return false; // Validation failed
        } else {
            ageErrorElement.innerHTML = "Correct";
            ageErrorElement.style.color = "green";
            return true; // Validation passed
        }
    }

    // Function to validate the form before submission
    function validateForm(event) {
        var isNomValid = validateNom();
        var isPrenomValid = validatePrenom();
        var isAgeValid = validateAge();

        // If any field is invalid, prevent form submission and alert the user
        if (isNomValid && isPrenomValid && isAgeValid) {
            return true; // All fields are valid, form will submit
        } else {
            event.preventDefault(); // Prevent form submission
            alert("Veuillez corriger les erreurs avant de soumettre.");
            return false; // Validation failed
        }
    }

    // Attach the validateForm function to the form submit event
    form.addEventListener("submit", validateForm);

    // Validate each field as the user types
    nomelement.addEventListener("keyup", validateNom);
    prenomelement.addEventListener("keyup", validatePrenom);
    ageelement.addEventListener("keyup", validateAge);

});
