<!DOCTYPE html>
<html>
    <head>
        <title>Logged in Home</title>
        
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href= "css/mainstyle.css" rel="stylesheet" type="text/css">
    </head>
    
    <body>
        <div id="wrapper">
            <div class="row">
            <div class="col-md-3 no-float">
                <section id="nav">
                 <img src="images/trumpet.png" />
                            <h2>Blog Site</h2>
                            <p><a href="./" /> Home</a></p>
                            <p><a href="./register" /> Become a blogger</a></p>
                            <p><a href="./aboutus" /> About us</a></p>
                            <p><a href="./login" /> Login</a></p>
                            <div id="spacer"> </div>
                </section><!--section Nav-->
            </div><!--cols 3-->
            
            <div class="col-md-9 no-float">
    
                <?php foreach (($blogDB?:[]) as $blog): ?>
                         <div class="col-md-4">
                         <section id="profileContent">
                                     <img src="images/user.png" />
                                     <center><p> <?= $blog['username'] ?></p></center>
                                     <hr />
                                     <a href="./viewBlog/?member_id=<?= $blog['id'] ?>"><p id="viewTotal"> Views:</p></a>
                                     <p id="viewTotal">Total: 10</p>
                                 <hr />
                             <p> <?= $blog['blog_content'] ?> </p>
                         </section><!--section-->
                     </div><!--cols 3-->
                 <?php endforeach; ?>
                
            </div>
            </div><!--End row-->            
        </div><!--End wrapper-->
    </body>
</html>