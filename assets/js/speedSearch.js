var recherche = {

    list : null, 
    champ : null,
    //Filter est la liste dans laquelle se trouve les champs
    init : function(list, champ){
        this.list = list;
        this.champ = champ;
        this.champ.on('keyup', function(){
            var input = $(this);
            var val = input.val();
            if(val == ''){
                recherche.list.find('li').fadeIn(500);
                recherche.list.find('li span').removeClass('highlighted');
            }else{
                var regexp = '\\b(.*)';
                for(var i in val){
                    regexp += '(' + val[i] + ')(.*)';
                }
                regexp += '\\b';
                // recherche.list.find('li').show();
                recherche.list.find('li').each(function(){ 
                    var contenu = $(this);
                    var resultats = contenu.text().match(new RegExp(regexp, 'i'));
                    if(resultats){
                        contenu.fadeIn(500);
                        // var string = '';
                        // for(var i in resultats){
                        //     if( i > 0){
                        //         if(i % 2 == 0){
                        //             string += '<span class="highlighted">' + resultats[i] + '</span>';
                        //         }else{
                        //             string += resultats[i];
                        //         }
                        //     }
                        // }
                        // contenu.empty().append(string);
                    }else{
                        contenu.fadeOut(500);
                    }
                });
            }
        });
    }
}

$(document).ready(function(){
    recherche.init($('#filter'), $('#champFilter'));
});