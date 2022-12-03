<script type="text/javascript">
    $(document).ready(function() {
        $("#followButton").click(function() {

            if ($('#followButton').hasClass('activeFavButton')) {
                $('#followButton').removeClass('activeFavButton')
            } else {
                $('#followButton').addClass('activeFavButton')
            }

            iziToast.settings({
                resetOnHover: true,
                transitionIn: 'fadeInDown',
                transitionOut: 'fadeOutUp',
            });

            $.post("Assets/js/ajax/addFollow.php", {
                idUser: "<?php echo $_SESSION['id'] ?>",
                idUserToFollow: "<?php echo $_GET['id'] ?>"
            }, function(data){
                if (data == "0") {
                    Toast.fire({
                        icon: 'success',
                        title: 'Vous avez commencé à suivre cette personne !',
                    })
                }
            });
        });
    });
</script>

"<?php
?>"