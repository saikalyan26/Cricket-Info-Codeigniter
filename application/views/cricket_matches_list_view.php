<?php include_once('header.php'); ?>
<div class="start-page">
	<?php 
	if(count($matches_list)){
		foreach ($matches_list as $match_key => $match_info) {	
		$dt = $match_info['play_at'];
		$dt = DateTime::createFromFormat('Y-m-d H:i:s', $dt)->format('j M-Y'); 
		$match_status = $match_info['match_status'];
	?>		
			<div class="col-sm-12 match-box">
				<span class="pull-left match_box-s-title"> <?php echo $dt;?> </span><br>
				<div class="col-sm-3  match_box-s" > 
	              <a href="<?php echo site_url('match/'.$match_info['match_id']);?>"  style="color: #fff">
	                <div class="tile-stats tile-blue" >
	                <div class="icon" ><img src="<?php echo site_url('assets/uploads/team_logo/'.$match_info['team_one_logo']);?>" alt="team_one_logo" height="24"></div>
	                <h4><?php echo $match_info['team_one_name'];?></h4>
	                <p><?php echo ($match_info['team_one_first_name'] != "") ? ucwords(trim($match_info['team_one_first_name'])." ".trim($match_info['team_one_last_name'])) : 'N/A';?></p>
	                
	                </div>
	               </a>
	          	</div>
	          	<div class="col-sm-5  team_box_vs " > 	
	          	&nbsp;          		
	          		<a href="<?php echo site_url('match/'.$match_info['match_id']);?>" style="text-decoration-line: none;color: #4e4e4e;">
	          			<p> <span style="color: #4e4e4e;">vs</span> <br>	
	          			<span >          			
	          			<?php echo ($match_status == '1') ? $match_info['team_one_name']." won the match" : 
	          						( ($match_status == '2') ? 'Match tied' : 
	          							( ($match_status == '3') ? 'Match cancelled' : 
	          								( ($match_status == '4') ? 'Match postponed' : 
	          									"Not played yet"
	          								)
	          							)
	          					);
	          			?> 
	          			</span>
	          		</p>
	          		</a>
	          	</div>
	          	<div class="col-sm-3  match_box-s pull-right" > 
	              <a href="<?php echo site_url('match/'.$match_info['match_id']);?>" style="color: #fff">
	                <div class="tile-stats tile-blue" >
	                <div class="icon" ><img src="<?php echo site_url('assets/uploads/team_logo/'.$match_info['team_two_logo']);?>" alt="team_one_logo" height="24"></div>
	                <h4><?php echo $match_info['team_two_name'];?></h4>
	                <p><?php echo ($match_info['team_two_first_name'] != "") ? ucwords(trim($match_info['team_two_first_name'])." ".trim($match_info['team_two_last_name'])) : 'N/A';?></p>
	                
	                </div>
	               </a>
	          	</div>
			</div>

			
	<?php
		}
	}
	?>
</div>
<br>	
<br>
	<div class="col-sm-12 pagination">
		<div class="pull-left <?php echo ($end > 5 ) ? 'load_more_matches' : 'disabled'; ?>"" data-type="previos"><i class="button-pag">Previous</i></div>
		<div class="pull-right <?php echo ($get_matches_count > $end ) ? 'load_more_matches' : 'disabled'; ?>" data-type="next"><i class="button-pag">Next</i></div>
		<form id="matches_form_hidden" method="post">
		<input type="hidden" id="start_page" value="<?php echo $start;?>">
		<input type="hidden" id="end_page" value="<?php echo $end;?>">
		<input type="hidden" name="offset" id="offset"  value="0">
		</form>
	</div>


</div> <!-- end start-page -->
<?php include_once('footer.php'); ?>