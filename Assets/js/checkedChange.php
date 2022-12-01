<script>
$(document).ready(function() {
    $('#enableAdultCheckbox').change(function() {
        if (this.checked) {
            $.post("Assets/js/ajax/setAdult.php", {
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
            $.post("Assets/js/ajax/setAdult.php", {
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

    $('#enablePrivate').change(function() {
        if (this.checked) {
            $.post("Assets/js/ajax/setPrivate.php", {
                idUser: <?php echo $_SESSION['id'] ?>,
                private: 1,
            }, function(data) {
                if (data == 1) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Ton profil sera inaccessible pour les autres utilisateurs'
                    })
                }
            });
        }
        else {
            $.post("Assets/js/ajax/setPrivate.php", {
                idUser: <?php echo $_SESSION['id'] ?>,
                private: 0,
            }, function(data) {
                if (data == 0) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Ton profil sera visible pour les autres utilisateurs'
                    })
                }
            });
        }
    });
});

</script>