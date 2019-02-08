<!doctype html>
<html lang="en">
<head>
	<title>Admin Panel</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="Files/normalize.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Files/admin.css">
</head>
<body>


<nav class="navbar navbar-default"> <!-- Bootstrap Nav Bar -->
	<div class="container-fluid">
		<div class="navbar-header">
		<a class="navbar-brand" style="padding-right:60px;font-size:2em">BFP</a>
		</div>
		<ul class="nav navbar-nav">
			<li><a href="../../INFO/current/17joblist.php">2017 Joblist</a></li>
			<li><a href="../../INFO/current/18joblist.php">2018 Joblist</a></li>
			<li><a href="../../INFO/current/19joblist.php">2019 Joblist</a></li>
			<li><a href="../../INFO/current/equiplist.php">Equipment</a></li>
			<li><a href="index.php">Foreman Report</a></li>
            <li><a href="reports.php">Get Reports</a></li>
			<li class="active"><a href="admin.php">Admin Panel</a></li>
		</ul>
	</div>
</nav>
    
<br /><br />

<div class="center">
    <div class="main-container">
        <div class="left-column">
            <h4>Edit Database</h4>
            <h5><a href="#" onclick="loadDoc('editdb.imbed.php?edit=foremen', displayOne);">Foremen</a></h5>
            <h5><a href="#" onclick="loadDoc('editdb.imbed.php?edit=employees', displayOne);">Employees</a></h5>
            <h5><a href="#" onclick="loadDoc('editdb.imbed.php?edit=equipment', displayOne);">Equipment</a></h5>
        </div>   
        <div class="middle-column" id="display">
        </div>
        <div class="middle-column-2" id="display2">
        </div>
        <div class="right-column" id="display3">
        </div>
    </div>
</div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="Files/FRscripts.js"></script>
</body>
</html>