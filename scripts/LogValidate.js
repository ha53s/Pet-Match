function validateForm() {
    var username = document.getElementById('username').value;
    var pattern = /^[a-zA-Z0-9]+$/; 
    var errorMessageElement = document.getElementById('error-message');

    if (!pattern.test(username)) {
        errorMessageElement.textContent = 'Username must contain only alphanumeric characters.';
        errorMessageElement.style.color = 'red';
        return false; 
    }

    errorMessageElement.textContent = ''; 
    return true; 
}
