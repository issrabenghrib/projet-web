// Configuration de la base de données (à adapter selon votre configuration)
const API_URL = 'http://your-api-url/api';

document.addEventListener('DOMContentLoaded', function() {
    loadWeatherData();
    
    // Gestionnaire du formulaire
    document.getElementById('weatherForm').addEventListener('submit', handleFormSubmit);
});

// Charger les données
async function loadWeatherData() {
    try {
        const response = await fetch(`${API_URL}/weather`);
        const data = await response.json();
        updateWeatherTable(data);
    } catch (error) {
        showNotification('Erreur lors du chargement des données', 'error');
    }
}

// Mettre à jour le tableau
function updateWeatherTable(data) {
    const tbody = document.getElementById('weatherTableBody');
    tbody.innerHTML = '';

    data.forEach(item => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${formatDate(item.date)}</td>
            <td>${item.temperature}°C</td>
            <td>${item.humidity}%</td>
            <td>${item.rainProbability}%</td>
            <td class="action-buttons">
                <button onclick="editWeather(${item.id})" class="btn-edit">
                    <i class="fas fa-edit"></i>
                </button>
                <button onclick="confirmDelete(${item.id})" class="btn-delete">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;
        tbody.appendChild(row);
    });
}

// Fonction pour afficher un message d'erreur sous un champ
function showFieldError(fieldId, message) {
    const field = document.getElementById(fieldId);
    let errorDiv = field.nextElementSibling;
    
    // Si la div d'erreur n'existe pas, on la crée
    if (!errorDiv || !errorDiv.classList.contains('field-error')) {
        errorDiv = document.createElement('div');
        errorDiv.className = 'field-error';
        field.parentNode.insertBefore(errorDiv, field.nextSibling);
    }
    
    errorDiv.textContent = message;
    errorDiv.style.color = '#dc3545';
    errorDiv.style.fontSize = '0.875em';
    errorDiv.style.marginTop = '4px';
    field.style.borderColor = '#dc3545';
}

// Fonction pour effacer les messages d'erreur
function clearFieldError(fieldId) {
    const field = document.getElementById(fieldId);
    const errorDiv = field.nextElementSibling;
    
    if (errorDiv && errorDiv.classList.contains('field-error')) {
        errorDiv.remove();
    }
    field.style.borderColor = '';
}

// Fonction pour effacer toutes les erreurs
function clearAllErrors() {
    const fields = ['weatherDate', 'temperature', 'humidity', 'rainProbability'];
    fields.forEach(fieldId => clearFieldError(fieldId));
}

// Fonction de validation des entrées modifiée
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
    if (!temperature || isNaN(temperature)) {
        showFieldError('temperature', 'Veuillez entrer une température valide');
        isValid = false;
    } else if (temperature < -50 || temperature > 50) {
        showFieldError('temperature', 'La température doit être entre -50°C et 50°C');
        isValid = false;
    }

    // Vérification de l'humidité
    if (!humidity || isNaN(humidity)) {
        showFieldError('humidity', 'Veuillez entrer un taux d\'humidité valide');
        isValid = false;
    } else if (humidity < 0 || humidity > 100) {
        showFieldError('humidity', 'L\'humidité doit être entre 0% et 100%');
        isValid = false;
    }

    // Vérification de la probabilité de pluie
    if (!rainProbability || isNaN(rainProbability)) {
        showFieldError('rainProbability', 'Veuillez entrer une probabilité de pluie valide');
        isValid = false;
    } else if (rainProbability < 0 || rainProbability > 100) {
        showFieldError('rainProbability', 'La probabilité doit être entre 0% et 100%');
        isValid = false;
    }

    return isValid;
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

// Ajouter des écouteurs d'événements pour effacer les erreurs lors de la saisie
document.addEventListener('DOMContentLoaded', function() {
    const fields = ['weatherDate', 'temperature', 'humidity', 'rainProbability'];
    
    fields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        field.addEventListener('input', () => clearFieldError(fieldId));
        field.addEventListener('change', () => clearFieldError(fieldId));
    });
});

// Créer une nouvelle prévision
async function createWeather(data) {
    const response = await fetch(`${API_URL}/weather`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    });
    return response.json();
}

// Mettre à jour une prévision
async function updateWeather(id, data) {
    const response = await fetch(`${API_URL}/weather/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    });
    return response.json();
}

// Supprimer une prévision
async function deleteWeather(id) {
    try {
        await fetch(`${API_URL}/weather/${id}`, {
            method: 'DELETE'
        });
        loadWeatherData();
        showNotification('Prévision supprimée avec succès', 'success');
    } catch (error) {
        showNotification('Erreur lors de la suppression', 'error');
    }
}

// Éditer une prévision
async function editWeather(id) {
    try {
        const response = await fetch(`${API_URL}/weather/${id}`);
        const data = await response.json();
        
        // Vérifier si la date est modifiable (pas plus de 15 jours)
        const weatherDate = new Date(data.date);
        const maxDate = new Date();
        maxDate.setDate(maxDate.getDate() + 15);
        
        if (weatherDate > maxDate) {
            showNotification('Cette prévision ne peut pas être modifiée car elle dépasse 15 jours', 'error');
            return;
        }
        
        document.getElementById('weatherId').value = data.id;
        document.getElementById('weatherDate').value = data.date;
        document.getElementById('temperature').value = data.temperature;
        document.getElementById('humidity').value = data.humidity;
        document.getElementById('rainProbability').value = data.rainProbability;
        
        document.querySelector('.btn-submit').innerHTML = '<i class="fas fa-save"></i> Mettre à jour';
        scrollTo('.weather-form-card');
    } catch (error) {
        showNotification('Erreur lors du chargement des données', 'error');
    }
}

// Confirmation de suppression
function confirmDelete(id) {
    const modal = document.getElementById('deleteModal');
    modal.style.display = 'block';
    
    document.getElementById('confirmDelete').onclick = () => {
        deleteWeather(id);
        modal.style.display = 'none';
    };
    
    document.getElementById('cancelDelete').onclick = () => {
        modal.style.display = 'none';
    };
}

// Utilitaires
function resetForm() {
    document.getElementById('weatherForm').reset();
    document.getElementById('weatherId').value = '';
    document.querySelector('.btn-submit').innerHTML = '<i class="fas fa-save"></i> Enregistrer';
}

function formatDate(dateString) {
    return new Date(dateString).toLocaleDateString('fr-FR', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerHTML = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

function scrollTo(selector) {
    document.querySelector(selector).scrollIntoView({ behavior: 'smooth' });
}