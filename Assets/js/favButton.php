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
                    Toast.fire({
                        icon: 'success',
                        title: 'Série ajoutée à la liste des séries suivies'
                    })
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: 'Série retirée de la liste des séries suivies'
                    })
                }
            });
        });
    });
</script>