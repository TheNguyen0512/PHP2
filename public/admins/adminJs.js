

document.addEventListener("DOMContentLoaded", function () {

    var image = document.getElementById("image");

    if (image) {
        document.getElementById('image').addEventListener('change', function (event) {
            var fileName = event.target.files[0].name;
            document.getElementById('imageLabel').textContent = fileName;
        });
    }

    var formSearch = document.getElementById("form-search");

    if (formSearch) {
        var inputField = document.getElementById("search");
        inputField.addEventListener("keydown", function (event) {
            // Check if the pressed key is "Enter" (key code 13)
            if (event.keyCode === 13) {
                // Trigger form submission
                formSearch.submit();
            }
        });
    }

    var formEdit = document.getElementById('edit');
    if (formEdit) {
        formEdit.addEventListener('submit', function (event) {
            event.preventDefault();
            Swal.fire({
                title: "Are you sure to update it?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#13d146",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, update it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    formEdit.submit();
                }
            });
        });
    }

    var overlay = document.getElementById('overlay');
    if (overlay) {
        overlay.addEventListener('click', function () {
            overlay.innerHTML = '';
            overlay.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    }
});
function confirmDelete(event, id) {
    event.preventDefault();
    Swal.fire({
        title: "Are you sure to delete it?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#13d146",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = id.getAttribute("href");
        }
    });
}

function zoomImg(element) {
    var image = document.getElementById(element.dataset.id);
    var overlay = document.getElementById('overlay');
    var zoomedImage = image.cloneNode(true);
    zoomedImage.classList.add('zoomed-image');
    overlay.appendChild(zoomedImage);
    overlay.style.display = 'block';
    document.body.style.overflow = 'hidden';
}