<!DOCTYPE html>
<html>
    <head>
        <title>View Blog</title>
        
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href= "css/mainstyle.css" rel="stylesheet" type="text/css">
        <link href= "css/viewblog.css" rel="stylesheet" type="text/css">
        <link href= "css/fullblog.css" rel="stylesheet" type="text/css">
        <link href= "css/aboutus.css" rel="stylesheet" type="text/css">
        <link href= "css/login.css" rel="stylesheet" type="text/css">
        <link href= "css/register.css" rel="stylesheet" type="text/css">
        
    </head>
    
    <body>

        <div id="wrapper">
            <div class="row">
            <div class="col-md-3">
                <section id="nav">
                 <img src="images/trumpet.png" />
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
                <section id="nav2">
                    
                    <div id="headerWords">
                        <img src="images/writing.png" />
                        <h1>Change your mind?</h1>
                    </div>
                </section><!--section Nav-->
                
            </div><!--cols 3-->
            
               <div class="col-md-8">
                <section id="nav">
                    <div class="container">
                        <form action="./updateblogprocess" method="post">
                            
                          <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-1 col-form-label">Update title</label>
                            <div class="offset-sm-8 col-sm-8">
                              <input type="text" name="title" class="form-control" id="inputPassword3" value="{{@title}}" placeholder="Title...">
                            </div>
                          </div>   
                         
                        <div class="form-group">
                          <label for="bio">Update Blog Entry</label>
                          <textarea class="form-control" name="blogEntry" id="bio" rows="6" >{{@blogEntry}}</textarea>
                        </div>
                        
                                                    <div class="form-group row">
                              <div class="offset-sm-2 col-sm-4">
                              <button type="submit" name="submit" class="btn btn-primary">update</button>
                            </div>
                              
   
                            
                          </div>
                        </form>
                      </div>
                

                </section><!--section Nav-->
                
            </div><!--cols 3-->

            </div><!--End row-->
            

        </div><!--End wrapper-->
    </body>
</html>