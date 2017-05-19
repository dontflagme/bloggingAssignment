<?php
/**
 *@author: Kevin Nguyen
 *@version: 1.0
 *@date: 5.19.2017
 *This is for a Blog website. It takes in basic information of the new user to create an account
 */

    class Member
    {
        //vars
       protected $username;
       protected $email;
       protected $memberPassword;
       protected $profilepic;
       protected $bio;
       
       
        /**
        *@param $username - username
        *@param $email - email
        *@param $memberPassword - password
        *@param $profile_pic - path to the picture
        *@param $bio - user bio
        */
        function __construct($username, $email, $memberPassword, $profilepic, $bio)
        {
            $this->username = $username;
            $this->email = $email;
            $this->memberPassword = $memberPassword;
            $this->profilepic = $profilepic;
            $this->bio = $bio;

        }
        
        /**
         *@param - takes in a String first name
         */
        function setUsername($username)
            {
                $this->username = $username;
            }
    
            /**
             *@return returns the user first name
             */
            function getUsername()
            {
                return $this->username;
            }
            
                    /**
         *@param - takes in a String first name
         */
            function setEmail($email)
            {
                $this->email = $email;
            }
    
            /**
             *@return returns the user first name
             */
            function getEmail()
            {
                return $this->email;
            }
            
                    /**
         *@param - takes in a String first name
         */
            function setPassword($memberPassword)
            {
                $this->memberPassword = $memberPassword;
            }
    
            /**
             *@return returns the user first name
             */
            function getPassword()
            {
                return $this->memberPassword;
            }
            
                    /**
         *@param - takes in a String first name
         */
            function setPofilePic($profilepic)
            {
                $this->profilepic = $profilepic;
            }
    
            /**
             *@return returns the user first name
             */
            function getProfilePic()
            {
                return $this->$profile_pic;
            }
            
                    /**
         *@param - takes in a String first name
         */
            function setBio($bio)
            {
                $this->bio = $bio;
            }
    
            /**
             *@return returns the user first name
             */
            function getBio()
            {
                return $this->$bio;
            }
            
            
    }
?>