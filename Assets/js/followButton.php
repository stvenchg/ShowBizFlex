<script type="text/javascript">
    $(document).ready(function() {
        $("#followButton").click(function() {

            if ($('#followButton').hasClass('activeFavButton')) {
                $('#followButton').removeClass('activeFavButton')
            } else {
                $('#followButton').addClass('activeFavButton')
            }

            $.post("Assets/js/ajax/addFollow.php", {
                idUser: "<?php echo $_SESSION['id'] ?>",
                idUserToFollow: "<?php echo $_GET['id'] ?>"
            }, function(data){
                if (data == "0") {
                    Toast.fire({
                        icon: 'success',
                        title: 'Tu as suivi cet utilisateur',
                    }).then(function() {
                        window.location = './?module=profile&action=view&id=' + "<?php echo $_GET['id'] ?>";
                    });
                }
            });
        });
    });
</script>

