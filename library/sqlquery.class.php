<?php

class SQLQuery { 

    protected $_dbHandle;
    protected $_result;

    /*
        Function: connect 
        Purpose : Connects to database 
    */
    function connect($address, $account, $pwd, $name) {
        $this->_dbHandle = @mysqli_connect($address, $account, $pwd,$name);
        if ($this->_dbHandle) {
            return 1;
        }
        else {
            return 0;
        }
    }
    
    function selectAll() {
    	$query = 'select * from `'.$this->_table.'`';
    	return $this->query($query);
    }
    function select($id) {
    	$query = 'select * from `'.$this->_table.'` where `id` = '.$id;
    	return $this->query($query);    
    }
    /*
        Function : query
        Purpose : to run mysql query
        Parameter : mysql query string 
        Return : mysql query result
    */
	function query($query) {
		$this->_result = mysqli_query($this->_dbHandle,$query);
        $result = array();
        while ($row = mysqli_fetch_assoc($this->_result)) {
            $result[] = $row;
        }
        $this->freeResult();
        return($result);
	}
    /*
        Function : deleteRecord
        Purpose : to delete record
        Parameter : $id - id of the record to be deleted
        Return : dataset
    */
    function deleteRecord($id){
        $query = 'DELETE from `'.$this->_table.'` WHERE id = '.$id;
        $result = mysqli_query($this->_dbHandle,$query);
        if ($result) {
            return array(
            "success" => "1",
            "message" => "Records deleted successfully",
            );
        } else {
            return array(
            "success" => "0",
            "message" => "Unable to delete the record",
            );
        }
    }
    /*
        Function : insertRecord
        Purpose : to insert record in database
        Parameter : $data - record data array
        Return : array of success
    */
    function insertRecord($data){
        $name = htmlspecialchars($data['name']);
        $email = htmlspecialchars($data['email']);
        $password = htmlspecialchars($data['password']);
        $address = !empty($data['address']) ? htmlspecialchars($data['address']) : ''; 
        $role = !empty($data['role']) ? htmlspecialchars($data['role']) : '2'; 
        $query = 'INSERT INTO `'.$this->_table.'` (name,email,password,address,role) VALUES ("'.$name.'","'.$email.'","'.md5($password).'","'.$address.'","'.$role.'")';
        $res = mysqli_query($this->_dbHandle,$query);
        if ($res) {
            return array(
            "success" => "1",
            "message" => "Record inserted successfully",
            );
        } else {
            return array(
            "success" => "0",
            "message" => "Unable to insert record",
            );
        }
    }
    /*
        Function : updateRecord
        Purpose : to insert record in database
        Parameter : $data - record data array
        Return : array of success
    */
    function updateRecord($data){
        $userID = htmlspecialchars($data['userID']);
        $name = htmlspecialchars($data['name']);
        $email = htmlspecialchars($data['email']);
        $address = !empty($data['address']) ? htmlspecialchars($data['address']) : ''; 
        $role = !empty($data['role']) ? htmlspecialchars($data['role']) : '2'; 
        $query = 'UPDATE `'.$this->_table.'` SET name = "'.$name.'",email = "'.$email.'",address = "'.$address.'",role = "'.$role.'" WHERE id= '.$userID;
        $res = mysqli_query($this->_dbHandle,$query);
        if ($res) {
            return array(
            "success" => "1",
            "message" => "Record updated successfully",
            );
        } else {
            return array(
            "success" => "0",
            "message" => "Unable to update record",
            );
        }
    }
    /*
        Function : getNumRows
        Purpose :  to get the number of rows
        Return : number of rows affected
    */
    function getNumRows() {
        return mysqli_num_rows($this->_result);
    }
    /*
        Function : freeResult
        Purpose : to free resources allocated by a query
    */
    function freeResult() {
        mysqli_free_result($this->_result);
    }
    /*
        Function getError
        Purpose : to get teh mysqli connect error string
    */
    function getError() {
        return mysqli_error($this->_dbHandle);
    }
}
