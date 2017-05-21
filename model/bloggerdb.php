<?php
    /**
     * Provides CRUD access to pet names in our database
     *
     * PHP Version 5
     *
     * @author Kevin Nguyen
     * @version 1.0
     */
 
 /**
  *   CREATE TABLE blog_members(
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    member_password VARCHAR(50) NOT NULL,
    profile_pic VARCHAR(100),
    bio VARCHAR(500)
    );

INSERT INTO blog_members
(username, email, member_password, profile_pic, bio)
VALUES
('UberMunchPunch', 'Kevin.Nguyen0509@gmail.com', '1234', 'img/img.png', 'this is the bio');


CREATE TABLE blog_content(
    id INTEGER AUTO_INCREMENT PRIMARY KEY NOT NULL,
    member_id int NOT NULL,
    title VARCHAR(100) NOT NULL,
    blog_content VARCHAR(500) NOT NULL,
    date_added TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    click_count int NOT NULL DEFAULT 0,
    isDeleted int NOT NULL DEFAULT 1
    );

INSERT INTO blog_content
(member_id, title, blog_content, click_count, isDeleted)
VALUES
(2, 'se
  */

    //CONNECT
    class bloggerDB
    {
        private $_pdo;
        
        function __construct()
        {
            //Require configuration file
            require_once '/home/knguyen/config.php';
            
            try {
                //Establish database connection
                $this->_pdo = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
                
                //Keep the connection open for reuse to improve performance
                $this->_pdo->setAttribute( PDO::ATTR_PERSISTENT, true);
                
                //Throw an exception whenever a database error occurs
                $this->_pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            }
            catch (PDOException $e) {
                die( "Error!: " . $e->getMessage());
            }
        }
        
         
        //CREATE
         
        /**
         * Adds a pet to the collection of pets in the db.
         *
         * @access public
         * @param string $name the name of the pet
         * @param string $type the type of pet (giraffe, turtle, bear, ...)
         * @param string $color the color of the animal
         *
         * @return true if the insert was successful, otherwise false
         */
        function addMember($username, $email, $password, $profilepic, $bio)
        {
            $insert = 'INSERT INTO blog_members (username, email, member_password, profile_pic, bio) VALUES (:username, :email, :password, :profilepic, :bio)';
             
            $statement = $this->_pdo->prepare($insert);
            $statement->bindValue(':username', $username, PDO::PARAM_STR);
            $statement->bindValue(':email', $email, PDO::PARAM_STR);
            $statement->bindValue(':password', $password, PDO::PARAM_STR);
            $statement->bindValue(':profilepic', $profilepic, PDO::PARAM_STR);
            $statement->bindValue(':bio', $bio, PDO::PARAM_STR);            
            $statement->execute();
            
            //Return ID of inserted row
            return $this->_pdo->lastInsertId();
        }
        
        
                /**
         * Adds a pet to the collection of pets in the db.
         *
         * @access public
         * @param string $name the name of the pet
         * @param string $type the type of pet (giraffe, turtle, bear, ...)
         * @param string $color the color of the animal
         *
         * @return true if the insert was successful, otherwise false
         */
        function addBlog($memberid, $title, $blogcontent, $clickcount, $isDeleted)
        {
            $insert = 'INSERT INTO blog_content (member_id, title, blog_content, click_count, isDeleted) VALUES (:member_id, :title, :blogcontent, :clickcount, :isDeleted)';
             
            $statement = $this->_pdo->prepare($insert);
            $statement->bindValue(':member_id', $memberid, PDO::PARAM_STR);
            $statement->bindValue(':title', $title, PDO::PARAM_STR);
            $statement->bindValue(':blogcontent', $blogcontent, PDO::PARAM_STR);
            $statement->bindValue(':clickcount', $clickcount, PDO::PARAM_STR);
            $statement->bindValue(':isDeleted', $isDeleted, PDO::PARAM_STR);            
            $statement->execute();
            
            //Return ID of inserted row
            return $this->_pdo->lastInsertId();
        }
         
        //READ
        /**
         * Returns all pets in the database collection.
         *
         * @access public
         *
         * @return an associative array of pets indexed by id
         */
        function allMembers()
        {
            $select = 'SELECT member_id, fname, lname, age, gender, phone, email, state, seeking, bio, premium, image, interests FROM members ORDER BY lname';
            $results = $this->_pdo->query($select);
            
             
            $resultsArray = array();
             
            //map each pet id to a row of data for that pet
            while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
                $resultsArray[$row['member_id']] = $row;
            }
             
            return $resultsArray;
        }
        
                //READ
        /**
         * Returns all pets in the database collection.
         *
         * @access public
         *
         * @return an associative array of pets indexed by id
         */
        function allUserBlogs($id)
        {
            $select = "SELECT id, member_id, title, blog_content, click_count, isDeleted FROM blog_content WHERE member_id = $id";
            $results = $this->_pdo->query($select);
            
             
            $resultsArray = array();
             
            //map each pet id to a row of data for that pet
            while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
                $resultsArray[$row['id']] = $row;
            }
             
            return $resultsArray;
        }
         
        /**
         * Returns a pet that has the given id.
         *
         * @access public
         * @param int $id the id of the pet
         *
         * @return an associative array of pet attributes, or false if
         * the pet was not found
         */
        function blogById($id)
        {
            
            $select = 'SELECT id, member_id, title, blog_content, click_count, isDeleted FROM blog_content WHERE id=:id';
             
            $statement = $this->_pdo->prepare($select);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->execute();
             
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
        
                /**
         * Returns a pet that has the given id.
         *
         * @access public
         * @param int $id the id of the pet
         *
         * @return an associative array of pet attributes, or false if
         * the pet was not found
         */
        function updateblogById($id, $title, $blogEntry)
        {
            
            $update = "UPDATE blog_content SET title=:title, blog_content=:blogEntry WHERE id=:id";
             
            $statement = $this->_pdo->prepare($update);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->bindValue(':title', $title, PDO::PARAM_STR);
            $statement->bindValue(':blogEntry', $blogEntry, PDO::PARAM_STR);

             
            $statement->execute();
             
           // return $statement->fetch(PDO::FETCH_ASSOC);
        }
        
             //UPDATE
      
         /**
         * Updates the attributes for a pet in the database.
         *
         * @access public
         * @param int $id the id of the pet
         * @param string $name the name of the pet
         * @param string $type the type of pet (giraffe, turtle, bear, ...)
         * @param string $color the color of the animal
         */  
        function updatePet($id, $name, $type, $color)
        {          
            $update = 'UPDATE pets SET name=:name, type=:type, color=:color
                                   WHERE id=:id';
             
            $statement = $this->_pdo->prepare($update);
            $statement->bindValue(':name', $name, PDO::PARAM_STR);
            $statement->bindValue(':type', $type, PDO::PARAM_STR);
            $statement->bindValue(':color', $color, PDO::PARAM_STR);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
             
            $statement->execute();
        }
        
               /**
         * Returns a pet that has the given id.
         *
         * @access public
         * @param int $id the id of the pet
         *
         * @return an associative array of pet attributes, or false if
         * the pet was not found
         */
        function memberByEmail($email)
        {
            $select = 'SELECT id, username, email, member_password, profile_pic, bio FROM blog_members WHERE email=:email';
             
            $statement = $this->_pdo->prepare($select);
            $statement->bindValue(':email', $email, PDO::PARAM_INT);
            $statement->execute();
             
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
         
        /**
         * Returns true if the name is used by a pet in the database.
         *
         * @access public
         * @param string $name the name of the pet to look for
         *
         * @return true if the name already exists, otherwise false
         */   
        function memberExists($email, $password)
        {            
            $select = 'SELECT id, username, email, member_password, profile_pic, bio FROM blog_members WHERE email=:email && member_password=:password';
             
            $statement = $this->_pdo->prepare($select);
            $statement->bindValue(':email', $email, PDO::PARAM_STR);
            $statement->bindValue(':password', $password, PDO::PARAM_STR);
            $statement->execute();
             
            $row = $statement->fetch(PDO::FETCH_ASSOC);
             
            return !empty($row);
        }
         
   
         
        //DELETE
         
        /**
         * Deletes the pet associated with the input id.
         *
         * @access public
         * @param int $id the id of the pet
         *
         * @return true if the delete was successful, otherwise false
         */
        function deleteBlog($id)
        {        
            $delete = 'DELETE FROM blog_content WHERE id=:id';
             
            $statement = $this->_pdo->prepare($delete);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
             
            return $statement->execute();
        }
    }