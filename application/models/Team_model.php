<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team_model extends CI_Model {
	public $teams 			= '';
	public $players 		= '';
	public $matches 		= '';
	public $points 			= '';

	function __construct(){
		parent::__construct();
		$this->teams 		= 'teams';
		$this->players 		= 'players';
		$this->matches 		= 'matches';
		$this->points 		= 'points';
	}

	public function check_team($name)
	{
		$this->db->where('team_name', $name);
		return $this->db->get($this->teams)->num_rows();
	}

	public function create_team($insert_ary)
	{
		$this->db->insert($this->teams, $insert_ary);
		return $this->db->insert_id();
	}

	public function create_player($insert_ary)
	{
		$this->db->insert($this->players, $insert_ary);
		return $this->db->insert_id();
	}

	public function update_player($id, $info)
	{	
		$this->db->where('id', $id);
		return $this->db->update($this->players, $info);
		
	}

	public function create_match($insert_ary)
	{
		$this->db->insert($this->matches, $insert_ary);
		return $this->db->insert_id();
	}

	public function update_match($id, $info)
	{	
		$this->db->where('match_id', $id);
		return $this->db->update($this->matches, $info);
		
	}

	public function get_match_data($id)
	{
		$this->db->where('match_id', $id);
		return $this->db->get($this->matches)->row();
	}

	public function create_new_score($insert_ary)
	{
		$this->db->insert($this->points, $insert_ary);
		return $this->db->insert_id();
	}

	public function check_score_record($where){
		$this->db->where($where);
		return $this->db->get($this->points)->row();
	}
	
	public function update_new_score($id, $info)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->points, $info);
	}
	
}

