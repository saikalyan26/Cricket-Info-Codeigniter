<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teams extends CI_Controller {
	
	function __construct() {
	    parent::__construct();	
	    $this->load->model('cricket_model', 'cricket');
	    $this->load->model('Team_model', 'teams');
	    
	}

	/*********************************************************
	* home 
	* intial load page , it shows list of teams along with team captain
	**********************************************************/
	public function home()
	{
		$data['teams_list'] 	=	$this->cricket->get_teams_list();
		$this->load->view('cricket_home_view', $data);
	}

	/*********************************************************
	* team_info 
	* its returns the team info along with all team plaers list
	**********************************************************/
	public function team_info($team_id)
	{
		$data['team_info'] 	=	$this->cricket->get_players_list($team_id);
		$this->load->view('cricket_team_info', $data);
	}
	
	/*********************************************************
	* add_team_info 
	* add new team to teams table-
	**********************************************************/
	public function add_team_info()
	{
		$name = $this->input->post('in_team_name');
		$action = $this->input->post('action');
		$msg 	=	['type' => false, 'message' => "Something went wrong please try again."];

		if($action == 'add_team' && $name != ""){
			$name 	=	addslashes(trim($name));
			$check_team = $this->teams->check_team($name);
			if(!$check_team){
				if(isset($_FILES['in_team_logo'])){
					$file_name = 'team_'.time() . "." . pathinfo($_FILES['in_team_logo']['name'], PATHINFO_EXTENSION);
					$config['upload_path'] = FCPATH.'assets/uploads/team_logo/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size'] = '1000';
					// $config['max_width'] = '50';
					// $config['max_height'] = '50';
					$config['file_name'] = $file_name;
					$config['overwrite'] = true;

					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if (!$this->upload->do_upload('in_team_logo')) {
						$msg 	=	['type' => false, 'message' => $this->upload->display_errors() ];
					} else {
					  $data = $this->upload->data();
					  
					  $insert_ary = ['team_logo' => $file_name, 'team_name' => $name];
					  $check_team = $this->teams->create_team($insert_ary);
					  if($check_team){
					  	$msg 	=	['type' => true, 'message' => "Team created successfully"];
					  }else{
					  	$msg 	=	['type' => false, 'message' => "Something went wrong!"];
					  }
					}
				}else
					$msg 	=	['type' => false, 'message' => "Logo required."];
			}else{
				$msg 	=	['type' => false, 'message' => "Team name exists!"];
			}
		}

		echo  json_encode($msg);die;
	}

	/*********************************************************
	* add_player_info 
	* add new team player  to players table-
	**********************************************************/
	public function add_player_info()
	{		
		$action = $this->input->post('action');
		$msg 	=	['type' => false, 'message' => "Something went wrong please try again."];
		if($action == 'add_player'){
			$fname = $this->input->post('in_first_name');
			$lname = $this->input->post('in_last_name');
			$jno = $this->input->post('in_jersey_number');


			if($fname != "" && $lname != "" && $jno != ""){
				$ch = $this->input->post('in_captain') == "" ? 0 : 1;
				$insert_ary = [
							'first_name' 	=> 	addslashes(trim($fname)),
							'last_name' 	=>	addslashes(trim($lname)),
							'avatar' 		=> 'default_avatar.png',
							'player_type' 	=> (int) $this->input->post('in_player_type'),
							'is_captain' 	=> $ch,
							'jersey_number' => (int) $jno,
							'country' 		=> addslashes(trim($this->input->post('in_player_type'))),
							'team_id_fk' 	=> $this->input->post('hidd_team_id'),
						];
				$done = $this->teams->create_player($insert_ary);

				if($done){
					$msg 	=	['type' => true, 'message' => 'Created player successfully.' ];
					if(isset($_FILES['in_player_logo'])){
						$file_name = 'team_'.time() . "." . pathinfo($_FILES['in_team_logo']['name'], PATHINFO_EXTENSION);
						$config['upload_path'] = FCPATH.'assets/uploads/player_logo/';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_size'] = '1000';
						// $config['max_width'] = '50';
						// $config['max_height'] = '50';
						$config['file_name'] = $file_name;
						$config['overwrite'] = true;

						$this->load->library('upload', $config);
						$this->upload->initialize($config);

						if (!$this->upload->do_upload('in_team_logo')) {

							$msg 	=	['type' => false, 'message' => $this->upload->display_errors() ];
						} else {
						  $data = $this->upload->data();
						  $this->teams->update_player($done, ['avatar' => $file_name]);
						  $msg 	=	['type' => true, 'message' => 'Created player successfully.' ];
						}
					}
				}else{
					$msg 	=	['type' => false, 'message' => "Something went wrong!"];
				}


			}else{
				$msg 	=	['type' => false, 'message' => "Required fields moissing."];
			}
		}
		echo  json_encode($msg);die;
	}

	/*********************************************************
	* add_match_info 
	* add new match   to matches table- 
	**********************************************************/
	public function add_match_info()
	{
		$action = $this->input->post('action');
		$msg 	=	['type' => false, 'message' => "Something went wrong please try again."];
		if($action == 'add_match'){
			$team1 = $this->input->post('in_team_one') == "" ? 0 : $this->input->post('in_team_one');
			$team2 = $this->input->post('in_team_two') == "" ? 0 : $this->input->post('in_team_two');
			$pdate = $this->input->post('play_at');

			if($team1 != $team2 && $team1 > 0 && $team2 > 0){
				$play = date('Y-m-d H:i:s');
				$pdate =str_replace('\/', '/', $pdate);

				if($pdate != ""){
					 $play = DateTime::createFromFormat('Y-m-d H:i:s', $pdate);					
				}
				$insert_ary = [
								'team_one' => $team1,
								'team_two' => $team2,
								'play_at'  => $play
							];

				$done = $this->teams->create_match($insert_ary);
				if($done){
					$msg 	=	['type' => true, 'message' => 'Match created successfully.' ];
				}else{
					$msg 	=	['type' => false, 'message' => "Something went wrong!"];
				}

			}else{
				$msg 	=	['type' => false, 'message' => ($team1 <= 0 || $team2 <= 0) ? "Select teams!" : "Should be two teams are different. "];
			}
		}
		echo  json_encode($msg);die;
	}

	/*********************************************************
	* update_match_info 
	* chnage match status like "played", "tied", "cancelled","postponed"
	**********************************************************/
	public function update_match_info()
	{
		$action = $this->input->post('action');
		$msg 	=	['type' => false, 'message' => "Something went wrong please try again."];
		if($action == 'match_status'){
			$match_id  = $this->input->post('match_id') == "" ? 0 : $this->input->post('match_id');
			if($match_id){
				$match_status = $this->input->post('in_match_status') == "" ? '0' : $this->input->post('in_match_status');
				$win_team = $this->input->post('in_win_team') == "" ? 0 : (int) $this->input->post('in_win_team');

				$update_ary  = ['match_status' => $match_status];
				if($match_status == '1'){
					if($win_team){
						$update_ary['win_team']  = $win_team;
					}
				}
				$up = $this->teams->update_match($match_id, $update_ary);
				if($up)
					$msg 	=	['type' => true, 'message' => "Match status chnged."];
				else
					$msg 	=	['type' => false, 'message' => "Something went wrong!"];

			}else{
				$msg 	=	['type' => false, 'message' => "Invalid match."];
			}
			
			
		}
		echo  json_encode($msg);die;
	}

	/*********************************************************
	* get_players 
	* this function uses to return a team plaers with opp.team players-
	**********************************************************/
	public function get_players()
	{
		$action = $this->input->post('action');
		$msg 	=	['type' => false, 'message' => "Something went wrong please try again."];
		if($action == 'get_players'){
			$team_id 	= $this->input->post('team_id') == "" ? 0 : $this->input->post('team_id');
			$match_id 	= $this->input->post('match_id') == "" ? 0 : $this->input->post('match_id');
			$get_match  = $this->teams->get_match_data($match_id);
			$opp_team 	= $get_match->team_one == $team_id ? $get_match->team_two : $get_match->team_one;
			$players_list1	=	$this->cricket->get_player_list($team_id,$match_id);
			$players_list2	=	$this->cricket->get_player_list($opp_team,$match_id);

			$options_html = '<option value="0">Select Player from Team</option>';
			$options_html2 = '<option value="0">Select Player from Opp.Team</option>';
			if(count($players_list1)){
				foreach ($players_list1 as $key => $info) {					
					$options_html .= "<option value='".$info['id']."'>".ucwords($info['first_name']).' '.ucwords($info['last_name'])."</option>";
				}

			}
			if(count($players_list2)){
				foreach ($players_list2 as $key => $info) {		
					
						$options_html2 .= "<option value='".$info['id']."'>".ucwords($info['first_name']).' '.ucwords($info['last_name'])."</option>";
				}
			}
			$msg = ['type' => true, 'message' => $options_html, 'details' => $options_html2]; 
		}
		echo  json_encode($msg);die;
	}

	/*********************************************************
	* add_score 
	* this function uses add new score to board per player 
	- if record exists will update otherwise insert-
	**********************************************************/
	public function add_score()
	{
		$action = $this->input->post('action');
		$msg 	=	['type' => false, 'message' => "Something went wrong please try again."];
		if($action == 'add_score'){
			$match_id 		=	$this->input->post('match_id') == "" ? 0 : (int) $this->input->post('match_id');
			$from_team_id 	=	$this->input->post('from_team_id') == "" ? 0 : (int) $this->input->post('from_team_id');
			$player_id 		= 	$this->input->post('selected_player_id') == "" ? 0 : (int) $this->input->post('selected_player_id');
			$player_score 	= 	$this->input->post('in_player_score') == "" ? 0 : (int) $this->input->post('in_player_score');
			$in_wicket_by 	= 	$this->input->post('in_wicket_by') == "" ? 0 : (int) $this->input->post('in_wicket_by');

			if($from_team_id  && $player_id   ){
				$insert_ary = 	[
								'match_id_fk' => $match_id,
								'player_id_fk' => $player_id,
								'score' => $player_score,
								'team_id_fk' => $from_team_id,
								'wicket_by' => $in_wicket_by
							];
				$where = 	[
								'match_id_fk' => $match_id,
								'player_id_fk' => $player_id,								
								'team_id_fk' => $from_team_id
							];
				$check = $this->teams->check_score_record($where);	
				if(!empty($check)){
					$in = $this->teams->update_new_score($check->id, $insert_ary);
				}else{
					$in = $this->teams->create_new_score($insert_ary);
				}	

				
				if($in)
					$msg 	=	['type' => true, 'message' => "Succesfully points added to player!"];
				else
					$msg 	=	['type' => false, 'message' => "Something went wrong!"];
			}else{
				$msg 	=	['type' => false, 'message' => "Please select team & player "];
			}
			
		}
		echo  json_encode($msg);die;
	}

	/**************************************END**************************************/
}
