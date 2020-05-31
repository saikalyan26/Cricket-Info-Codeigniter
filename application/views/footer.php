		</div> <!-- container -->	
		<div style="position:absolute;text-align:center;right:25%;top: 25%; left: 25%; z-index:999999; display:none;" class="loader"><img src="<?php echo site_url('assets/uploads/ajax_loader.gif');?>"></div>

		<div style="display:none; z-index:999999;" class="impoert_loader_overlay" id="setupfade"></div>

		<input type="hidden" class="base_url" value="<?php echo site_url();?>">

		<!-- Modal -->
		<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
		  <!-- Modal content-->
		  <div class="modal-content">
		    <div class="modal-header">
		      <button type="button" class="close" data-dismiss="modal">&times;</button>
		      <h4 class="modal-title">Modal Header</h4>
		    </div>
		    <div class="modal-body">
		    <form method="POST" enctype="multipart/form-data" id="modal_form" name="modal_form">
		      <?php  if($uri == ""){ ?>
		      	<input type="hidden" name="action" id="action_modal" value="add_team">
		      	<div class="row">
					<div class="col-md-12" >
						<p class="text_label">Team Name</p>
						<input name="in_team_name"  type="text" placeholder="Enter Team Name" class="form-control" max="30" maxlength="30" required="required">
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-12" >
						<p class="text_label">Team Logo</p>
						<input name="in_team_logo"  type="file"  accept="image/x-png,image/gif,image/jpeg">
					</div>
				</div>
				<br>
		      <?php } else if(trim($uri) == "team" && trim($uri3) != 'player' ){?>

		      	<input type="hidden" name="action" id="action_modal" value="add_player"> 
		      	<input type="hidden" name="hidd_team_id"  value="<?php echo $this->uri->segment(2);?>">
		      	
		      	<div class="row">
					<div class="col-md-6" >
						<p class="text_label">First Name</p>
						<input name="in_first_name"  type="text" placeholder="Enter First Name" class="form-control"  maxlength="100" required="required">
					</div>
					<div class="col-md-6" >
						<p class="text_label">Last Name</p>
						<input name="in_last_name"  type="text" placeholder="Enter Last Name" class="form-control" maxlength="100" required="required">
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-6" >
						<p class="text_label">Jersey Number</p>
						<input name="in_jersey_number"  type="text" placeholder="Enter Jersey Number" class="form-control" maxlength="4" pattern="[0-9]" required="required" onkeypress="return isNumber(event)">
					</div>
					<div class="col-md-6" >
						<p class="text_label">Team</p>
						<input name="in_team_id"  type="text" value="<?php echo isset($team_info[0]['team_name']) ? $team_info[0]['team_name'] : 'N/A';?>" class="form-control"  readonly="readonly">
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-6" >
						<p class="text_label">Player Type</p>
						<select class="form-control" name="in_player_type">
							
							<option value="1" selected="selected">Batsman</option>
							<option value="2">Bowler</option>
							<option value="3">Wickey Keeper</option>
							<option value="4">All Rounderr</option>
						</select>
					</div>
					<div class="col-md-6" >
						<p class="text_label">Country</p>
						<select class="form-control">
							<option value="India" selected="selected">India</option>
							<?php 
								$country_ary = ['Pakistan', 'Sri Lanka', 'England', 'South Africa', 'Zimbabwe', 'West Indies', 'Afghanistan', 'Bangladesh', 'Australia'];
								foreach ($country_ary as $key => $value) {
									echo "<option ='".$value."'>".$value."</option>";
								}
							?>
							
						</select>
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-6" >
						<p class="text_label">Profile Pic</p>
						<input name="in_player_logo"  type="file"  accept="image/x-png,image/gif,image/jpeg">
					</div>
					<div class="col-md-6" >
						<p>&nbsp;</p>
						<p class="text_label"> <input name="in_captain"  type="checkbox"  maxlength="4" style="height: 18px; width: 18px;">
							Is Captain
						
						</p>
					</div>
				</div>
				<br>
				
			<?php } else if(trim($uri) == "matches-list" ){?>
				<input type="hidden" name="action" id="action_modal" value="add_match"> 
				<div class="row">
					<div class="col-md-6" >
						<p class="text_label">Team One</p>
						<select class="form-control" name="in_team_one">
							<option value="0" selected="selected" disabled="disabled">Select Team</option>
							<?php if(count($teams_list)){
								foreach ($teams_list as $key => $value) {
									echo '<option value="'.$value['team_id'].'">'.$value['team_name'].'</option>';
								}
							}
							?>
						</select>
					</div>
					<div class="col-md-6" >
						<p class="text_label">Team Two</p>
						<select class="form-control" name="in_team_two">
							<option value="0" selected="selected" disabled="disabled">Select Team</option>
							<?php if(count($teams_list)){
								foreach ($teams_list as $key => $value) {
									echo '<option value="'.$value['team_id'].'">'.$value['team_name'].'</option>';
								}
							}
							?>
						</select>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-6" >
						<p class="text_label">Play Date</p>
						<input type="text" name="play_at" id="datepicker" readonly="readonly" class="form-control" value="<?php echo date('d/m/Y');?>">
					</div>
				</div>
			  <?php } else if(trim($uri) == "match" && $match_info->match_status == '0' ){?>
				<input type="hidden" name="action" id="action_modal" value="match_status"> 
				<input type="hidden" name="match_id" value="<?php echo $this->uri->segment(2);?>"> 
				<div class="row">
					<div class="col-md-6" >
						<p class="text_label">Match Status</p>
						<select class="form-control" name="in_match_status" id="in_match_status">
							
							<?php 
							$the_status_list = ['Not Played Yet', 'Played', 'Tied', 'Cancelled', 'Postponed'];
								foreach ($the_status_list as $key => $value) {
									echo '<option value="'.$key.'">'.$value.'</option>';
								}
							
							?>
						</select>
					</div>
					<div class="col-md-6" id="winning_team_select" style="display: none;">
						<p class="text_label">Wining Team</p>
						<select class="form-control" name="in_win_team">
							
							<option value="">Select Team</option>
							<option value="<?php echo $match_info->team_one;?>"><?php echo $match_info->team_one_name;?></option>
							<option value="<?php echo $match_info->team_two;?>"><?php echo $match_info->team_two_name;?></option>
						</select>
					</div>
				</div>
			  <?php } else if(trim($uri) == "match" && $match_info->match_status == '1' ){?>
			  <input type="hidden" name="action" id="action_modal" value="add_score"> 
				<input type="hidden" name="match_id"  id="hidd_match_id"value="<?php echo $this->uri->segment(2);?>"> 
				<input type="hidden" name="team_id" id="wining_team_id" value="<?php echo $match_info->win_team;?>"> 

				<div class="row">
					<div class="col-md-6" >
						<p class="text_label">Match Status</p>
						<select class="form-control" name="in_match_status" id="in_match_status" disabled="disabled">
							
							<?php 
							$the_status_list = ['Not Played Yet', 'Played', 'Tied', 'Cancelled', 'Postponed'];
								foreach ($the_status_list as $key => $value) {
									$selected = ($match_info->match_status == $key) ? $selected = 'selected="selected"' : '';
									echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
								}
							
							?>
						</select>
					</div>
					<div class="col-md-6" id="winning_team_select" >
						<p class="text_label">Wining Team</p>
						<select class="form-control" name="" disabled="disabled">
							
							
							<?php $sel1 = ($match_info->win_team == $match_info->team_one) ? $selected = 'selected="selected"' : '';?>
							<?php $sel2 = ($match_info->win_team == $match_info->team_two) ? $selected = 'selected="selected"' : '';?>
							<option value="<?php echo $match_info->team_one;?>" <?php echo $sel1;?>><?php echo $match_info->team_one_name;?></option>
							<option value="<?php echo $match_info->team_two;?>" <?php echo $sel2;?>><?php echo $match_info->team_two_name;?></option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6"  >
						<p class="text_label">Select Team</p>
						<select class="form-control" name="from_team_id" id="from_team_id">
							
							<option value="">Select Team</option>
							<?php $sel1 = ($match_info->win_team == $match_info->team_one) ? $selected = 'selected="selected"' : '';?>
							<?php $sel2 = ($match_info->win_team == $match_info->team_two) ? $selected = 'selected="selected"' : '';?>
							<option value="<?php echo $match_info->team_one;?>" <?php echo $sel1;?>><?php echo $match_info->team_one_name;?></option>
							<option value="<?php echo $match_info->team_two;?>" <?php echo $sel2;?>><?php echo $match_info->team_two_name;?></option>
						</select>
					</div>
					<div class="col-md-6" >
						<p class="text_label">Pick Player</p>
						<select class="form-control selected_player_id" name="selected_player_id" >
							
							<option value="0">Select Player from Team</option>
							<?php if($match_info->win_team == $match_info->team_one){ 
								$loop_players = $players_list_one;
							}else{
								$loop_players = $players_list_two;
							}

							
								if(count($loop_players)){
									foreach ($loop_players as $key1 => $players_info) {				
								?>
									
										<option value="<?php echo $players_info['id'];?>"><?php echo ucwords(trim($players_info['first_name'])." ".trim($players_info['last_name']));?></option>	
								<?php
									}
								}
								?>
							
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6"  >
						<p class="text_label">Add Score</p>
						<input type="text" name="in_player_score" onkeypress="return isNumber(event)" placeholder="Enter Score" maxlength="3" class="form-control">
					</div>
					<div class="col-md-6"  >
						<p class="text_label">Wicket By</p>
						<select class="form-control in_wicket_by_select" name="in_wicket_by"  >
							
							<option value="0">Select Player from Opp.Team</option>
							
						</select>
					</div>
				</div>
		      <?php} else{ ?>
		      	<!-- <input type="hidden" name="action" id="action_modal" value=""> -->
		      <?php }?>
		      </form>
		    </div>
		    <div class="modal-footer" >
		      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      <button type="button" class="btn btn-suceess save_mmodal_info" >Save</button>
		    </div>
		  </div>
		  
		</div>
		</div>

</body>
<footer>
	<script src="<?php echo site_url('assets/js/jquery-3.1.1.min.js');?>"></script>
	<script src="<?php echo site_url('assets/js/bootstrap.min.js');?>"  crossorigin="anonymous"></script>	
	<script src="<?php echo site_url('assets/js/sweetalert.min.js');?>"></script>
	<script src="<?php echo site_url('assets/js/jquery-ui.js');?>"></script>
	<script type="text/javascript" src="<?php echo site_url('assets/js/custom_script.js');?>"></script>	
</footer>
</html>