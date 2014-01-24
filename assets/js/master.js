$(document).ready(function(){
  

    var $connexion = $('#connexion'),
    $inscription = $('#inscription'),
    $inscrire = $('#inscrire'),
    $form_subscribe = $('#form_subscribe'),
    $form_connexion = $('#form_connexion'),
    $deconnexion = $('#deconnexion'),
    $form_ajouter_panier = $('.form_ajouter_panier'),
    $form_supprimer_panier = $('.form_supprimer_panier'),
    $form_ajouter_comment = $('#form_ajouter_comment'),
    $form_ajouter_favresto = $('#form_ajouter_favresto'),
    $notePlat = $('.note'),
    $lienRestaurant = $('.lienRestaurant');
    
    $form_subscribe.hide();
    $form_connexion.hide();  



    $notePlat.on('mouseover', function() {
        var idStar = $(this).attr('idStar');
        $notePlat.each(function(index){
            if($(this).attr('idStar') <= idStar){
                $(this).removeClass('noteNotSelected').addClass('noteSelected');
            }else{
                $(this).removeClass('noteSelected').addClass('noteNotSelected');
            }
        });
        
    });

    $notePlat.on('mouseout', function(){
        var idStar = $('#valeur_note').attr('value');
        $notePlat.each(function(index){
            if($(this).attr('idStar') <= idStar){
                $(this).removeClass('noteNotSelected').addClass('noteSelected');
            }else{
                $(this).removeClass('noteSelected').addClass('noteNotSelected');
            }
        });
    });

    $notePlat.on('click', function(){
        var idStar = $(this).attr('idStar');
        var $valeur_note = $('#valeur_note');
        $valeur_note.attr('value', idStar);
    });
    

    $form_ajouter_comment.on('submit', function(){
        var $contenu = $(this).find('textarea[name=contenu]');
        if($contenu.val().length != 0){
            $.ajax({
                url : $(this).attr('action'),
                type : $(this).attr('method'),
                data : $(this).serialize(),
                success : function(reponse){
                    $('#commentaires').html(reponse);
                }
            });
        }else{
            alert('Il n\'y a pas de contenu');
            $contenu.focus();
        }
        return false;
    });

    // $deconnexion.on('click', function(e){
    //     e.preventDefault();
    //     $.ajax({
    //         url : $(this).attr('url'),
    //         type : 'GET',
    //         success : function(reponse){    
    //             $('#compte').html(reponse);
    //         }
    //     });
    //     return false;
    // });

    $connexion.on('click', function(){
        $connexionBlock = $('.connexion');

        if($('#form_subscribe').css('display') == 'none')
            $connexionBlock.fadeToggle(500);
    });



    // $lienRestaurant.on('click', function(){
    //     $.ajax({
    //         url : $(this).attr('url'),
    //         type : 'GET',
    //         success : function(reponse){
    //             alert(reponse);
    //         }
    //     });
    // }); 

    $inscription.on('click', function(){
        $inscriptionBlock = $('.inscription');
        if($('#form_connexion').css('display') == 'none')
            $inscriptionBlock.fadeToggle(500);
    });

    $form_connexion.on('submit', function(){
        var $pseudo = $(this).find('input[name=pseudo]');
        var pseudo = $pseudo.val();
        if(pseudo.length > 0){
            var $pass = $(this).find('input[name=pass]');
            var pass = $pass.val();
            if(pass.length > 0){
                $.ajax({
                    url : $(this).attr('action'),
                    type : $(this).attr('method'),
                    data : $(this).serialize(),
                    success : function(reponse){
                        switch(reponse){
                            case 'incomplet':

                                break;
                            case 'pasbon':
                                alert('Mauvais mot de passe');
                                break;
                            default:
                                $('#compte').html(reponse);
                                break;
                        }
                    }

                });
            }else{  
                alert('Pass non défini');
                $pass.focus();
            }
        }else{
            //Pseudo pas défini
            alert('Pseudo non défini');
            $pseudo.focus();
        }
        return false;
    });

    $form_subscribe.on('submit', function(){
        var $pseudo = $(this).find('input[name=pseudo]');
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var pseudo = $pseudo.val();
        if(pseudo.length > 0){
            var $pass = $(this).find('input[name=pass]');
            var pass = $pass.val();
            if(pass.length > 0){
                var $confirmPass = $(this).find('input[name=passConfirm]');
                if($confirmPass.val() == pass){
                    $.ajax({
                        url : $(this).attr('action'),
                        type : $(this).attr('method'),
                        data : $(this).serialize(),
                        success : function(reponse){
                            switch(reponse){
                                case 'dejaPris':
                                    alert('Le pseudo est déjà pris');
                                    break;
                                case 'true':
                                    alert('Inscription réussie!');
                                    $('#form_subscribe').hide();
                                    break;
                            }
                        },
                    });
                }else{
                    alert('Le pass de confirmation n\'est pas le même');
                    $confirmPass.focus();
                }
            }else{
                alert('Le pass n\'est pas défini');
                $pass.focus();
            }
        }else{
            alert('Le pseudo n\'est pas défini');
            $pseudo.focus();
        }
        return false;
    }); 

    $form_ajouter_panier.on('submit', function(){
        var $quantite = $(this).find('input[name=quantite]');
        if($quantite.val().length != 0 && $quantite.val() > 0){
            $.ajax({
                url : $(this).attr('action'),
                type : $(this).attr('method'),
                data : $(this).serialize(),
                success : function(reponse){
                    $('#montantPanier').html(reponse + '&euro;');
                }
            })
        }
        return false;
    });

    $form_supprimer_panier.on('submit', function () {
        var id_plat = $(this).find('input[name=id_plat]');
        $.ajax({
            url : $(this).attr('action'),
            type : $(this).attr('method'),
            data : $(this).serialize(),
            success : function(reponse) {
                if(reponse != 'false'){
                    var $plats = $('.lignePlat');
                    $plats.each(function(index) {
                        if($(this).attr('idPlat') == reponse){
                            $(this).remove();
                        }
                    });
                    $plats = $('.lignePlat');
                    if($plats.length == 0){
                        $('#content').html('Votre panier est vide');
                        $('#montantPanier').html(0);
                    }
                }
            }
        });
        return false; 
    });

    $form_ajouter_favresto.on('submit', function(){
        var $id_resto = $(this).find('input[name="id_resto"]');    
        $.ajax({
            url : $(this).attr('action'),
            type : $(this).attr('method'),
            data : $(this).serialize(),
            success : function(reponse){
                if(reponse == 'true'){
                    alert('Bien ajouté');
                }else if(reponse=='deja'){
                    alert('Vous avez déjà ce restaurant dans vos favoris');
                }else{
                    alert('Vous n\'êtes pas connecté!');
                }
            }
        });
        return false;
    });

    //SWITCHER CSS

    $('#themeSwitcher > select > option').click(function(){
        var style = $(this).val();
        style = 'assets/css/themes/'+style;
        $('#theme').attr('href', style);

        //Changement de la variable de session
        $.ajax({
            url: 'index.php/ajax/style/' + $(this).val().substr(0, $(this).val().length - 4),
            type: 'GET'
        });
    });

    if($('#date_exp'))
        $('#date_exp').datepicker();

    if($('#liquide') && $('#bancaire')){
        $('#bancaire').on('click', function(){
            $('#coordonnees_bancaires').fadeIn();
        });

        $('#liquide').on('click', function(){
            $('#coordonnees_bancaires').fadeOut();
        });
    }

    if($('#form_subscribe')){
        $('#form_subscribe').draggable();
        $('#annuler_inscr').on('click', function(){
            $('#form_subscribe').fadeOut();
        });

        $('form')[1].style.top = - screen.height + $('#form_subscribe').height() /2 /2 +"px";
        $('form')[1].style.left = screen.width /2 - $('#form_subscribe').width() /2 + "px";
    }

    if($('#form_connexion')){
        $('#form_connexion').draggable();
        $('#annuler_co').on('click', function(){
            $('#form_connexion').fadeOut();
        });

        $('form')[0].style.top = - screen.height + $('#form_connexion').height() /2 /2 +"px";
        $('form')[0].style.left = screen.width /2 - $('#form_connexion').width() /2 + "px";

    }

});