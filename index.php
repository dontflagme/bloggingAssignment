<?php

/**
 *@author: Kevin Nguyen
 *@version: 1.0
 *@date: 4.23.2017
 *This is for a blog website. It takes in basic information of the new user.
 */
//Require the autoload file
require_once('vendor/autoload.php');
session_start();
//Create an instance of the Base class
$f3 = Base::instance();
$f3->set('DEBUG', 3);


                  //Define a default route
                    $f3->route('GET /', function() {
                      $view = new View;
                      echo $view->render('pages/home.html');
                     }
                   );
                    
                  //views all blogs of one member
                  $f3->route('GET /viewBlog',
                   function(){
                    $view = new View;
                    echo $view->render('pages/viewblog.html');
                   });
                  
                  //Read the full content of the blog.
                  $f3->route('GET /fullblog',
                   function(){
                    $view = new View;
                    echo $view->render('pages/fullblog.html');
                   });
                  
                  //About us page of site
                  $f3->route('GET /aboutus',
                   function(){
                    $view = new View;
                    echo $view->render('pages/aboutus.html');
                   });
                  
                  //Login page
                  $f3->route('GET /login',
                   function(){
                    $view = new View;
                    echo $view->render('pages/login.html');
                   });
                  
                  //Register page 
                  $f3->route('GET /register',
                   function(){
                    $view = new View;
                    echo $view->render('pages/register.html');
                   });
                  
                  //Takes the information to create a new person
                  $f3->route('POST /createMember',
                   function($f3){
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['password'] = $_POST['password'];
                    $_SESSION['bio'] = $_POST['bio'];
                    
                    $username = $_SESSION['username'];
                    $email = $_SESSION['email'];
                    $password = $_SESSION['password'];
                    $bio = $_SESSION['bio'];
                    
                    $f3->set('username', $username);
                    $f3->set('email', $email);
                    $f3->set('password', $password);
                    $f3->set('bio', $bio);
                    
                    echo Template::instance()->render('pages/create_new_member.php');
                   });
                  
                  //Create blog when logged in.
                  $f3->route('GET /createblog',
                   function(){
                    $view = new View;
                    echo $view->render('pages/createblog.php');
                   });
                  
                  //Updates a specific blog
                  $f3->route('GET /updateblog',
                   function(){
                    $view = new View;
                    echo $view->render('pages/updateblog.php');
                   });
                  
                  //Shows the blogs you can update or delete
                   $f3->route('GET /myblogs',
                   function(){
                    $view = new View;
                    echo $view->render('pages/myblogs.php');
                   });
$f3->run();        
?>