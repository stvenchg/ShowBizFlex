<script> 

$(document).ready(function () {
    $('.favButton').click(function(){
         
        $.post("Assets/js/followShow.php", {idUser:"<?php echo $_SESSION['id'] ?>",idShow:"<?php echo$_GET['id']?>"} , function(data) {
            if (data == 1) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Ajouté à votre liste de séries suivies !',
                    showConfirmButton: false,
                    timer: 950
                });
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Retiré de votre liste de séries suivies !',
                    showConfirmButton: false,
                    timer: 950
                });
            }
        });

    });


});

</script>