<?php

/**
 *@author: Kevin Nguyen
 *@version: 1.0
 *@date: 4.23.2017
 *This is for a dating website. It takes in basic information of the new user.
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
                    
                    
                  $f3->route('GET /viewBlog',
                   function(){
                    $view = new View;
                    echo $view->render('pages/viewblog.html');
                   });
                  
                  $f3->route('GET /fullblog',
                   function(){
                    $view = new View;
                    echo $view->render('pages/fullblog.html');
                   });
                  $f3->route('GET /aboutus',
                   function(){
                    $view = new View;
                    echo $view->render('pages/aboutus.html');
                   });
                  
                  $f3->route('GET /login',
                   function(){
                    $view = new View;
                    echo $view->render('pages/login.html');
                   });
                  
                  $f3->route('GET /register',
                   function(){
                    $view = new View;
                    echo $view->render('pages/register.html');
                   });
$f3->run();        
?>