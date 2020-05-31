<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cricket_model extends CI_Model {
	public $teams 			= '';
	public $players 		= '';
	public $matches 		= '';
	public $points 		= '';

	function __construct(){
		parent::__construct();
		$this->teams 		= 'teams';
		$this->players 		= 'players';
		$this->matches 		= 'matches';
		$this->points 		= 'points';
	}

	public function get_teams_list()
	{
		$this->db->select('players.first_name, players.last_name, teams.*');
		$this->db->from($this->players);
		$this->db->join($this->teams, "teams.team_id = players.team_id_fk", "right");		
		$this->db->group_by('teams.team_id');
		$this->db->order_by("teams.team_name", "ASC");
		return $this->db->get()->result_array();
	}

	public function get_players_list($id)
	{
		$this->db->select('*');
		$this->db->from($this->teams);
		$this->db->join($this->players, 'players.team_id_fk = teams.team_id','left');
		$this->db->where('teams.team_id',$id);
		return $this->db->get()->result_array();
	}

	public function get_player_info($team_id,$player_id)
	{
		$this->db->select('players.*, teams.team_id,teams.team_name, teams.team_logo, t1.matches, t2.runs, t3.hundreds, t4.fifties, t5.highest_score');
		$this->db->from($this->teams);
		$this->db->join($this->players, 'players.team_id_fk = teams.team_id','left');

		$this->db->join('(select count(p1.id) as matches, pl1.* from players pl1 left join points p1 on p1.player_id_fk = pl1.id WHERE pl1.id = '.$player_id.'  ) as t1', 't1.id = players.id','left');

		$this->db->join('( select SUM(p1.score) as runs, pl1.* from players pl1 left join points p1 on p1.player_id_fk = pl1.id WHERE pl1.id ='.$player_id.' )  as t2', 't2.id = players.id','left');

		$this->db->join('( select count(p1.id) as hundreds, pl1.* from players pl1 left join points p1 on p1.player_id_fk = pl1.id WHERE pl1.id = '.$player_id.' and p1.score >= 100 )  as t3', 't3.id = players.id','left');

		$this->db->join('( select count(p1.id) as fifties, pl1.* from players pl1 left join points p1 on p1.player_id_fk = pl1.id WHERE pl1.id = '.$player_id.' and p1.score > 100 AND p1.score <= 50  ) as t4', 't4.id = players.id','left');

		$this->db->join('( select MAX(p1.score) as highest_score, pl1.* from players pl1 left join points p1 on p1.player_id_fk = pl1.id WHERE pl1.id = '.$player_id.'  )  as t5', 't5.id = players.id','left');

		$this->db->where('teams.team_id',$team_id);
		$this->db->where('players.id',$player_id);
		return $this->db->get()->row();
	}

	public function get_matches_list($limit=0,$offset=5)
	{
		$this->db->select('matches.*, team1.team_name as team_one_name, team1.team_logo as team_one_logo, team2.team_name as team_two_name, team2.team_logo as team_two_logo , "0" as score ,p1.first_name as team_one_first_name,p1.last_name as team_one_last_name, p1.avatar as team_one_avatar,p2.first_name as team_two_first_name,p2.last_name as team_two_last_name, p2.avatar as team_two_avatar');
		$this->db->from($this->matches);		
		$this->db->join($this->teams." as team1", 'team1.team_id = matches.team_one','left');
		$this->db->join($this->teams." as team2", 'team2.team_id = matches.team_two','left');
		$this->db->join($this->players." as p1", 'p1.team_id_fk = team1.team_id and p1.is_captain = "1" ','left');
		$this->db->join($this->players." as p2", 'p2.team_id_fk = team2.team_id and p2.is_captain = "1" ','left');

		$this->db->order_by('matches.play_at','ASC');
		$this->db->limit($limit, $offset);
		return $this->db->get()->result_array();
	}

	public function get_matches_count()
	{
		$this->db->select('*');
		$this->db->from($this->matches);	
		return $this->db->get()->num_rows();
	}

	public function get_match_info($id)
	{
		$this->db->select('matches.*, team1.team_name as team_one_name, team1.team_logo as team_one_logo, team2.team_name as team_two_name, team2.team_logo as team_two_logo');
		$this->db->from($this->matches);		
		$this->db->join($this->teams." as team1", 'team1.team_id = matches.team_one','left');
		$this->db->join($this->teams." as team2", 'team2.team_id = matches.team_two','left');
		$this->db->where('matches.match_id', $id);
		return $this->db->get()->row();
	}

	public function get_player_list($team_one,$match_id)
	{
		$this->db->select('players.id,first_name, last_name , players.team_id_fk , points.score, players.avatar, points.wicket_by, players.player_type');
		$this->db->from($this->players);
		$this->db->join($this->points, 'points.player_id_fk = players.id and points.match_id_fk = '.$match_id, 'left');
		$this->db->where('players.team_id_fk', $team_one);
		$this->db->order_by('players.player_type', 'ASC');
		$this->db->order_by('points.score', 'DESC');
		return $this->db->get()->result_array();
	}

}
