$(document).ready(function() {

    function confirmPublish(route) {

        swal({
                title: "Publier ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#1fad2f",
                confirmButtonText: "Mettre en ligne",
                cancelButtonText: "Annuler",
                closeOnConfirm: false
            }, function (isConfirm) {

                if (!isConfirm) return;

                $.ajax({
                    url: route,
                    type: 'POST',
                    success: function (msg) {
                        swal("OK !", msg, "success");
                    },
                    error: function () {
                        swal("Erreur !", "Une erreur est survenue", "error");
                    }
                })
            }
        )

    }
})

