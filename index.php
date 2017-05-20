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

$bloggerDB = new bloggerDB();

                  //Define a default route
                    $f3->route('GET /', function() {
                      $view = new View;
                      $member = new Member("", "", "", "", "");
                      
                      $_SESSION['member'] = $member;
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
                  
                                    //About us page of site
                  $f3->route('GET /aboutuslogin',
                   function(){
                    $view = new View;
                    echo $view->render('pages/aboutuslogin.html');
                   });
                  
                  //Login page
                  $f3->route('GET /login',
                   function(){
                    $view = new View;
                    echo $view->render('pages/login.html');
                   });
                  
                                    //Login page
                  $f3->route('POST /loginhome',
                   function($f3){
                    $userLogin = $_POST['email'];
                    $userPassword = $_POST['password'];
                    
                    $bloggerDB = new bloggerDB();
                    $member = new Member("", "", "", "", "");
                    //Grabs the row mathcing Email.
                    $members =  $bloggerDB->memberByEmail($userLogin);
                    $member = $_SESSION['member'];
                    
                    $member->setUsername($members['username']);
                    $member->setPassword($members['member_password']);
                    $member->setEmail($members['email']);
                    $member->setProfilePic($members['profile_pic']);
                    $member->setBio($members['bio']);
                    
                    $_SESSION['member'] = $member;
                    //Store the login user info for later
                    $_SESSION['id'] = $members['id'];
                    $_SESSION['username'] = $members['username'];
                    $_SESSION['email'] = $members['email'];
                    $_SESSION['member_password'] = $members['member_password'];
                    $_SESSION['bio'] = $members['bio'];
                    
                    if($GLOBALS['bloggerDB']->memberExists($userLogin, $userPassword)){
                      
                      $loginMember = $_SESSION['member'];
                      
                      echo Template::instance()->render('pages/loginhome.html');
                      echo 'Hello Id: '. $_SESSION['id'];
                      echo 'Hello username: '. $member->getUsername();
                      echo 'Hello email: '. $member->getEmail();
                      echo 'Hello password:' . $member->getPassword();
                      echo 'Hello profile pic: ' . $member->getProfilePic();
                      echo 'Hello bio:' . $member->getBio();
                      print_r($members);
                    }
                    
                    else{
                      $f3->reroute('/login');
                    }
                   });
                  
                                                      //Login page
                  $f3->route('GET /loginhome',
                   function($f3){

                       $member = $_SESSION['member'];
                      echo Template::instance()->render('pages/loginhome.html');
                       echo 'Hello Getting: '. $member->getUsername();
              
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
                    
                    //Created a member and stored in in a session variable called member
                    $member = new Member($username, $email, $memberPassword, $profilepic, $bio);  
                    $_SESSION['member'] = $member;
                    
                    $f3->set('username', $username);
                    $f3->set('email', $email);
                    $f3->set('password', $password);
                    $f3->set('bio', $bio);
                    
                    $GLOBALS['bloggerDB']->addMember($username, $email, $password, $profilepic, $bio);
                    echo Template::instance()->render('pages/create_new_member.php');
                    $f3->reroute('/login');
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