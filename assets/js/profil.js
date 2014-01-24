$(document).ready(function(){

    var $form = $('#form_changepass');

    $form.on('submit', function(argument) {
        var $pass = $(this).find('input[name="pass"]');
        if($pass.val().length > 0){
            var $newPass = $(this).find('input[name="newPass"]');
            if($newPass.val().length >0){
                var $confirmPass = $(this).find('input[name="confirmPass"]');
                if($newPass.val() == $confirmPass.val()){
                    $.ajax({
                        url : $(this).attr('action'),
                        type : $(this).attr('method'),
                        data : $(this).serialize(),
                        success : function(reponse){
                            if(reponse == 'true'){
                                alert('Le mot de passe a bien été changé');
                            }else{
                                alert('Erreur!');
                            }
                        }
                    });
                }else{
                    alert('La confirmation de mot de passe n\'est pas défini');
                    $confirmPass.focus();
                }
            }else{
                alert('Le nouveau pass n\'est pas défini');
                $newPass.focus();
            }
        }else{  
            alert('Le pass n\'est pas défini');
            $pass.focus();
        }
    });
    return false;
});