<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cricket extends CI_Controller {
	function __construct() {
	    parent::__construct();	
	    $this->load->model('cricket_model', 'cricket');
	}
	

	/*********************************************************
	*matches_list
	* function returns the list of scheduled matches to view -
	**********************************************************/
	public function matches_list()
	{		
		$offset 				= $this->input->post('offset') == "" ? 0 : $this->input->post('offset');		
		$data['matches_list'] 	=	$matches_list = $this->cricket->get_matches_list($limit=5,$offset);	
		$data['teams_list'] 	=	$this->cricket->get_teams_list();
		
		$get_matches_count 		= $this->cricket->get_matches_count();		
		$data['start'] 			= ($offset) ? $offset : 0;
		$data['end'] 			= ($get_matches_count > $offset) ? $offset+5 : $offset;
		$data['get_matches_count'] = $get_matches_count;

		$this->load->view('cricket_matches_list_view', $data);
		//here the sori
	}

	/*********************************************************
	*get_match_info
	* function returns the selected match info 
	**********************************************************/
	public function get_match_info($match_id)
	{
		$data['match_info'] 		=	$match_info = $this->cricket->get_match_info($match_id);				
		$data['players_list_one']	=	$this->cricket->get_player_list($match_info->team_one,$match_id);
		$data['players_list_two']	=	$this->cricket->get_player_list($match_info->team_two,$match_id);
		$data['match_info']->team_one_score = $this->sum_from_ary($data['players_list_one'], 'score');
		$data['match_info']->team_two_score = $this->sum_from_ary($data['players_list_two'], 'score');
		$data['match_info']->team_one_wickets = $this->get_wickets_from_list($data['players_list_one'], 'wicket_by');
		$data['match_info']->team_two_wickets = $this->get_wickets_from_list($data['players_list_two'], 'wicket_by');
		$this->load->view('cricket_points_view', $data);
	}
	
	/*********************************************************
	*sum_from_ary
	* returns sum of array with specified field from multi dimentional array
	**********************************************************/
	function sum_from_ary($players_list_one, $sumDetail)
	{
		$team_one_score = array_reduce($players_list_one,
		           function($runningTotal, $record) use($sumDetail) {
		               $runningTotal += $record[$sumDetail];
		               return $runningTotal;
		           },
		           0
		);
		return $team_one_score;
	}

	/*********************************************************
	*get_wickets_from_list
	* custom logic for getting value from multi-dementional arary
	**********************************************************/
	function get_wickets_from_list($players_list_one, $sumDetail)
	{		
		$team_one_score = array_reduce($players_list_one,
		           function($runningTotal, $record) use($sumDetail) {		           	
		               if($record[$sumDetail]) $runningTotal += 1;
		               else $runningTotal;

		               return $runningTotal;
		           },
		           0
		);
		return $team_one_score;
	}
	/********************************END*************************/
}
