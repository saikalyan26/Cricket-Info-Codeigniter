<!DOCTYPE html>
<html>
<head>
	<title>Cricket</title>
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/custom_styles.css');?>">	
	<link rel="stylesheet" href="<?php echo site_url('assets/css/bootstrap.min.css');?>" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo site_url('assets/css/jquery-ui.css');?>">
	<link rel="stylesheet" href="<?php echo site_url('assets/css/sweetalert.min.css');?>">
	
</head>
<body>
	<div class="container navigation-bar">
		<ul class="">
			<?php 
			$uri = $this->uri->segment(1);
			$uri3 = $this->uri->segment(3);

			?>
		  <li><a class="<?php echo (strpos($uri, 'match') !== false) ? '' : 'active';?>" href="<?php echo site_url();?>">Home</a></li>
		  <li><a  class="<?php echo (strpos($uri, 'match') !== false) ? 'active' : 'a';?>" href="<?php echo site_url('matches-list');?>">Matches</a></li>
		  	<?php  if($uri == ""){ ?>
		  		<li class="pull-right "><a href="javascript:void(0);" id="add_team">Add Team</a></li> 
		  	<?php } ?>
		  	<?php  if(trim($uri) == "team" && trim($uri3) != 'player' ){ ?>
		  		<li class="pull-right "><a href="javascript:void(0);" id="add_team">Add Player</a></li> 
		  	<?php } ?>
		  	<?php  if(trim($uri) == "matches-list"  ){ ?>
		  		<li class="pull-right "><a href="javascript:void(0);" id="add_team">Add Match</a></li> 
		  	<?php } ?>

		  	<?php  if(trim($uri) == "match" && $match_info->match_status == '0' ){ ?>
		  		<li class="pull-right "><a href="javascript:void(0);" id="add_team" >Chnage Match Status</a></li> 
		  	<?php } ?>

		  	<?php  if(trim($uri) == "match" && $match_info->match_status == '1' ){ ?>
		  		<li class="pull-right "><a href="javascript:void(0);" id="add_team" >Add Score</a></li> 
		  	<?php } ?>

		  	<?php  if(trim($uri) == "match" && $match_info->match_status == '3' ){ ?>
		  		<li class="pull-center " style="position: relative;left: 30%;"><a href="javascript:void(0);" style="color: red;" id="" >Match Cancelled</a></li> 
		  	<?php } ?>
		  	<?php  if(trim($uri) == "match" && $match_info->match_status == '4' ){ ?>
		  		<li class="pull-center " style="position: relative;left: 30%;"><a href="javascript:void(0);" style="color: red;" id="" >Match Postponed</a></li> 
		  	<?php } ?>
		  	<?php  if(trim($uri) == "match" && $match_info->match_status == '2' ){ ?>
		  		<li class="pull-center " style="position: relative;left: 30%;"><a href="javascript:void(0);"  id="" >Match Tied</a></li> 
		  	<?php } ?>
		  	<?php  if(trim($uri) == "match" && $match_info->match_status == '0' ){ ?>
		  		<li class="pull-center " style="position: relative;left: 30%;"><a href="javascript:void(0);"  id="" >Match Not Played Yet</a></li> 
		  	<?php } ?>
		  	<?php  if(trim($uri) == "match" && $match_info->match_status == '1' ){ ?>
		  		<li class="pull-center " style="position: relative;left: 30%;">
		  			<a href="javascript:void(0);"  >
		  				<img src="http://localhost/cricket/assets/uploads/award.png" height="24">
		  				<?php echo ($match_info->win_team == $match_info->team_one) ? $match_info->team_one_name : $match_info->team_two_name;?> won the match</a></li> 
		  	<?php } ?>
		  	
		  
		</ul>
		<br>

		