<script type="text/javascript">
    $(document).ready(function() {
        $(".addComment").click(function() {
            $('#loader').show();
            commentaire = $(".zoneComments").val();

            if ($('.addComment').hasClass('activeFavButton')) {
                $('.addComment').removeClass('activeFavButton')
            } else {
                $('.addComment').addClass('activeFavButton')
            }

            iziToast.settings({
                resetOnHover: true,
                transitionIn: 'fadeInDown',
                transitionOut: 'fadeOutUp',
            });

            $.post("Assets/js/addComments.php", {
                com:commentaire, 
                idUser: "<?php echo $_SESSION['id'] ?>",
                idShow: "<?php echo $_GET['id'] ?>"
            }, function(data){
                $('#loader').hide();
                if (data == "NonVide") {
                    Toast.fire({
                        icon: 'success',
                        title: 'Vous avez posté un commentaire !',
                        timer: 1000
                    }).then(function() {
                        window.location = './?module=shows&action=overview&id=' + "<?php echo $_GET['id'] ?>";
                    });
                } 
            });
            return false;
        });
    });
</script>

"<?php
?>"
