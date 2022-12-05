<script type="text/javascript">
    $(document).ready(function() {
        $(".likeShows").click(function() {

            if ($('.likeShows').hasClass('activeFavButton')) {
                $('.likeShows').removeClass('activeFavButton')
            } else {
                $('.likeShows').addClass('activeFavButton')
            }

            iziToast.settings({
                resetOnHover: true,
                transitionIn: 'fadeInDown',
                transitionOut: 'fadeOutUp',
            });

            $.post("Assets/js/ajax/addLike.php", {
                idUser: "<?php echo $_SESSION['id'] ?>",
                idShow: "<?php echo $_GET['id'] ?>"
            }, function(data){
                if (data == "0") {
                    Toast.fire({
                        icon: 'success',
                        title: 'Vous avez liké la série !',
                    })
                }
               if(data == "1"){
                    Toast.fire({
                        icon: 'success',
                        title: 'Vous avez retiré votre like !',
                    })
                }
            });
        });
    });
</script>

