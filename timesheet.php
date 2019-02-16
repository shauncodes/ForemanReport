<!doctype html>
<html lang="en">
<head>
	<title>Close this to go back</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="Files/normalize.css">
	<link rel="stylesheet" type="text/css" href="Files/TSmain.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.css">
    <?php

    include("PHPs/dbconnect.fr.inc.php");
    // We now have use of $conn for mysqli functions
    include("PHPs/query.getforemen.inc.php");
    // This gives use of $ForemanCount and $Foreman_ for the selectbox
    if (isset($_POST["Foreman"]) && isset($_POST["Date"])) {
        include("PHPs/work.gettsdates.inc.php");
        // This gives use of $Day1-$Day7 and $Date1-$Date7
        include("PHPs/query.getts.inc.php");
        // This queries the DB for all employees with jobs under selected
        // $Foreman for $Date1-$Date7.
    }
    ?>
</head>
<body>


<div class="center gridcontainer"> <!-- GRID CONTAINER -->

<!-- *************** FIRST ROW *************** -->
<!-- This row is the datepicker() input box -->
	<div class="r1c1">
	</div>
	<div class="r1c2">
	</div>
	<div class="header">
        
        <?php
        if (!isset($_POST["Date"])) {
            echo "
        <form action='timesheet.php' method='POST' id='createtsFORM'>
			<p>Foreman: 
				<select id='foreman' name='Foreman' required>
					<option>-- select --</option>";
            for ($f = 1; $f <= $ForemanCount; $f++) {
                echo "
                    <option value='${Foreman.$f}'>${Foreman.$f}</option>";
            }
            echo "
				</select>
			</p>
			<p>Time Sheet for week starting on: <input id='datepicker' name='Date' type='text' size='15' autocomplete='off' required />
			</p>
            <p>
                <input type='submit' name='getTS' id='TSBUTTON' value='Get Timesheet' />
            </p>
        </form>";
        } else {
            echo "<a class='print-hide' href='timesheet.php'>Start Over</a>";
        }
        ?>
                        
      

	</div>

<!-- *************** SECOND ROW *************** -->
<!-- This row is for the Days and Dates -->

	<div class="r2c1">
		<img src="Files/bfplogo.png" width="140px">
	</div>
	<div class="r2c2 leftblackborder">
		<div class="theday">
			Monday
		</div>
		<div id="Mon" class="thedate">
            <?php if(isset($Day1)){echo $Day1;}; ?>
		</div>
	</div>
	<div class="r2c3 leftblackborder">
		<div class="theday">
			Tuesday
		</div>
		<div id="Tues" class="thedate">
            <?php if(isset($Day2)){echo $Day2;}; ?>
		</div>
	</div>
	<div class="r2c4 leftblackborder">
		<div class="theday">
			Wednesday
		</div>
		<div id="Wed" class="thedate">
            <?php if(isset($Day3)){echo $Day3;}; ?>
		</div>
	</div>
	<div class="r2c5 leftblackborder">
		<div class="theday">
			Thursday
		</div>
		<div id="Thur" class="thedate">
            <?php if(isset($Day4)){echo $Day4;}; ?>
		</div>
	</div>
	<div class="r2c6 leftblackborder">
		<div class="theday">
			Friday
		</div>
		<div id="Fri" class="thedate">
            <?php if(isset($Day5)){echo $Day5;}; ?>
		</div>
	</div>
	<div class="r2c7 leftblackborder">
		<div class="theday">
			Saturday
		</div>
		<div id="Sat" class="thedate">
            <?php if(isset($Day6)){echo $Day6;}; ?>
		</div>
	</div>
	<div class="r2c8 leftblackborder rightblackborder">
		<div class="theday">
			Sunday
		</div>
		<div id="Sun" class="thedate">
            <?php if(isset($Day7)){echo $Day7;}; ?>
		</div>
	</div>

<!-- *************** THIRD ROW *************** -->
<!-- *****		THE ROW TO DUPLICATE	****** -->

<?php
    
// FUNCTION to print the timesheet. Fucking Brilliant!
for ($e = 1, $r = 3; isset(${"Emp".$e}); $e++, $r++) {
    echo "<div class='r".$r."c1 blackborder'>
			<div id=''>" . ${"Emp".$e} . "</div>
		</div>";
    
    for ($d = 1, $c = 2, $j = 1; $d < 8; $d++, $c++, $j = 1) {
        echo "
        <div class='r".$r."c".$c." blackborder actualinput'> <!-- THIS DIV HOLDS ALL 3 JOBS -->";
        
        $Employee = ${"Emp".$e};
        $Date = ${"Date".$d};
        $employee_sql = "SELECT report.JobNum, empjob.TimeIn, empjob.TimeOut, empjob.Total
                     FROM empjob
                     JOIN employee ON employee.empid = empjob.fk_empid
                     JOIN report ON report.rid = empjob.fk_rid
                     JOIN foreman ON foreman.fid = report.fk_fid
                         WHERE report.Date = '$Date' AND employee.Name = '$Employee' AND foreman.Name = '$Foreman'";
        $employee_result = $conn->query($employee_sql);
        if ($employee_result->num_rows > 0 ) {
            while ($row = $employee_result->fetch_assoc()) {
                $GetApproval = "yes";
                echo "<div class='job".$j."'> <!-- JOB 1 -->
                        ".$row["TimeIn"]." ".$row["JobNum"]." ".$row["TimeOut"]." ".$row["Total"]."
                    </div>";
                $j++;
            }
        }
    echo "
        </div>";
    }
}

?>

	<div class="r13c1">
	</div>
	<div class="r13c2">
        <?php
        
        if (isset($GetApproval)) {
            
            $CheckForApproval = "SELECT *
                                FROM approved
                                WHERE Foreman = '$Foreman' AND Date = '$Date1'";
            $result = $conn->query($CheckForApproval);
            if ($result->num_rows > 0) {
                echo "<div class='approved'>Approved by Mark Fotou <uhh>✔</uhh></div>";
            } else {
            echo <<<HSD
                <form name="super" method="POST" action="approvets.php">
                    <input type="text" name="Foreman" value="$Foreman" class="hidden" />
                    <input type="text" name="Date" value="$Date1" class="hidden" />
                    <input type="password" name="SuperKey" size="12" />
                    <input type="submit" value="Superintendent Approval" />
                </form>
HSD;
            }
        }
        
        
        ?>
	</div>

</div> <!-- CLOSE THE GRID CONTAINER -->

<br /><br />

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.js"></script>
	<script src="Files/TSscripts.js"></script>

</body>
</html>


