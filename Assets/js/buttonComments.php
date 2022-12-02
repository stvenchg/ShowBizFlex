<script type="text/javascript">
    $(document).ready(function() {
        $(".addComment").click(function() {
            $('#loader').show();
            commentaire = $(".zoneComments").val();
            $.post("Assets/js/addComments.php", {
                com:commentaire, 
                idUser: "<?php echo $_SESSION['id'] ?>",
                idShow: "<?php echo $_GET['id'] ?>"
            }, function(data){
                $('#loader').hide();
                if(data == "Ok"){
                    alert("Vous avez ajouté un commentaire !");
                }
            });
            return false;
        });
    });
</script>

<?php /*
    $model = new ModelShows();
    $comments = $model->getComments($_GET['id']);
    foreach($comments as $row){
        echo '<b class="usernameComments">'. $row['username'] . '</b>' . " : " . $row['message'] . "<br>";
        echo 'Publié le : ' . $row['datePublication'] . "<br>";
    }*/
?>
