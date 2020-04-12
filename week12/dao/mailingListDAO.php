<?php
require_once ('abstractDAO.php');
require_once ('./model/mailingList.php');

class mailingListDao extends abstractDao {

  //establish connection to the db
  function __construct() {
    try{
      parent::__construct() ;
    } catch (mysqli_sql_exception $e){
      throw $e;
    }
  }

  //creates an array of all entries in the db as mailingList objects
  public function getMailingList(){
    //check for connection error
    if(!$this->mysqli->connect_errno){
      //query for all entries in the db
      $result = $this->mysqli->query('SELECT * FROM mailingList');
      //the array to be returned
      $mailingList = array();
      //if we have any rows create the array
      if($result->num_rows > 0){
        //run until we run out of rows
        while( $row = $result->fetch_assoc()){
          //create a mailingList based on the values in the row
          $entry = new mailingList($row['customerName'],$row['deletedCustomerNames'],$row['phoneNumber'],$row['emailAddress'],$row['referrer']);
          //add to array
          $mailingList[] = $entry;
        }
        //free up memeory from query
        $result->free();
        //return the filled list
        return $mailingList;
      }
      //free up memeory
      $result->free();
      //no entries so no list to return
      return false;
    }
  }

  //grabs the specific id from the database of a mailingList entry
  public function getID($entry){
    //check for connection error and null parameter
    if($entry != null && !$this->mysqli->connect_errno){
      //query that grabs an id from checking almost all fields(attempting to be more granular)
      $query = 'SELECT _id FROM mailingList WHERE customerName = ? AND emailAddress = ? AND phoneNumber = ?';
      $stmt = $this->mysqli->prepare($query);
      //store the values of the entry as to avoid calling directly from refrences
      $name = $entry->getName();
      $email = $entry->getEmail();
      $phone = $entry->getPhone();
      //put the stored values into the query
      $stmt->bind_param('sss',$name, $email, $phone);
      //run it
      $stmt->execute();
      //get our results
      $result = $stmt->get_result();
      //we only want 1 result for this specific id(if there are more we have entires with duplicate values...not good)
      if($result->num_rows == 1){
        //get the row
        $row = $result->fetch_assoc();
        //grab the id
        $id = $row['_id'];
        //free up memory from the query
        $result->free();
        //return this id
        return $id;
      }
      //if it errors free up memory and return false
      $result->free();
      return false;
    }
  }

  //get a specific entry grabbed from an id
  public function getEntry($id){
    //check for connection error and null parameter
    if($id != null && !$this->mysqli->connect_errno){
      //grab the row tied to that speicfic id
      $query = 'SELECT * FROM mailingList WHERE _id = ?';
      //ready the sql for execution
      $stmt = $this->mysqli->prepare($query);
      //bind the id for the query
      $stmt->bind_param('i',$id);
      //run it
      $stmt->execute();
      //store the result
      $result = $stmt->get_result();
      //we only want 1 row, any more means there are two rows with the same id which should not be possible
      if($result->num_rows == 1){
        //store the row
        $row = $result->fetch_assoc();
        //create an object with the fields grabbed from the row
        $entry = new mailingList($row['customerName'],$row['deletedCustomerNames'],$row['phoneNumber'],$row['emailAddress'],$row['referrer']);
        //free the memory from the query
        $result->free();
        //return the newly created object
        return $entry;
      }
      //even if something goes wrong free the memory from the query
      $result->free();
      //return false to be handled by the calling class.
      return false;
    }
  }

  //add a new row to the database from a created object that has input from the user
  public function addEntry($entry){
    //check for null parameter or connection error
    if($entry != null && !$this->mysqli->connect_errno){
      //query to be used to insert the values into the database
      $query = 'INSERT INTO mailingList (customerName,deletedCustomerNames,phoneNumber,emailAddress,referrer) values (?,?,?,?,?)';
      //prepare for execution
      $stmt = $this->mysqli->prepare($query);
      //store the values into variables so we dont attempt to pass refrences to the query
      $name=$entry->getName();
      $phone=$entry->getPhone();
      $email=$entry->getEmail();
      $deleted = '';
      $referrer=$entry->getReferrer();
      //bind the values to be used with the query
      $stmt->bind_param('sssss',$name,$deleted,$phone,$email,$referrer);
      //execute the compeleted query
      $stmt->execute();
      //if we cant add it in for any reason return the error to ba handled
      if($stmt->error){
        return $stmt->error;
      }else {
        //return an html formatted string so we can display a message to the user that it worked
        return '<span style=\'color:red\'>' . $entry->getName().' signed up successfully' . '</span>';
      }
    }
    //return false if there are errors
    return false;
  }

  //check if the given email is already stored in the db
  public function checkDuplicateEmail($emailAddress){
    //check for error messgae
    if(!$this->mysqli->connect_errno){
      //grab all entries email address
      $result = $this->mysqli->query('SELECT emailAddress FROM mailingList');
      //arrray to hold all stored emails
      $email = array();
      //only care if we have any entries to parse
      if($result->num_rows > 0){
        //loop for every row grabbed
        while( $row = $result->fetch_assoc()){
          //store each email from each queried row
          $email[] = $row['emailAddress'];
        }
        //free the memory from the query
        $result->free();
      }
      //loop through the array
      for ($i = 0; $i < count($email); $i++) {
        //compare the parameter against the iterated $entry
        //if its > 0 || < 0 they dont match so we only care for 0
        if(strcmp($emailAddress, $email[$i]) == 0){
          //yes it does match so return true
          return true;
        }
      }
      //no matches return false
      return false;
    }
  }
  //updates an entry and sets the proper column with the formatted text the indicate that the record is deleted
  public function deleteEntry($entry,$id){
    if($entry != null && !$this->mysqli->connect_errno){
      $query = 'UPDATE mailingList SET deletedCustomerNames = ? WHERE _id = ?';
      $stmt = $this->mysqli->prepare($query);
      $name=$entry->getName();
      $temp = $id;
      $phone=$entry->getPhone();
      $email=$entry->getEmail();
      $concatString = $name.','.$phone.','.$email;
      $stmt->bind_param('si',$concatString,$temp);
      $stmt->execute();
      if($stmt->error){
        return $stmt->error;
      }else {
        return true;
      }
    }
    return false;
  }
}
