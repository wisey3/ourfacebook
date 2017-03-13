<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Social Network</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
       
        <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">

<script src="jquery-3.1.1.min.js"></script>
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

  </head>

  <body>
 <section class="bg-default back">
    <div class="container text-center" >

      <form class="form-signin"  action="profile.php" method="post">
        <h2 class="form-signin-heading">Welcome</h2>
        <h3 class="text-center">Log in</h3>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input name="email" type="email" id="email" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
     
        <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
      </form>
      
       <div class="register"><p>Don't have an account?</p> <button class="btn btn-success btn-block" data-toggle="modal" data-target="#signup" type="submit">Sign up</button></div>

    </div> <!-- /container -->
    </section>
<div class="modal fade" id="signup">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
            Register
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form id="form" method="POST" class="form-horizontal" role="form">
                         <div class="form-group">
                        <div class="col-sm-12">
                                       <div class="input-group">
                                      <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input id="name" name="name" data-validation="length" data-validation-length="min4" class="form-control required" type="text" size="16" placeholder="Name" autofocus="autofocus" required/>
                            </div>
                        </div>
                
                        </div>
                          <div class="form-group">
                            <div class="col-xs-6">
                           
                          
                           
                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
       
                                <select class="form-control" name ="sex" id="sex" required>
  								<option selected>Male</option>
  								<option>Female</option>
  								<option>Other</option>
								</select>
                      
                        </div>
                        </div>
                        <div class="col-xs-6">
                           
                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-location-arrow"></i></span></span>
                                <input id="location" name="location" data-validation="length" data-validation-length="min3"   class="form-control required" type="text" size="16" placeholder="Location" required/>
                            </div>
                        </div>
                    </div
                       </div> 
                             
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                <input id="dob" name="dob" data-validation="length" data-validation-length="10" class="form-control required" type="text" size="5" placeholder="Date of Birth: DD/MM/YYYY" required/>
                            </div>
                        </div> 
                        </div>
                          <div class="form-group">
                            
                    </div>
                          <div class="form-group">
                            <div class="col-sm-12">
                           
                              <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                                <input id="email" name="email" data-validation="email" class="form-control email" type="email" size="16" placeholder="Email" required/>
                            </div>
                        </div>
                    </div>
                         <div class="form-group">
                            <div class="col-sm-12">
                           
                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input id="password" name="password" class="form-control" type="password" size="16" placeholder="Password" required/>
                            </div>
                        </div>
                    </div>
          


                 
                    
                    <h3 id="errormessage" style="color:red" class="payment-errors text-center"></h3>
          
                
                </form>

            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js"></script>
<script>$.validate();</script>
            <div class="modal-footer">
            
                <button id="submit" type="button" class="btn btn-primary col-sm-12 col-xs-12 form-group"
                           data-progress-text="<span class='glyphicon glyphicon-refresh fa-spin'></span>"
                           data-success-text="<span class='glyphicon glyphicon-ok'></span>"
                >
                    Sign Up!
                </button>
                
<script>
          var $btn = $('#submit');
       $btn.on('click', function(e) {   
       //$btn.prop('disabled', true);
//$btn.button('progress');
  
    $.ajax({
           type: "POST",
           url: "register.php",
           data: $("#form").serialize(), // serializes the form's elements.
    
           success: function(data) {
                            if (!data.success) { //If fails
                                if (data.errors.name) { //Returned if any error from process.php
                                    $('.payment-errors').fadeIn(1000).html(data.errors.name); //Throw relevant error
                                }
                                else if (data.errors.password) { //Returned if any error from process.php
                                    $('.payment-errors').fadeIn(1000).html(data.errors.password); //Throw relevant error
                                }
                                else if (data.errors.repeat) { //Returned if any error from process.php
                                    $('.payment-errors').fadeIn(1000).html(data.errors.repeat); //Throw relevant error
                                }
                            }
                            else {
                                    $('.payment-errors').fadeIn(1000).append('<h3 style="color:green">' + data.posted + '</h3>'); //If successful, than throw a success message
                setTimeout(function() {
                $('#signup').modal('hide');
            }, 350);
                                }
                            }
                            
      
        });

    e.preventDefault(); // avoid to execute the actual submit of the form.

});
</script>

                </div>
          
            </div>
        </div>
    </div>
</div>
    
         <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

  </body>

</html>
