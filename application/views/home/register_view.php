<div class="row">
    <div class="span6">
        <div id="register_form_error" class="alert alert-error" ><!-- Dynamic --></div>
        <form id="register_form" class="form-horizontal" method="post" action="<?=site_url('user/register') ?>">
            <div class="control-group">
                <label class="control-label">Login</label>
                <div class="controls" >
                    <input type="text" name="login" class="input-xlarge" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Email</label>
                <div class="controls" >
                    <input type="text" name="email" class="input-xlarge" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Password</label>
                <div class="controls" >
                    <input type="password" name="password" class="input-xlarge" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Confirm Password</label>
                <div class="controls" >
                    <input type="password" name="confirm_password" class="input-xlarge" />
                </div>
            </div>
            <div class="control-group">
                <div class="controls" >
                    <input type="submit" value="Register" class="btn btn-primary" />
                </div>
            </div>
        </form>
        <a href="<?=site_url('/')?>">Back</a>
    </div>
</div>

<script type="text/javascript">
$(function(){
    //alert('It work!');
    $('#register_form_error').hide();
    
    $("#register_form").submit(function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var postData = $(this).serialize();
        $.post(url, postData, function(o){
            if(o.result === 1){
                //alert('Good login!');
                window.location.href='<?=site_url('dashboard')?>';
            }else{
                // You cannot check it totally in the front end as 
                // you have to access the database 
                $('#register_form_error').show();
                var output='<ul>';
                /*
                // o.error is an object than an array
                // although we set it as an array
                // Be careful when implement this
                for(var i=0; i<o.error.length; i++){
                    output+='<li>'+o.error[i]+'</li>';
                }
                */
               for(var key in o.error){
                   var value=o.error[key];
                   output+='<li>'+key+': '+value+'</li>';
                   //console.log(o.error[key]);
               }
                output+='</ul>';
                $('#register_form_error').html(output);
            }
        }, 'json');
    });
});
</script>