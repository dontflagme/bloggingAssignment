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
  *    sql statement: dating

        CREATE TABLE members(
            member_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            fname VARCHAR(15),
            lname VARCHAR(20),
            age int,
            gender VARCHAR(10),
            phone int,
            email VARCHAR(30),
            state VARCHAR(50),
            seeking VARCHAR(15),
            bio VARCHAR(255),
            premium int(1),
            image VARCHAR(500),
            interests VARCHAR(500)
        );


INSERT INTO members(fname, lname, age, gender, phone, email, state, seeking, bio, premium, image, interests)
VALUES("Kevin", "Nguyen", 24,"Male", 2068504170, "Kevin.Nguyen@gmail.com", "Washington", "Female", "This is just the test bio", 0, "image/testimage.png", "hiking, Banana boating, ape hunting, plane flying, banana boats");
    
  */

    //CONNECT
    class DatingDB
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
        function addMember($fname, $lname, $age, $gender, $phone, $email, $state, $seeking, $bio, $premium, $image, $interests)
        {
            $insert = 'INSERT INTO members (fname, lname, age, gender, phone, email, state, seeking, bio, premium, image, interests) VALUES (:fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium, :image, :interests)';
             
            $statement = $this->_pdo->prepare($insert);
            $statement->bindValue(':fname', $fname, PDO::PARAM_STR);
            $statement->bindValue(':lname', $lname, PDO::PARAM_STR);
            $statement->bindValue(':age', $age, PDO::PARAM_STR);
            $statement->bindValue(':gender', $gender, PDO::PARAM_STR);
            $statement->bindValue(':phone', $phone, PDO::PARAM_STR);
            $statement->bindValue(':email', $email, PDO::PARAM_STR);
            $statement->bindValue(':state', $state, PDO::PARAM_STR);
            $statement->bindValue(':seeking', $seeking, PDO::PARAM_STR);
            $statement->bindValue(':bio', $bio, PDO::PARAM_STR);
            $statement->bindValue(':premium', $premium, PDO::PARAM_STR);
            $statement->bindValue(':image', $image, PDO::PARAM_STR);
            $statement->bindValue(':interests', $interests, PDO::PARAM_STR);
            
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
         
        /**
         * Returns a pet that has the given id.
         *
         * @access public
         * @param int $id the id of the pet
         *
         * @return an associative array of pet attributes, or false if
         * the pet was not found
         */
        function petById($id)
        {
            $select = 'SELECT id, name, type, color FROM pets WHERE id=:id';
             
            $statement = $this->_pdo->prepare($select);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
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
        function petNameExists($name)
        {            
            $select = 'SELECT id, name, type, color FROM pets WHERE name=:name';
             
            $statement = $this->_pdo->prepare($select);
            $statement->bindValue(':name', $name, PDO::PARAM_STR);
            $statement->execute();
             
            $row = $statement->fetch(PDO::FETCH_ASSOC);
             
            return !empty($row);
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
         
        //DELETE
         
        /**
         * Deletes the pet associated with the input id.
         *
         * @access public
         * @param int $id the id of the pet
         *
         * @return true if the delete was successful, otherwise false
         */
        function deletePet($id)
        {        
            $delete = 'DELETE FROM pets WHERE id=:id';
             
            $statement = $this->_pdo->prepare($delete);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
             
            return $statement->execute();
        }
    }