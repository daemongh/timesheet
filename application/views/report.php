<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>My Timesheet Project</title>
</head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/base.css'; ?>"/>
<body>

<h1>Timesheet Reports</h1>

<table class="report">
<?php

foreach ($report as $project => $users) {
   $projects[] = $project; 

    foreach ($users as $user => $hours) {
        $staff[] = $user;
    } 

}

$staff = array_unique($staff);
echo "<thead>";
echo "<tr><th>Projects</th>";

foreach ($staff as $id => $u) {
    echo "<th>$u</th>";

}
echo "<th>Project Total Hours</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

foreach ($projects as $p => $proj) {
    $totalHours = 0;

    echo "<tr>";
    echo "<td class='project'>$proj</td>";
    foreach ($staff as $id => $u) {
        if(isset($report[$proj][$u])) {
            foreach($report[$proj][$u] as $h => $hours) {
                echo "<td class='hours'>$hours</td>";
                $totalHours += $hours;
            }
        } else {
            echo "<td>N/A</td>";
        }

    }
    echo "<td class='total'>$totalHours</td>";
    echo "</tr>";
}
echo "</tbody>";


?>
</table>
</body>
</html>
