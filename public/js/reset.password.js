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