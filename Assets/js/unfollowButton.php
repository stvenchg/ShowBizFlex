<script type="text/javascript">
    $(document).ready(function() {
        $("#unfollowButton").click(function() {

            if ($('#unfollowButton').hasClass('activeFavButton')) {
                $('#unfollowButton').removeClass('activeFavButton')
            } else {
                $('#unfollowButton').addClass('activeFavButton')
            }

            $.post("Assets/js/ajax/deleteFollow.php", {
                idUser: "<?php echo $_SESSION['id'] ?>",
                idUserToFollow: "<?php echo $_GET['id'] ?>"
            }, function(data){
                if (data == "1") {
                    Toast.fire({
                        icon: 'success',
                        title: 'Tu ne suis plus cet utilisateur',
                    }).then(function() {
                        window.location = './?module=profile&action=view&id=' + "<?php echo $_GET['id'] ?>";
                    });
                }
            });
        });
    });
</script>