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

            $.post("Assets/js/ajax/addComments.php", {
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


<?php
/*
ShowBizFlex - 2022/12/05
GNU GPL CopyLeft 2022-2032
Initiated by Rachid ABDOULALIME - Steven CHING - Yanis HAMANI
WebSite : <https://dev.showbizflex.com/>
*/
?>
