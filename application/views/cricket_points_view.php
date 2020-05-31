<?php include_once('header.php'); ?>
<div class="start-page">
	<div class="col-sm-12">
		<div class="col-sm-6">
			<table class="table">
			<thead>
				<tr>
					<th colspan="2">
						<div class="text-center">	
							<?php if($match_info->win_team == $match_info->team_one){ ?>
									<img src="<?php echo site_url('assets/uploads/award.png');?>" height="24">
							<?php } ?>						
							<img class="img_th" src="<?php echo site_url("assets/uploads/team_logo/".$match_info->team_one_logo);?>" height="24 ">
							&nbsp;
							<?php echo ucwords(trim($match_info->team_one_name));?>
							<p>( <?php echo $match_info->team_one_score;?> / <?php echo $match_info->team_one_wickets;?>)</p>
						</div>						
					</th>
				</tr>
				<tr class="head_tr">
					<th class="text-left">Player Name</th>
					<th class="text-left"> Score</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				if(count($players_list_one)){
					foreach ($players_list_one as $key1 => $players_info) {				
				?>
					<tr>
						<td class="text-left">
							<img src="<?php echo site_url('assets/uploads/player_logo/'.$players_info['avatar']);?>" height="30" style="border-radius: 50% !important">
							<?php echo ucwords(trim($players_info['first_name'])." ".trim($players_info['last_name']));?></td>
						<td class="text-left"><?php echo empty($players_info['score']) ? 'N/A' : (int)$players_info['score'];?></td>
					</tr>
				<?php
					}
				}
				?>
			</tbody>
		</table>
		</div>
		<div class="col-sm-6">
			<table class="table">
			<thead>
				<tr>					
					<th colspan="2">
						<div class="text-center">
							<?php if($match_info->win_team == $match_info->team_two){ ?>
									<img src="<?php echo site_url('assets/uploads/award.png');?>" height="24">
							<?php } ?>		
							<img class="img_th" src="<?php echo site_url("assets/uploads/team_logo/".$match_info->team_two_logo);?>" height="24">
							&nbsp;
							<?php echo ucwords(trim($match_info->team_two_name));?>
							<p>( <?php echo $match_info->team_two_score;?> / <?php echo $match_info->team_two_wickets;?>)</p>
						</div>						
					</th> 
				</tr>
				<tr class="head_tr">
					<th class="text-left">Player Name</th>
					<th class="text-left"> Score</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				if(count($players_list_two)){
					foreach ($players_list_two as $key1 => $players_info) {				
				?>
					<tr>
						<td class="text-left">
							<img src="<?php echo site_url('assets/uploads/player_logo/'.$players_info['avatar']);?>" height="30" class="circle" style="border-radius: 50% !important">
							<?php echo ucwords(trim($players_info['first_name'])." ".trim($players_info['last_name']));?></td>
						<td class="text-left"><?php echo empty($players_info['score']) ? 'N/A' : (int)$players_info['score'];?></td>
					</tr>
				<?php
					}
				}
				?>
			</tbody>
		</table>
		</div>
	</div>
</div> <!-- end start-page -->
<?php include_once('footer.php'); ?>