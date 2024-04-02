

document.addEventListener("DOMContentLoaded", function () {
    // Code in this block will run when the DOM is fully loaded

    var image = document.getElementById("image");

    if (image) {
        document.getElementById('image').addEventListener('change', function (event) {
            var fileName = event.target.files[0].name;
            document.getElementById('imageLabel').textContent = fileName;
        });
    }

    var form = document.getElementById("form-search");

    if (form) {
        var inputField = document.getElementById("search");
        inputField.addEventListener("keydown", function (event) {
            // Check if the pressed key is "Enter" (key code 13)
            if (event.keyCode === 13) {
                // Trigger form submission
                form.submit();
            }
        });
    }
});