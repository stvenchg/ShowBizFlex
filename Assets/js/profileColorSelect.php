<script>

$(document).ready(function() {

    // Blue
    $('#paletteBlue').click(function() {
        $.post("Assets/js/ajax/setProfileColor.php", {
                idUser: <?php echo $_SESSION['id'] ?>,
                color: '#3DB4F2',
            }, function(data) {
                if (data == 1) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Les changements ont été enregistrés'
                    })
                }
            });
    });

    // White
    $('#paletteWhite').click(function() {
        $.post("Assets/js/ajax/setProfileColor.php", {
                idUser: <?php echo $_SESSION['id'] ?>,
                color: 'white',
            }, function(data) {
                if (data == 1) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Les changements ont été enregistrés'
                    })
                }
            });
    });

    // Green
    $('#paletteGreen').click(function() {
        $.post("Assets/js/ajax/setProfileColor.php", {
                idUser: <?php echo $_SESSION['id'] ?>,
                color: '#4CCA51',
            }, function(data) {
                if (data == 1) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Les changements ont été enregistrés'
                    })
                }
            });
    });

     // Orange
     $('#paletteOrange').click(function() {
        $.post("Assets/js/ajax/setProfileColor.php", {
                idUser: <?php echo $_SESSION['id'] ?>,
                color: '#EF881A',
            }, function(data) {
                if (data == 1) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Les changements ont été enregistrés'
                    })
                }
            });
    });

    // Red
    $('#paletteRed').click(function() {
        $.post("Assets/js/ajax/setProfileColor.php", {
                idUser: <?php echo $_SESSION['id'] ?>,
                color: '#E13333',
            }, function(data) {
                if (data == 1) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Les changements ont été enregistrés'
                    })
                }
            });
    });

    // Pink
    $('#palettePink').click(function() {
        $.post("Assets/js/ajax/setProfileColor.php", {
                idUser: <?php echo $_SESSION['id'] ?>,
                color: '#FC9DD6',
            }, function(data) {
                if (data == 1) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Les changements ont été enregistrés'
                    })
                }
            });
    });

    // Grey
    $('#paletteGrey').click(function() {
        $.post("Assets/js/ajax/setProfileColor.php", {
                idUser: <?php echo $_SESSION['id'] ?>,
                color: '#677B94',
            }, function(data) {
                if (data == 1) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Les changements ont été enregistrés'
                    })
                }
            });
    });

    // Purple
    $('#palettePurple').click(function() {
        $.post("Assets/js/ajax/setProfileColor.php", {
                idUser: <?php echo $_SESSION['id'] ?>,
                color: '#C063FF',
            }, function(data) {
                if (data == 1) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Les changements ont été enregistrés'
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