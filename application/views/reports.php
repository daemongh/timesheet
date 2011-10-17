<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>My Timesheet Project</title>
</head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/base.css'; ?>"/>
<body>

<h1>Timesheet Reports</h1>

<div class='title'>Project Reports</div>
<?php 

//foreach ($projects as $id => $project) {
//    echo "<a href='".site_url("admin/displayReports/projects/{$project->id}")."'>{$project->project_name}</a> - {$project->project_desc}<br>";

//}
echo "<a href='". site_url('/admin/displayReports/projects/0') ."'>All Projects</a><br>";
?>
<!-- 
<div class='title'>Developer Reports</div>
<div class='title'>Category Reports</div>
-->
<?php

//foreach ($categories as $id => $category) {
//    echo "<a href='". site_url("admin/displayReports/category/{$category->id}") ."'>{$category->category}</a> - {$category->category_desc}<br>";
//}
//echo "<a href='". site_url('admin/displayReporsts/category/0') ."'>All Categories</a><br>";
?> 
</body>
</html>
