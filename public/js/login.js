
document.getElementById('form-login').addEventListener('submit', function () {
    showLoadingIndicator();
});

document.addEventListener('readystatechange', function (event) {
    if (document.readyState === 'complete') {
        hideLoadingIndicator();
    }
});

function showLoadingIndicator() {
    document.getElementById('sgin-in').style.display = 'none';
    document.getElementById('snippet').style.display = 'flex';
}

function hideLoadingIndicator() {
    document.getElementById('sgin-in').style.display = 'block';
    document.getElementById('snippet').style.display = 'none';
}

var passwordInput = document.getElementById('password');
var showPasswordCheckbox = document.getElementById('showPassword');

// Add event listener to the show password checkbox
showPasswordCheckbox.addEventListener('change', function () {
    // Change the type of the password input based on whether the checkbox is checked
    if (this.checked) {
        passwordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
    }
});