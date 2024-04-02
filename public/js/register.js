
document.getElementById('form-register').addEventListener('submit', function () {
    showLoadingIndicator();
});

document.addEventListener('readystatechange', function (event) {
    if (document.readyState === 'complete') {
        hideLoadingIndicator();
    }
});

function showLoadingIndicator() {
    document.getElementById('sgin-up').style.display = 'none';
    document.getElementById('snippet').style.display = 'flex';
}

function hideLoadingIndicator() {
    document.getElementById('sgin-up').style.display = 'block';
    document.getElementById('snippet').style.display = 'none';
}

var passwordInput = document.getElementById('password');
var confirmPasswordInput = document.getElementById('password_confirmation');
var showPasswordCheckbox = document.getElementById('showPassword');
if (showPasswordCheckbox.checked) {
    passwordInput.type = 'text';
    confirmPasswordInput.type = 'text';
} else {
    passwordInput.type = 'password';
    confirmPasswordInput.type = 'password';
}
showPasswordCheckbox.addEventListener('change', function () {
    if (this.checked) {
        passwordInput.type = 'text';
        confirmPasswordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
        confirmPasswordInput.type = 'password';
    }
});