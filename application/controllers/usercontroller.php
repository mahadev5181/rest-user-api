<?php


class UserController extends Controller {
    
    
	function index($id = null){
	    switch ($this->get_request_method()) {
			case 'GET':
			 	$result = $this->User->get_user($id);
			 	$this->response($this->json($result,'Users List',200,1), 200);
			break;
		    case 'PUT':
				$result = $this->User->update_user($this->_request);
				echo json_encode($result);
			break;
			case 'POST':
				$result = $this->User->save_user($_POST);
				echo json_encode($result);
			break;
		    case 'DELETE':
				$result = $this->User->delete_user($this->_request);
				echo json_encode($result);
			break;
        }
		die;
	}
}
