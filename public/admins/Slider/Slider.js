


/*---------- add ----------*/

/*----Summernote -----*/
$(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
        mode: "htmlmixed",
        theme: "monokai"
    });
})

/*-- bs-custom-file-input --*/
$(function () {
    bsCustomFileInput.init();
});

/*---------- edit ---------*/
