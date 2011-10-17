
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
<div class='title'>Welcome, <?php echo $username; ?></div>

<br>
<form id='projectForm'>
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
                    <option value=''>-- Select --</option>

                <?php
                foreach ($projects as $project) {
                    echo "<option value={$project->id}>{$project->project_name}</option>";

                }
                ?>
				</select>
			</td>
			<td>
				<select name='category'> 
                    <option value=''>-- Select --</option>
                <?php
                foreach ($categories as $category) {
                    echo "<option value={$category->id}>{$category->category}</option>";
                }
                ?>
 
				</select>
			</td>

			<td></td>
			<?php
			$value = getDays();
			foreach($value as $id => $day) {
				echo "<td class='time'>";
				echo "<input type='text' size='5' name='$day' class='hours' value='0'/>";
				echo "</td>";
			}
			?>

			<td class='totalProjectHours' id='totalProjectHours'>0 Hours</td>
		</tr>
	</tbody>
</table>
<br><br>
<input type="button" name="add" value="add project" id="addProject">
<br><br>

Notes:<br> <textarea name="notes" rows=10 cols=50></textarea>

<br><br>
Total hours for the week : <span id='grandTotal'>0</span>
<br><br>
</form>
<input type="button" name="submit" value="submit" id="submit">
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

			$('#sunday').html(sunday.toString('MM/dd'));
			$('#monday').html(monday.toString('MM/dd'));
			$('#tuesday').html(tuesday.toString('MM/dd'));
			$('#wednesday').html(wednesday.toString('MM/dd'));
			$('#thursday').html(thursday.toString('MM/dd'));
			$('#friday').html(friday.toString('MM/dd'));
			$('#saturday').html(saturday.toString('MM/dd'));
			
			$('#projects').show();
			$('.project').clone(true).appendTo('#projectTable').show().removeAttr('hidden').removeClass('project').attr('id', 1);
			$('#1 td:last').attr('id', 'totalProjectHours_1');
    	}
	});


	$('#lastWeek').click(function() {
		var lastWeek = Date.today().last().saturday().toString('MM/dd/yyyy');
		console.log(lastWeek);

		$('#fromDate').val(lastWeek);
		$('#fromDate').trigger('datepicker');
		return false;
	});

	$('.hours').focus(function() {
		$(this).val('');
	});

	$('.hours').blur(function() {
		if ( $(this).val() == '' ) {
			$(this).val('0');
		}	
	});
	
	$('.time').live('change', function() {
		//total += parseInt($(this).val());
		var	total = 0;	
		var grandTotal = 0;
		var id = $(this).closest('tr').attr('id');
			
		$('#'+id+' .hours').each(function() {

			if ($(this).val() != '') {

				hour = Math.round(parseFloat($(this).val()) * 2) * .5;
				
				total += parseFloat(hour);
				$(this).val(hour);
				
			}
		});
		

		$('#totalProjectHours_'+id).html(total + ' Hours');

		$('.hours').each(function() {
			
			if ($(this).val() != '') {
				totalHour = Math.round(parseFloat($(this).val()).toFixed(1) * 2) * .5;
				grandTotal += totalHour;	

			}
		});

		$('#grandTotal').html(grandTotal);

	});

	$('#addProject').click(function() {
		$('.project').clone(true).appendTo('#projectTable').show().each(function() {
			$(this).removeAttr('hidden').removeClass('project');	
			var row = $(this).index();
			$(this).attr('id', row);
			$('#'+row+' td').attr('id', row);
			$('#'+row+' td:last').attr('id', 'totalProjectHours_'+row);
		});

		

		return false;
	});


	$('.hours').keydown(function(e) {
		if ((!e.shiftKey && !e.ctrlKey && !e.altKey) && ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105)) || e.keyCode == 110) {
		
		} else if (e.keyCode != 8 && e.keyCode != 46 && e.keyCode != 37 && e.keyCode != 39 && e.keyCode != 9 ) {
			e.preventDefault();
		}
	});		



	$.fn.serializeObject = function()
	{
	    var o = obj = week = {};
	    var resourceRecords = [];

	    $.each(this.serializeArray(), function() {
	        if (o[this.name] !== undefined) {
	            if (!o[this.name].push) {
	                o[[this.name]] = [o[this.name]];
	            }
	            o[[this.name]].push(this.value || '');
	        } else {
	            o[[this.name]] = this.value || '';
	        }
	    	
	    });
		
		for(var x = 1; x<o.project.length; x++) {
			
			week = {
				'weekOf' : o.from, // Date.today().last().saturday().toString('MM/dd/yyyy');
				'notes' : o.notes,
					'project' : o.project[x],
					'category' : o.category[x],
					'sunday' : o.sunday[x],
					'monday' : o.monday[x],
					'tuesday' : o.tuesday[x],
					'wednesday' : o.wednesday[x],
					'thursday' : o.thursday[x],
					'friday' : o.friday[x],
					'saturday' : o.saturday[x],
					'time' : parseFloat(o.monday[x]) 
						+ parseFloat(o.tuesday[x]) 
						+ parseFloat(o.wednesday[x]) 
						+ parseFloat(o.thursday[x]) 
						+ parseFloat(o.friday[x]) 
						+ parseFloat(o.saturday[x]) 
						+ parseFloat(o.sunday[x]),

			};

			var tempTime = parseFloat(o.tuesday[x]) + parseFloat(o.monday[x])
			resourceRecords.push(week);
		}

		return resourceRecords;	
	};
	
	$('#submit').click(function() {
		var results = $('#projectForm').serializeObject();
        //var week = [];
        //week.push(results);

        var paramMap = {
            'week' : results,
            'update' : 1
        };

        console.log(week);

        $.ajax({
            url: "<?php echo site_url('/time/updateHours') ?>",
            type: "POST",
            data: paramMap,
            datatype: 'json',
            success: function(msg) {
                alert(msg);
            },
            error: function(xhr, text, error) {
                alert('error');
            }

        });
        
		return false;
	});

});
</script>




</html>

<?php
function getHours() {
	for ($x = 0; $x < 13; $x++) {
		$hours[$x] = $x;
	}
}

function getDays() {
	return array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');	
}

function buildWeek() {
	$days = getDays();
	$week = array();
	foreach($days as $id => $day) {
		foreach ($hours as $hId => $hour) {
			$week["$day"][] =  $hour;	
		}
	}
	return $week;
		
	
}
