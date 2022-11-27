<script>
$(document).ready(function() {
    $('#enableAdultCheckbox').change(function() {
        if (this.checked) {
            $.post("Assets/js/setAdult.php", {
                idUser: <?php echo $_SESSION['id'] ?>,
                adult: 1,
            }, function(data) {
                if (data == 1) {
                    iziToast.success({
                        title: 'OK !',
                        message: 'Les contenus pour adulte seront affichés.',
                        position: 'topCenter',
                        timeout: 1500,
                        close: false,
                        displayMode: 2,
                    });
                }
            });
        }
        else {
            $.post("Assets/js/setAdult.php", {
                idUser: <?php echo $_SESSION['id'] ?>,
                adult: 0,
            }, function(data) {
                if (data == 0) {
                    iziToast.success({
                        title: 'OK !',
                        message: 'Les contenus pour adulte seront masqués.',
                        position: 'topCenter',
                        timeout: 1500,
                        close: false,
                        displayMode: 2,
                    });
                }
            });
        }
    });
});
</script>