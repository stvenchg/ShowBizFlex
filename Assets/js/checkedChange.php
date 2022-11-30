<script>
$(document).ready(function() {
    $('#enableAdultCheckbox').change(function() {
        if (this.checked) {
            $.post("Assets/js/setAdult.php", {
                idUser: <?php echo $_SESSION['id'] ?>,
                adult: 1,
            }, function(data) {
                if (data == 1) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Les contenus sensibles seront visibles'
                    })
                }
            });
        }
        else {
            $.post("Assets/js/setAdult.php", {
                idUser: <?php echo $_SESSION['id'] ?>,
                adult: 0,
            }, function(data) {
                if (data == 0) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Les contenus sensibles seront masqués'
                    })
                }
            });
        }
    });
});
</script>