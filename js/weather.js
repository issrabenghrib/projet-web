document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('weatherDate');
    const weatherForm = document.querySelector('.weather-form');

    // Définir la date minimale (aujourd'hui)
    const today = new Date();
    const maxDate = new Date();
    maxDate.setDate(today.getDate() + 15);

    dateInput.min = today.toISOString().split('T')[0];
    dateInput.max = maxDate.toISOString().split('T')[0];

    // Gestionnaire de changement de date
    dateInput.addEventListener('change', function(e) {
        const selectedDate = new Date(e.target.value);
        updateWeatherDate(selectedDate);
    });

    // Gestionnaire de soumission du formulaire
    weatherForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const selectedOptions = {
            date: dateInput.value,
            temperature: document.getElementById('temperature').checked,
            humidity: document.getElementById('humidity').checked,
            rain: document.getElementById('rain').checked
        };

        fetchWeatherData(selectedOptions);
    });
});

function updateWeatherDate(date) {
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = date.toLocaleDateString('fr-FR', options);
    document.querySelector('.weather-date').innerHTML = `
        <i class="far fa-calendar-alt"></i>
        Prévisions pour le ${formattedDate}
    `;
}

function fetchWeatherData(options) {
    // Simuler une requête API
    const results = document.getElementById('weather-results');
    results.innerHTML = `
        <div class="loading">
            <i class="fas fa-spinner fa-spin"></i>
            Chargement des prévisions...
        </div>
    `;

    // Remplacer par votre appel API réel
    setTimeout(() => {
        displayWeatherResults(options);
    }, 1000);
}

function displayWeatherResults(options) {
    const results = document.getElementById('weather-results');
    let html = '<div class="weather-data">';

    if (options.temperature) {
        html += `
            <div class="weather-item">
                <i class="fas fa-thermometer-half"></i>
                <span>22°C</span>
            </div>
        `;
    }

    if (options.humidity) {
        html += `
            <div class="weather-item">
                <i class="fas fa-tint"></i>
                <span>65%</span>
            </div>
        `;
    }

    if (options.rain) {
        html += `
            <div class="weather-item">
                <i class="fas fa-cloud-rain"></i>
                <span>30%</span>
            </div>
        `;
    }

    html += '</div>';
    results.innerHTML = html;
}
function showAlert(message, type) {
    const existingAlert = document.querySelector('.custom-alert');
    if (existingAlert) {
        existingAlert.remove();
    }

    const alert = document.createElement('div');
    alert.className = `custom-alert ${type} show`;
    alert.innerHTML = `
        <div class="alert-title">${type.charAt(0).toUpperCase() + type.slice(1)}</div>
        <div>${message}</div>
        <button class="alert-close"><i class="fas fa-times"></i></button>
    `;

    document.body.appendChild(alert);

    const closeButton = alert.querySelector('.alert-close');
    closeButton.addEventListener('click', () => {
        alert.remove();
    });
}

// Gérer la soumission du formulaire
async function handleFormSubmit(e) {
    e.preventDefault();
    
    // Récupérer les valeurs
    const date = document.getElementById('weatherDate').value;
    const temperature = document.getElementById('temperature').value;
    const humidity = document.getElementById('humidity').value;
    const rainProbability = document.getElementById('rainProbability').value;

    // Validation des données
    if (!validateInputs(date, temperature, humidity, rainProbability)) {
        return;
    }

    // Afficher les alertes pour chaque valeur renseignée
    if (temperature) {
        alert(`La température = ${temperature}°C`);
    }
    if (humidity) {
        alert(`L'humidité = ${humidity}%`);
    }
    if (rainProbability) {
        alert(`La probabilité de pluie = ${rainProbability}%`);
    }

    const formData = {
        date: date,
        temperature: parseFloat(temperature),
        humidity: parseInt(humidity),
        rainProbability: parseInt(rainProbability)
    };

    const isEditing = document.getElementById('weatherId').value;
    
    try {
        if (isEditing) {
            await updateWeather(isEditing, formData);
        } else {
            await createWeather(formData);
        }
        
        clearAllErrors(); // Effacer les erreurs en cas de succès
        resetForm();
        loadWeatherData();
        showNotification('Données enregistrées avec succès', 'success');
    } catch (error) {
        showNotification('Erreur lors de l\'enregistrement', 'error');
    }
}

// Fonction de validation des entrées
function validateInputs(date, temperature, humidity, rainProbability) {
    let isValid = true;
    clearAllErrors();

    // Vérification de la date
    if (!date) {
        showFieldError('weatherDate', 'Veuillez sélectionner une date');
        isValid = false;
    } else {
        const selectedDate = new Date(date);
        const today = new Date();
        const maxDate = new Date();
        maxDate.setDate(today.getDate() + 15);

        if (selectedDate < today) {
            showFieldError('weatherDate', 'La date ne peut pas être dans le passé');
            isValid = false;
        } else if (selectedDate > maxDate) {
            showFieldError('weatherDate', 'La date ne peut pas dépasser 15 jours');
            isValid = false;
        }
    }

    // Vérification de la température
    if (temperature && (isNaN(temperature) || temperature < -50 || temperature > 50)) {
        showFieldError('temperature', 'La température doit être entre -50°C et 50°C');
        isValid = false;
    }

    // Vérification de l'humidité
    if (humidity && (isNaN(humidity) || humidity < 0 || humidity > 100)) {
        showFieldError('humidity', 'L\'humidité doit être entre 0% et 100%');
        isValid = false;
    }

    // Vérification de la probabilité de pluie
    if (rainProbability && (isNaN(rainProbability) || rainProbability < 0 || rainProbability > 100)) {
        showFieldError('rainProbability', 'La probabilité doit être entre 0% et 100%');
        isValid = false;
    }

    return isValid;
}