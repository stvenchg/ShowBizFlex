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

    $('#submitSetupGenres').click(function() {
    if ($("#formSetupGenres input:checkbox:checked").length >= 3)
    {
        var checkedValue = [];
        $('#formSetupGenres input:checkbox:checked').each(function(){
            checkedValue.push($(this).val());
        })

        var formData = {
        'idUser': <?php echo $_SESSION['id'] ?>,
        'idGenre': checkedValue,
        };

        $.ajax({
            type: 'POST',
            url: 'Assets/js/ajax/setFavGenres.php',
            data: formData,
            dataType: 'json',
            encode: true
        })
    }
    else
    {
        Swal.fire(
            'Il y a un problème !',
            'Sélectionne au minimum trois genres parmi ceux qui sont proposés.',
            'error'
        );
    }
    });
});

</script>