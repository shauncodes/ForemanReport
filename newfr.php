<!doctype html>

<html lang="en">
<head>
	<title>New Foreman Report</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.css">
	<link rel="stylesheet" type="text/css" href="Files/normalize.css">
	<link rel="stylesheet" type="text/css" href="Files/FRcollect.css">
    <?php include("PHPs/dbconnect.fr.inc.php"); ?>
    <!-- We now have use of $conn for mysqli functions -->
    <?php include("PHPs/query.getforemen.inc.php"); ?>
    <!-- This gives use of $ForemanCount and $Foreman_ -->
</head>
<body>

<form action="verifyfr.php" method ="POST" id="createform" name="create">
<div class="main-container center">
    
	<h1>New Foreman Report</h1>
	<div id="accordion">

<!-- JOBINFO SECTION -->
        <h3>Job Info</h3>
		<section>
          	<div class="jobinfo">
				<ul>
                    <li>
                        <label for="Foreman">Select:</label>
                        <select name="Foreman" id="foreman">
                            <option value="Foreman">Foreman</option>
                            <?php
                            for ($f = 1; $f <= $ForemanCount; $f++) {
                                echo "<option value='${Foreman.$f}'>${Foreman.$f}</option>";
                            }
                            ?>
                        </select>
                    </li>    
                    <li><label for="JobName">Job Name: </label><input name="JobName" type="text" /></li>
                    <li><label for="JobNum">Job #: </label><input name="JobNum" type="text" /></li>
                </ul>
				<ul>
                    <li><label for="Temp">Temp: </label><input name="Temp" type="text" /></li>
                    <li><label for="Grade">Grade: </label><input name="Grade" type="text" /></li>
                    <li><label for="Date">Date: </label><input name="Date" id="datepicker" type="text" autocomplete="off" /></li>
				</ul>
             </div>
		</section> <!-- CLOSE "Job Info" SECTION -->

<!-- EMPLOYEES SECTION -->
		<h3>Employee Info</h3>
		<section>
			<div class="employees">                
                <?php include ('PHPs/print.emp.inc.php'); ?>
            </div>
            <button type="button" onClick="addEmpLine(3)" id="NextEmpLineBUTTON">Add Employee</button> 
        </section> <!-- CLOSE "Employee Info" section SECTION -->
        
<!-- EQUIPMENT SECTION -->
		<h3>Equipment Info</h3>
		<section>
			<div class="equipment">
                <?php include ('PHPs/print.equip.inc.php'); ?>
            </div>
            <button type="button" onClick="addEqLine(3)" id="NextEqLineBUTTON">Add Equipment</button>
        </section> <!-- CLOSE "Equipment Info" section SECTION -->
        
<!-- TRUCKING SECTION -->
		<h3>Trucking Info</h3>
		<section>
			<div class="trucks">
                <?php include ('PHPs/print.truck.inc.php'); ?>
            </div>
            <button type="button" onClick="addTLine(3)" id="NextTLineBUTTON" style="margin-top:15px">Add Truck Line</button>
		</section> <!-- CLOSE "Trucking Info" section SECTION -->
        
<!-- REPORT SECTION -->
		<h3>Report Details</h3>
		<section>
			<div class="report">
                <ul>
                    <li><label for="ActualFR">Report Details:</label>
                        <textarea name="ActualFR" form="createform" rows="6" cols="25"></textarea></li>
                </ul>
                <ul>
                    <li><label for="ExtrasConcerns">Extras/ Concerns:</label>
                        <textarea name="ExtrasConcerns" form="createform" rows="6" cols="20"></textarea></li>
                </ul>
			</div>
		</section> <!-- CLOSE "Report Details" section SECTION -->
	</div> <!-- CLOSE #accordion DIV -->
	<button type="submit" id="submitButton" form="createform">Submit Report</button>
</div> <!-- CLOSE .main-container DIV -->
</form>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.js"></script>
    <script src="Files/FRscripts.js"></script>
</body>
</html>