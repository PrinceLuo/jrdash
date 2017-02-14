var Result = function () {

    this.__construct = function () {
        console.log('Result created.');
    };
    
    // -------------------------------------------------------------------------
    this.success=function(msg){
        if(msg === 'undefined'){
            $('#success').html('Success.').fadeIn();
        }else{
            $('#success').html(msg).fadeIn();
        }
        setTimeout(function(){
            $('#success').fadeOut();
        }, 5000);
    };
    
    // -------------------------------------------------------------------------
    this.error=function(msg){
        if(msg === 'undefined'){
            $('#error').html('Error.').fadeIn();
        }else if(typeof msg==='object'){
            // Loop
            var output='<ul>';
            for(var key in msg){
                output+='<li>'+msg[key]+'</li>';
            }
            output+='</ul>';
            $('#error').html(output).fadeIn();
        }else{
            $('#error').html(msg).fadeIn();
        }
        setTimeout(function(){
            $('#error').fadeOut();
        }, 5000);
    };
    
    // -------------------------------------------------------------------------
    this.__construct();
};