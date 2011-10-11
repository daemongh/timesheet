<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>My Timesheet Project</title>
</head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/base.css'; ?>"/>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.0/themes/base/jquery-ui.css"/>


<script language="javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script language="javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>

<script language="javascript" src="<?php echo base_url().'js/date.js'?>"></script>
<body>

<h1>Timesheet Dashboard</h1>
<h3>Welcome, <?php echo $user; ?></h3>

<br>
Week of : <input type="text" name="from" id="fromDate">
<!--<a href="" id="thisWeek">this week</a>
<a href="" id="lastWeek">last week</a> --> 
<!-- <input type="button" name="resetDates" value="Continue" id="continue">-->
<br><br>
<div id="projects" style="display:none">
<table id="projectTable">
	<thead>
		<tr>
			<td>Main Project</td>
			<td>Sub Project</td>

			<td></td>

			<?php 
			$days = getDays();
			foreach ($days as $id => $day) {
				echo "<td id='$day'>$day</td>";
			}

			?>
			<td>Total Hours</td>
		</tr>
	</thead>
	<tbody>
		<tr class="project" style='display:none'>
			<td>
				<select name='project'>

					<option value='one'>Project 1</option>
					<option value='two'>Project 2</option>
					<option value='three'>Project 3</option>

				</select>
			</td>
			<td>
				<select name='sub'> 

					<option value='sub1'>Sub Project 1</option> 
					<option value='sub2'>Sub Project 2</option> 
					<option value='sub3'>Sub Project 3</option>
 
				</select>
			</td>

			<td></td>
			<?php
			$value = buildWeek();
			foreach($value as $id => $day) {
				echo "<td>";
				echo "<select class='time' name='$id'>";
				foreach ($day as $id => $hour) {
					echo "<option value='$hour'>$hour</option>";
				}
				echo "</select>";
				echo "</td>";
			}
			?>

			<td id='totalProjectHours'>0 Hours</td>
		</tr>
	</tbody>
</table>
<br><br>
<input type="button" name="add" value="add project" id="addProject">
<br><br>

Notes:<br> <textarea name="notes" rows=10 cols=50></textarea>

<br><br>
Total hours for the week : XXX
<br><br>
<input type="button" name="submit" value="submit">
<input type="button" name="reset" value="reset">
<Br><br><br>

</div>
</body>

<script type="text/javascript">
$(document).ready( function() {
	$('#fromDate').datepicker({
		onSelect: function() {

        	var sunday = $(this).datepicker('getDate');
	        sunday.setDate(sunday.getDate() - (sunday.getDay() || 7));

            var monday = new Date(sunday.getTime());
            monday.setDate(monday.getDate() + 1);

            var tuesday = new Date(sunday.getTime());
            tuesday.setDate(tuesday.getDate() + 2);
            
            var wednesday = new Date(sunday.getTime());
            wednesday.setDate(wednesday.getDate() + 3);
            
            var thursday = new Date(sunday.getTime());
            thursday.setDate(thursday.getDate() + 4);
            
            var friday = new Date(sunday.getTime());
            friday.setDate(friday.getDate() + 5);
            
            var saturday = new Date(sunday.getTime());
            saturday.setDate(saturday.getDate() + 6);

			$('#sunday').html(sunday.toString('MM/dd/yy'));
			$('#monday').html(monday.toString('MM/dd/yy'));
			$('#tuesday').html(tuesday.toString('MM/dd/yy'));
			$('#wednesday').html(wednesday.toString('MM/dd/yy'));
			$('#thursday').html(thursday.toString('MM/dd/yy'));
			$('#friday').html(friday.toString('MM/dd/yy'));
			$('#saturday').html(saturday.toString('MM/dd/yy'));
			
			$('#projects').show();
			$('.project').clone(true).appendTo('#projectTable').show().removeAttr('hidden').removeClass('project');
    	}
	});


	$('#lastWeek').click(function() {
		var lastWeek = Date.today().last().saturday().toString('MM/dd/yyyy');
		console.log(lastWeek);

		$('#fromDate').val(lastWeek);
		$('#fromDate').trigger('datepicker');
		return false;
	});
	
	$('.time').change(function() {
		//total += parseInt($(this).val());
		var	total = 0;	

		$(this).each(function() {
			total += parseInt($(this).val());
		});
		

		$('.time last:td').html(total + ' Hours');

	});

	$('#addProject').click(function() {
		$('.project').clone(true).appendTo('#projectTable').show().each(function() {
			$(this).removeAttr('hidden').removeClass('project');	
		});

		return false;
	});
});
</script>




</html>

<?php

// this should be moved to a helper
function getHours() {
for ($x = 0; $x < 13; $x++) {
	$time[] =  $x;
}



return $time;
}


function getDays() {
	return array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');	
}

function buildWeek() {
	$days = getDays();
	$hours = getHours();
	$week = array();
	foreach($days as $id => $day) {
		foreach ($hours as $hId => $hour) {
			$week["$day"][] =  $hour;	
		}
	}
	return $week;
		
	
}
