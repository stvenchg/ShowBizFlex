<script>
    $(document).ready(function() {
        $('.saveButton').click(function() {

            iziToast.settings({
                resetOnHover: true,
                transitionIn: 'fadeInDown',
                transitionOut: 'fadeOutUp',
            });

            $.post("Assets/js/saveShow.php", {
                idUser: "<?php echo $_SESSION['id'] ?>",
                idShow: "<?php echo $_GET['id'] ?>"
            }, function(data) {
                if (data == 1) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Ajoutée à la liste des séries à regarder plus tard'
                    })
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: 'Retirée de la liste des séries à regarder plus tard'
                    })
                }
            });

        });


    });
</script>