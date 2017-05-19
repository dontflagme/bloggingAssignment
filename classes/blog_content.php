<?php
/**
 *@author: Kevin Nguyen
 *@version: 1.0
 *@date: 5.19.2017
 *This is for a Blog website. It takes in basic blog information to create an account
 */

 class blogContent
 {
            //vars
       protected $memberid;
       protected $title;
       protected $blog_entry;
       protected $click_count;
       protected $deleted;
       
               /**
        *@param $username - username
        *@param $email - email
        *@param $memberPassword - password
        *@param $profile_pic - path to the picture
        *@param $bio - user bio
        */
        function __construct($memberid, $title, $blogentry, $clickcount, $deleted)
        {
            $this->memberid = $memberid;
            $this->title = $title;
            $this->blogentry = $blogentry;
            $this->click_count = $clickcount;
            $this->deleted = $deleted;

        }
        
        /**
         *@param - takes in a String first name
         */
        function setMemberid($memberid)
            {
                $this->memberid = $memberid;
            }
    
            /**
             *@return returns the user first name
             */
            function getMemberid()
            {
                return $this->memberid;
            }
            
       /**
         *@param - takes in a String first name
         */
        function setTitle($title)
            {
                $this->title = $title;
            }
    
            /**
             *@return returns the user first name
             */
            function getTitle()
            {
                return $this->title;
            }
            

            
       /**
         *@param - takes in a String first name
         */
            function setBlogEntry($blogentry)
            {
                $this->blogentry = $blogentry;
            }
    
            /**
             *@return returns the user first name
             */
            function getBlogentry()
            {
                return $this->blogentry;
            }
            
                   /**
         *@param - takes in a String first name
         */
            function setClickcount($clickcount)
            {
                $this->clickcount = $clickcount;
            }
    
            /**
             *@return returns the user first name
             */
            function getClickcount()
            {
                return $this->clickcount;
            }
            
                   /**
         *@param - takes in a String first name
         */
            function setDeleted($deleted)
            {
                $this->deleted = $deleted;
            }
    
            /**
             *@return returns the user first name
             */
            function getDeleted()
            {
                return $this->deleted;
            }
            
            
 }

?>