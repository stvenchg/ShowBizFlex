<script type="text/javascript">
    $(document).ready(function() {
        $('#formCommments').click(function() {
            $('#loader').show();
            commentaire = $(this).find("textarea[name=commentaire]").val();
            $.post("Assets/js/addComments.php", {
                com:commentaire, 
                idUser: "<?php echo $_SESSION['id'] ?>",
                idShow: "<?php echo $_GET['id'] ?>"
            }, function(data){
                $('#loader').hide();
            });
            return false;
        });
    });
</script>
