<!DOCTYPE html>
<html>
    <head>
        <title>View Blog</title>
        
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href= "css/mainstyle.css" rel="stylesheet" type="text/css">
        <link href= "css/viewblog.css" rel="stylesheet" type="text/css">
        <link href= "css/fullblog.css" rel="stylesheet" type="text/css">
    </head>
    
    <body>
        <div id="wrapper">
            <div class="row">
            <div class="col-md-3">
                <section id="nav">
 
                            <h2>Blog Site</h2>
                            <p><a href="./" /> Home</a></p>
                            <p><a href="./register" /> Become a blogger</a></p>
                            <p><a href="./aboutus" /> About us</a></p>
                            <p><a href="./login" /> Login</a></p>
                            <div id="spacer"> </div>

                </section><!--section Nav-->
            </div><!--cols 3-->
            
            <div class="col-md-8">
                <section id="nav">
                    <img src="images/user.png" />
                    <center><h1><?= $title ?></h1></center>
        
                    <p><?= $content ?></p>
                    
                    
                </section><!--section Nav-->
            </div><!--cols 3-->

            </div><!--End row-->            
        </div><!--End wrapper-->
    </body>
</html>