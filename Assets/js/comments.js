$(function(){
    $("#formCommments").submit(function(){
        $("#loader").show();
        message = $(this).find("textarea[name=commentaire]").val();
        $.post("addComments.php", {message: commentaire}, function(data){
        $("#loader").hide();
        });
    });
});
