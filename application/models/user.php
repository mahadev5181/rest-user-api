<?php

class User extends Model {

    function save_user($data) { 
    	$save_result = $this->insertRecord($data);
		return json_encode($save_result);
    }

    function update_user($data) {

    	$save_result = $this->updateRecord($data);
		return json_encode($save_result);
    }

    function delete_user($data) { 
		$id = intval($data['userID']);
		$delete_result = $this->deleteRecord($id);
		return json_encode($delete_result);
    }
    /*
		Function : get_user
		Purpose : to get the user details
		Parameter :  $id - user id
		Return : user json data
    */
    function get_user($id) {
    	if (isset($id) && $id > 0) {
	    	$users = $this->select($id);
		}else{
			$users = $this->selectAll();
		}
		return $users;
		//$this->response($this->json($users,'Users List',200,1), 200);
		//return json_encode($rows);
    }

}
