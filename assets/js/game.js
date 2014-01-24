var pm = {
    config : {
        autosize : true,
        width : 100,
        height : 100,
    },
    canvas : null,

    autosize : function(){
        if(pm.config.autosize){
            pm.config.width = window.innerWidth;
            pm.config.height = window.innerHeight;
            $(pm.canvas).attr({width : pm.config.width, height : pm.config.height});
        }
    },

    init : function(){
        this.canvas = $('canvas');
        this.autosize();
        this.canvas = this.canvas[0];
        alert(this.canvas); 
        // this.ctx = this.canvas.getContext('2d');
        // this.ctx.fillRect(100,100,100,100);
    }
}

pm.init();