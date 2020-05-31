<?php include_once('header.php'); ?>
<div class="start-page">
			<?php 
				if(!empty($player_info)){
					
						
						?>
						<div class="col-sm-12" > 	
							<div class="col-sm-3 col-xs-6 team_box" > 
			                  <a href="<?php echo site_url('team/'.$player_info->team_id);?>" title="<?php echo $player_info->team_name;?>" class="player_box">
			                    <div class="tile" >
			                    <div class="icon" ><img src="<?php echo site_url('assets/uploads/team_logo/'.$player_info->team_logo);?>" alt="team_logo" height="50" width="50"></div>
			                    <h3><?php echo $player_info->team_name;?></h3>
			                    <p>Rank : NA</p>			                    
			                    </div>
			                   </a>
			              </div>
			            </div>  
			            <div class="col-sm-12" > 
			            	<div class="col-sm-3 col-xs-6" >
			            		<div class="icon player" ><img src="<?php echo site_url('assets/uploads/player_logo/'.$player_info->avatar);?>" alt="player_logo" class="" height="150"></div>
			            		<h3 class="player"><?php echo ucwords(trim($player_info->first_name)." ".trim($player_info->last_name));?> <span title="Captain" class="blue"><?php echo ($player_info->is_captain) ? 'Ⓒ': '';?></span></h3>
			            	</div>

			            	<div class="col-sm-6 col-xs-6  player_details" >
			            		<?php
			            			foreach ($player_info as $key => $player) {
			            				if(in_array($key, ['first_name', 'last_name','player_type', 'jersey_number', 'country', 'matches', 'runs', 'highest_score', 'fifties', 'hundreds']) ){
			            				?>
			            					<div class="line col-sm-12">
						            			<div class="col-sm-6 " >
						            				<label class="player_info_label_head">
						            				<?php 
						            					echo ucwords(str_replace("_", " ", trim($key)));
						            				?>						            						
						            				</label>
						            				<!-- <label class="player_info_label pull-right">:</label> -->
						            			</div>
						            			<div class="col-sm-6 " >
						            				<label class="player_info_label" >
						            				<?php 
						            				if($key == 'player_type'){						            					
						            					echo ($player == '1') ? 'Batsman' : (($player == '2') ? 'Bowler' : (($player == '3') ? 'Wicky Keeper' : (($player == '4') ? "All Rounder" : 'N/A') ));
						            				}
						            				else if(in_array($key, ['jersey_number', 'matches', 'runs', 'highest_score', 'fifties', 'hundreds'])){
						            					echo (int) $player;
						            				}
						            				else{
						            					echo ucwords(trim($player));
						            				}
						            				
						            				?>						            					
						            				</label>
						            			</div>
						            		</div>
			            				<?php
			            				}
			            			}
			            		?>
			            		

			             	 </div>
			            	<div class="col-sm-3 col-xs-6" ></div>
			            </div>	
			              
						<?php
					
				}
			?>
</div> <!-- end start-page -->
<?php include_once('footer.php'); ?>