<?php include_once('header.php'); ?>
<div class="start-page">
			<?php 
				if(!empty($team_info)){
					
						// echo "<pre>"; print_r($team_info); die;
						?>
						<div class="col-sm-12" > 	
							<div class="col-sm-3 col-xs-6 team_box" > 
			                  <a href="<?php echo site_url('team/'.$team_info[0]['team_id']);?>" title="<?php echo $team_info[0]['team_name'];?>" class="player_box">
			                    <div class="tile" >
			                    <div class="icon" ><img src="<?php echo site_url('assets/uploads/team_logo/'.$team_info[0]['team_logo']);?>" alt="team_logo" height="50" width="50"></div>
			                    <h3 id="get_team_name"><?php echo $team_info[0]['team_name'];?></h3>
			                    <p>Rank : NA</p>
			                    
			                    </div>
			                   </a>
			              </div>
			            </div>  
			            <div class="col-sm-12" > 
			            	<div class="col-sm-3 col-xs-6" ></div>
			            	<div class="col-sm-6 col-xs-6 " > 
			              	<?php 
			              		if(count($team_info)){
			              			foreach ($team_info as $team_key => $_team_info) {
			              				if($_team_info['first_name'] != ""){
			              					?>
			              						<a href="<?php echo site_url('team/'.$_team_info['team_id'].'/player/'.$_team_info['id']);?>" title="<?php echo $_team_info['first_name'];?>" class="player_box">
								                    <div class="tile" >
								                    <div class="icon" ><img src="<?php echo site_url('assets/uploads/player_logo/'.$_team_info['avatar']);?>" alt="player_logo" class="pull-right" height="50"></div>
								                    <h4><?php echo ucwords(trim($_team_info['first_name'])." ".trim($_team_info['last_name']));?> <span title="Captain" class="blue"><?php echo ($_team_info['is_captain']) ? 'Ⓒ': '';?></span></h4>
								                    <p>
								                    	<?php 
								                    	$player = $_team_info['player_type'];
								                    	echo ($player == '1') ? 'Batsman' : (($player == '2') ? 'Bowler' : (($player == '3') ? 'Wicky Keeper' : (($player == '4') ? "All Rounder" : 'N/A') ));
								                    	?>
								                    	</p>
								                    
								                    </div>
								                   </a>
								                   <hr>
			              					<?php
			              				}else{
			              					?>
			              					<div class="alert alert-info">No Players Found..</div>
			              					<?php
			              				}
			              			}
			              		}?>
			             	 </div>
			            	<div class="col-sm-3 col-xs-6" ></div>
			            </div>	
			              
						<?php
					
				}
			?>
</div> <!-- end start-page -->
<?php include_once('footer.php'); ?>