<script>
    $(document).ready(function() {
        $('.favButton').click(function() {

            if ($('#favButton').hasClass('activeFavButton')) {
                $('#favButton').removeClass('activeFavButton')
            } else {
                $('#favButton').addClass('activeFavButton')
            }

            iziToast.settings({
                resetOnHover: true,
                transitionIn: 'fadeInDown',
                transitionOut: 'fadeOutUp',
            });

            $.post("Assets/js/ajax/followShow.php", {
                idUser: "<?php echo $_SESSION['id'] ?>",
                idShow: "<?php echo $_GET['id'] ?>"
            }, function(data) {
                if (data == 1) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Ajoutée à la liste des séries suivies'
                    })
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: 'Retirée de la liste des séries suivies'
                    })
                }
            });
        });
    });
</script>