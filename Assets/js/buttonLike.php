<script type="text/javascript">
    $(document).ready(function() {
        $("#likeShows").click(function() {

            if ($('#likeShows').hasClass('activeLikeButton')) {
                $('#likeShows').removeClass('activeLikeButton')
            } else {
                $('#likeShows').addClass('activeLikeButton')
            }

            $.post("Assets/js/ajax/addLike.php", {
                idUser: "<?php echo $_SESSION['id'] ?>",
                idShow: "<?php echo htmlspecialchars($_GET['id']) ?>"
            }, function(data){
                if (data == 0) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Tu aimes cette série',
                    })
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: 'Tu n\'aimes plus cette série',
                    })
                }
            });
        });

        tippy('#likeShows', {
            theme: 'light',
            content: 'Ajouter un j\'aime',
            animation: 'fade',
        });
    });
</script>