<?php include_once('header.php'); ?>
<div class="start-page" style="margin-left: 160px;margin-top: 10%;">
	<?php 
	if(count($teams_list)){
		foreach ($teams_list as $team_key => $team_info) {				
	?>		
			<div class="col-sm-3 team_box" > 
              <a href="<?php echo site_url('team/'.$team_info['team_id']);?>" style="color: #fff">
                <div class="tile-stats tile-blue" >
                <div class="icon" ><img src="<?php echo site_url('assets/uploads/team_logo/'.$team_info['team_logo']);?>" alt="team_logo" height="50" width="50"></div>
                <h3><?php echo $team_info['team_name'];?></h3>
                <p><?php echo ($team_info['first_name']) ? ucwords(trim($team_info['first_name'])." ".trim($team_info['last_name'])) : 'N/A';?></p>
                
                </div>
               </a>
          	</div>
	<?php
		}
	}
	?>
</div> <!-- end start-page -->
<?php include_once('footer.php'); ?>