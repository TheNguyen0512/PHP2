
document.getElementById('form-otp').addEventListener('submit', function () {
    showLoadingIndicator();
});

document.addEventListener('readystatechange', function (event) {
    if (document.readyState === 'complete') {
        hideLoadingIndicator();
    }
});

function showLoadingIndicator() {
    document.getElementById('otp').style.display = 'none';
    document.getElementById('snippet').style.display = 'flex';
}

function hideLoadingIndicator() {
    document.getElementById('otp').style.display = 'block';
    document.getElementById('snippet').style.display = 'none';
}