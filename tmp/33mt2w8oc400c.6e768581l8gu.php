<!DOCTYPE html>
<html>
    <head>
        <title>View Blog</title>
        
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href= "css/mainstyle.css" rel="stylesheet" type="text/css">
        <link href= "css/viewblog.css" rel="stylesheet" type="text/css">
    </head>
    
    <body>
        <div id="wrapper">
            <div class="row">
            <div class="col-md-3">
                <section id="nav">
 
                            <h2>Blog Site</h2>
                            <p><a href="./loginhome" /> Home</a></p>
                            <p><a href="./myblogs" /> my Blogs</a></p>
                            <p><a href="./createblog" /> create blog</a></p>
                            <p><a href="./aboutuslogin" /> About us</a></p>
                            <p><a href="#" /> Logout</a></p>
                            <div id="spacer"> </div>
                </section><!--section Nav-->
            </div><!--cols 3-->
            


                
            <div class="col-md-8">
                <section id="heading">
 
                       <h1><?= $username ?>'s Blogs</h1>

                </section><!--section Nav-->
            </div><!--cols 3-->
            
            
            <div class="col-md-5">
                <h3>My most recent blog:</h3>
                <section id="content">
 
                       
                       <p><?= $recentBlog ?></p>

                </section><!--section Nav-->
                <h3>My blogs:</h3>
                
                 <?php foreach (($bloggerDB?:[]) as $blog): ?>

                    <section id="content">
                       <a href="./fullbloglogin/?id=<?= $blog['id'] ?>"><p><?= $blog['title'] ?></p></a>  - word count 716 - <?= $blog['date_added'].PHP_EOL ?>
                       <p><?= $blog['blog_content'] ?></p>
                    </section><!--section Nav-->

                 <?php endforeach; ?>
            </div><!--cols 5-->
            
                        
            <div class="col-md-3">
                <section id="">
 
                        <img src="images/user.png" />
                </section><!--section Nav-->
                
                <section id="nav">
 
                    <h2><?= $username ?></h2>
                    <p>Bio: <?= $bio ?></p>

                </section><!--section Nav-->
            </div><!--cols 4-->
 

            


           
            
            


            

            </div><!--End row-->            
        </div><!--End wrapper-->
    </body>
</html>