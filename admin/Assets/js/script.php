<script>
    $(document).ready(function() {
        $('#editUserButton').click(function() {
            $.post("Assets/js/ajax/updateUser.php", {
                idUserAdmin: "<?php echo $_SESSION['admin_id'] ?>",
                idUser: $("#id").val(),
                username: $("#username").val(),
                email: $("#email").val(),
                about: $("#about").val(),
                color: $("#color").val(),
                idRole: $("#idRole").val(),
                show_setup: $("#show_setup").val(),
                private: $("#private").val(),
                adult: $("#adult").val(),
                pin: $("#pin").val(),
            }, function(data) {
                if (data == 1) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Les modifications apportées à cet utilisateur ont été enregistrées'
                    })
                } else if (data == 0) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Une erreur est survenue',
                    })
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Non autorisé.',
                    })
                }
            });
        });
    });
</script>