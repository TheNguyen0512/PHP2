 $(document).on('click', '#permission_add', function () {
        $.ajax({
            type: 'GEt',
            success: function (data) {
                if (data.code == 200) {
                    location.reload();
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            },
            error: function (data) {
                if (data.code == 500) {
                    location.reload();
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    })
                }
            },
        });
 });
