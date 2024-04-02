document.addEventListener("DOMContentLoaded", function () {
    $(function () {
        CKEDITOR.replace('pro_description')
        $('.textarea').wysihtml5()
    })
    if (document.getElementById('img_childent')) {
        document.getElementById('img_childent').addEventListener('change', function () {
            var selectedFiles = document.getElementById('img_childent').files;
            var fileNames = "";
            for (var i = 0; i < selectedFiles.length; i++) {
                if (i === selectedFiles.length - 1) {
                    fileNames += selectedFiles[i].name;
                } else {
                    fileNames += selectedFiles[i].name + ", ";
                }

            }
            document.getElementById('imageChildentLabel').innerHTML = fileNames;
        });
    }


    for (let index = 1; index < 6; index++) {
        if (document.getElementById('img_' + index)) {
            document.getElementById('img_' + index).addEventListener('change', function () {
                var selectedFiles = document.getElementById('img_' + index).files;
                var fileNames = "";
                for (var i = 0; i < selectedFiles.length; i++) {
                    if (i === selectedFiles.length - 1) {
                        fileNames += selectedFiles[i].name;
                    } else {
                        fileNames += selectedFiles[i].name + ", ";
                    }

                }
                document.getElementById('img_label_' + index).innerHTML = fileNames;
            });
        }
    }
});