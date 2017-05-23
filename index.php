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
                    $f3->route('GET /', function($f3) {
                      $view = new View;
                      $member = new Member("", "", "", "", "");
                      
                      $_SESSION['member'] = $member;
                      
                      $recentBlog = $GLOBALS['bloggerDB']-> mostRecentBlogAll();
                       
                        //$recentBlog = $GLOBALS['bloggerDB']->recentBlogById($eachBlog['id']);
                       //$f3->set('blogContent', $eachBlog['id']);
                       $f3->set('blogDB', $recentBlog);

                      echo Template::instance()->render('pages/home.html');
                     }
                   );
                    
                  //views all blogs of one member
                  $f3->route('GET /viewBlog',
                   function($f3){
                    
                    $id=$_GET['member_id'];
                   
                    //$GLOBALS['bloggerDB']
                    $allUserBlogs = $GLOBALS['bloggerDB']->allUserBlogsById($id);
                     $allUserMember = $GLOBALS['bloggerDB']->memberById($id);
                     $recentBlog = $GLOBALS['bloggerDB']->recentBlogById($id);
                     
                     
                      //$blogCount = $GLOBALS['bloggerDB']->countBlogs($id);
                    $f3->set('bloggerDB', $allUserBlogs);
                    $f3->set('username', $allUserMember['username']);
                    $f3->set('bio', $allUserMember['bio']);
                    
                    $f3->set('recentBlog', $recentBlog[$id]['blog_content']);

                     echo Template::instance()->render('pages/viewblog.php');
                    // echo $recentBlog['blog_content'];
                    //print_r($recentBlog);
                   // echo str_word_count($recentBlog[$id]['blog_content']);
                   });
                  
                                    //views all blogs of one member
                  $f3->route('GET /viewBloglogin',
                   function($f3){
                    
                    $id=$_GET['member_id'];
                   
                    //$GLOBALS['bloggerDB']
                    $allUserBlogs = $GLOBALS['bloggerDB']->allUserBlogsById($id);
                     $allUserMember = $GLOBALS['bloggerDB']->memberById($id);
                     $recentBlog = $GLOBALS['bloggerDB']->recentBlogById($id);
                     
                     
                      $blogCount = $GLOBALS['bloggerDB']->countBlogs($id);
                    $f3->set('bloggerDB', $allUserBlogs);
                    $f3->set('username', $allUserMember['username']);
                    $f3->set('bio', $allUserMember['bio']);
                    
                    $f3->set('recentBlog', $recentBlog[$id]['blog_content']);

                     echo Template::instance()->render('pages/viewbloglogin.php');
                    // echo $recentBlog['blog_content'];
                    //print_r($recentBlog);
                    echo str_word_count($recentBlog[$id]['blog_content']);
                   });
                  
                  //Read the full content of the blog.
                  $f3->route('GET /fullblog',
                   function($f3){
                   $blogId = $_GET['id'];

                   $blogDB = $GLOBALS['bloggerDB']->blogById($blogId);
                   $title = $blogDB['title'];
                   $content = $blogDB['blog_content'];
                   
                   
                   
                   $f3->set('title', $title);
                   $f3->set('content', $content);
                    echo Template::instance()->render('pages/fullblog.html');
                   });
                  
                                    //Read the full content of the blog.
                  $f3->route('GET /fullbloglogin',
                   function($f3){
                   $blogId = $_GET['id'];

                   $blogDB = $GLOBALS['bloggerDB']->blogById($blogId);
                   $title = $blogDB['title'];
                   $content = $blogDB['blog_content'];
                   
                   
                   
                   $f3->set('title', $title);
                   $f3->set('content', $content);
                    echo Template::instance()->render('pages/fullbloglogin.php');
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
                      //print_r($members);
                      $f3->reroute('/loginhome');
                    }
                    
                    else{
                      $f3->reroute('/loginhome');
                    }
                   });
                  
                                                      //Login page
                  $f3->route('GET /loginhome',
                   function($f3){

                       $member = $_SESSION['member'];
                       $recentBlog = $GLOBALS['bloggerDB']-> mostRecentBlogAll();
                       
                        //$recentBlog = $GLOBALS['bloggerDB']->recentBlogById($eachBlog['id']);
                       //$f3->set('blogContent', $eachBlog['id']);
                       $f3->set('blogDB', $recentBlog);
                      echo Template::instance()->render('pages/loginhome.html');
                       //echo 'Hello Getting: '. $eachBlog['id'];
                      // print_r($recentBlog);
              
                   });
                  
                  $f3->route('GET /logOut',
                   function($f3){

                       //session_destroy();
                       $f3->reroute('/login');
                       //echo 'Hello Getting: '. $eachBlog['id'];
                       //print_r($eachBlog);
              
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
                  
                 //Creating  a blog to the database.
                  $f3->route('POST /creatingProcess',
                   function($f3){
                    
                    $currentUser = $_SESSION['member'];
                    $currenUserID = $_SESSION['id'];
                    
                    $_SESSION['title'] = $_POST['title'];
                    $_SESSION['blogEntry'] = $_POST['blogEntry'];
                    
                    $title = $_SESSION['title'];
                    $blogentry = $_SESSION['blogEntry'];
                    
                    $blogContent = new blogContent($currenUserID, $title, $blogentry, 0, 1);
                    $GLOBALS['bloggerDB']->addBlog($currenUserID, $title, $blogentry, 0, 1);
                    $view = new View;
                    echo $view->render('pages/creatingProcess.php');
                    $f3->reroute('/myblogs');
                   });
                  
                  //Updates a specific blog
                  $f3->route('GET /updateblog',
                   function($f3, $params){
                    
                   $bloggingId = $_GET['id'];
                   $currentBlog = $GLOBALS['bloggerDB']->blogById($bloggingId);
                   
                   $title = $currentBlog['title'];
                   $blogentry = $currentBlog['blog_content'];
                    
                    $f3->set('title', $title);
                    $f3->set('blogEntry', $blogentry);
                    
                    
                    $_SESSION['updateBlogId'] = $bloggingId;
                    echo Template::instance()->render('pages/updateblog.php');
                    echo $bloggingId;
                   });
                  
                                    //Updates a specific blog
                  $f3->route('GET /delete',
                   function($f3, $params){
                    
                   $bloggingId = $_GET['id'];
                   $currentBlog = $GLOBALS['bloggerDB']->deleteBlog($bloggingId);
                   

                    $f3->reroute('/myblogs');
                   });
                  
                  
                                    //Updates a specific blog
                  $f3->route('POST /updateblogprocess',
                   function($f3, $params){
                    
                   $id = $_SESSION['updateBlogId'];
                   $currentBlog = $GLOBALS['bloggerDB']->blogById($bloggingId);
                   
                   $title = $_POST['title'];
                   $blogEntry = $_POST['blogEntry'];
                   
                   $GLOBALS['bloggerDB']->updateblogById($id, $title, $blogEntry);
                    
                    
                      $f3->reroute('/myblogs');
                     
                   });
                  
   
                  
                  //Shows the blogs you can update or delete
                   $f3->route('GET /myblogs',
                   function($f3){
                    $id = $_SESSION['id'];
                    $bio = $_SESSION['bio'];
                    $username = $_SESSION['username'];
                    
                    $blogsDB = $GLOBALS['bloggerDB']->allUserBlogs($id);
                    
                    $f3->set('blogs',  $blogsDB);
                    $f3->set('bio', $bio);
                    $f3->set('username', $username);
                    
                    echo Template::instance()->render('pages/myblogs.html');
                    //print_r($blogsDB);
                   });
$f3->run();        
?>