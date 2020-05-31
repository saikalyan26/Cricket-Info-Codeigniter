<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Players extends CI_Controller {

	function __construct() {
	    parent::__construct();	
	    $this->load->model('cricket_model', 'cricket');
	}
	/*********************************************************
	* player_info 
	* loads the plaer info view with data
	**********************************************************/
	public function player_info($team_id,$player_id)
	{
		$data['player_info'] 	=	$this->cricket->get_player_info($team_id,$player_id);		
		$this->load->view('cricket_player_info', $data);
	}
	
}
