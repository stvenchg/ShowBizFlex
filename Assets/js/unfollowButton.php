<script type="text/javascript">
    $(document).ready(function() {
        $("#unfollowButton").click(function() {

            if ($('#unfollowButton').hasClass('activeFavButton')) {
                $('#unfollowButton').removeClass('activeFavButton')
            } else {
                $('#unfollowButton').addClass('activeFavButton')
            }

            iziToast.settings({
                resetOnHover: true,
                transitionIn: 'fadeInDown',
                transitionOut: 'fadeOutUp',
            });

            $.post("Assets/js/ajax/deleteFollow.php", {
                idUser: "<?php echo $_SESSION['id'] ?>",
                idUserToFollow: "<?php echo $_GET['id'] ?>"
            }, function(data){
                if (data == "1") {
                    Toast.fire({
                        icon: 'success',
                        title: 'Vous vous êtes désabonner de cette personne !',
                    })
                }
            });
        });
    });
</script>


<?php
/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/
?>