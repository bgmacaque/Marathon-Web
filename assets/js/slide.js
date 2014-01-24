

var slideshow =  {
    
    nbSlide : 0,
    nbCurrent : 1,
    $current : null,
    slider : null,
    timer : null,

    init : function(slider){
        this.nbSlide = slider.find('.slide').length;
        slider.append('<div class="navigation"></div>');
        //Création de la pagination
        for(var i = 1 ; i <= this.nbSlide ; i++){
            slider.find('.navigation').append('<span>'+i+'</span>');
        }
        slider.find('.navigation span').on('click', function(){
            slideshow.gotoSlide($(this).text());
        });

        slider.find('.navigation span:first').addClass('active');

        //Initialisation
        this.slider = slider;
        slider.find('.slide').hide();
        slider.find('.slide:first').show();
        this.$current = slider.find('.slide:first');


        //Création du timer
        slideshow.play();

        //Arret lorsqu'on passe dessus
        this.slider.on('mouseover', function(){
            slideshow.stop();
        });

        this.slider.on('mouseout', function(){
            slideshow.play();
        })
    },

    gotoSlide : function(numSlide){
        if(this.nbCurrent != numSlide){
            //Anim en fade
            // this.$current.fadeOut();
            // this.slider.find("#slide" + numSlide).fadeIn();

            //Anim en slide
            var sens = 1;
            if(numSlide < this.nbCurrent){
                sens = -1;
            }
            var cssDepart = {
                'left' : sens*this.slider.width()
            }
            var cssArrive = {
                'left' : -sens*this.slider.width()
            }

            this.slider.find('#slide' + numSlide).show().css(cssDepart);
            this.slider.find('#slide' + numSlide).animate({
                top : 0,
                left : 0
            }, 500);
            this.$current.animate(cssArrive, 500);


            this.slider.find('.navigation span').removeClass('active');
            this.slider.find('.navigation span:eq(' + (numSlide - 1) + ')').addClass('active');
            this.nbCurrent = numSlide;
            this.$current = this.slider.find("#slide" + numSlide);
        }
    },

    next : function(){
        var num = this.nbCurrent + 1 ;
        if( num > this.nbSlide){
            num = 1;
        }
        this.gotoSlide(num);
    },

    stop : function(){
        window.clearInterval(slideshow.timer);
    },

    play : function(){
        window.clearInterval(slideshow.timer);
        this.timer = window.setInterval(function(){
            slideshow.next();
        }, 2000);
    }
}

$(document).ready(function(){
    slideshow.init($('#wrapper'));
});