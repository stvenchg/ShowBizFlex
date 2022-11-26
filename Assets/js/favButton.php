<script>
    $(document).ready(function() {
        $('.favButton').click(function() {

            iziToast.settings({
                resetOnHover: true,
                transitionIn: 'fadeInDown',
                transitionOut: 'fadeOutUp',
            });

            $.post("Assets/js/followShow.php", {
                idUser: "<?php echo $_SESSION['id'] ?>",
                idShow: "<?php echo $_GET['id'] ?>"
            }, function(data) {
                if (data == 1) {
                    iziToast.success({
                        title: 'OK !',
                        message: 'La série a été ajoutée à la liste des séries suivies.',
                        position: 'topCenter',
                        timeout: 1500,
                        close: false,
                        displayMode: 2,
                    });
                } else {
                    iziToast.success({
                        title: 'OK !',
                        message: 'La série a été retirée de la liste des séries suivies.',
                        position: 'topCenter',
                        timeout: 1500,
                        close: false,
                        displayMode: 2,
                    });
                }
            });

        });


    });
</script>