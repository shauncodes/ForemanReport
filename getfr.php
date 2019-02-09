<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">
    <title>Close this to go back</title>
	<link rel="stylesheet" type="text/css" href="Files/normalize.css">
	<link rel="stylesheet" type="text/css" href="Files/FRdisplay.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <?php include("PHPs/query.getfr.inc.php"); ?>
    <!-- This gives us every PHP variable used in this page. -->
</head>
<body>

<div class="main-container">
    <div class="header">
        <div></div>
        <div><h1>Foreman Report</h1></div>
        <div>
            <p></p>
        </div>
    </div>
    
<!-- JOB INFO SECTION -->
    <h4>Job Info</h4>
    <div class="jobinfo">
        <ul>
            <li><label for="Foreman">Foreman: </label><div name="Foreman" class="report-info"><?php echo $Foreman; ?></div></li>    
            <li><label for="JobName">Job Name: </label><div name="JobName" class="report-info"><?php echo $JobName; ?></div></li>
            <li><label for="JobNum">Job #: </label><div name="JobNum" class="report-info"><?php echo $JobNum; ?></div></li>
        </ul>
        <ul>
            <li><label for="Temp">Temp: </label><div name="Temp" class="report-info"><?php echo $Temp; ?></div></li>
            <li><label for="Grade">Grade: </label><div name="Grade" class="report-info"><?php echo $Grade; ?></div></li>
            <li><label for="Date">Date: </label><div name="Date" class="report-info"><?php echo $DayOfWeek." ".$Date; ?></div></li>
        </ul>
    </div>
    
<!-- EMPLOYEE SECTION -->
    <h4>Employee Info</h4>
    <div class="employee">
         <ul>
             <li>Employee</li>
            <li>Time in</li>
            <li>Time out</li>
            <li>Total</li>
        </ul>
    <?php
    $e = 1;
    if (isset(${"Emp".$e})) {
        for ($e = 1; (${"Emp".$e} != NULL); $e++) {
            echo "<ul>
                    <li><div class='report-info'>" . ${"Emp".$e} . "</div></li>
                    <li><div class='report-info'>" . ${"TimeIn".$e} . "</div></li>
                    <li><div class='report-info'>" . ${"TimeOut".$e} . "</div></li>
                    <li><div class='report-info'>" . ${"Total".$e} . "</div></li>
                </ul>";
           }
    }
    ?>
    </div>

<!-- EQUIPMENT SECTION -->
    <h4>Equipment Info</h4>
    <div class="equipment">
        <ul>
            <li>Equipment ID</li>
            <li>Odo start</li>
            <li>Odo end</li>
            <li>Total used</li>
        </ul>
    <?php
    $e = 1;
    if (isset(${"Equip".$e})) {
        for ($e = 1; ${"Equip".$e} != NULL; $e++) {
            echo "
                <ul>
                    <li><div class='report-info'>" . ${"Equip".$e} . "</div></li>
                    <li><div class='report-info'>" . ${"OdoStart".$e} . "</div></li>
                    <li><div class='report-info'>" . ${"OdoEnd".$e} . "</div></li>
                    <li><div class='report-info'>" . ${"OdoTotal".$e} . "</div></li>
                </ul>";
        }
    }
    ?>   
        </div>

<!-- TRUCKING SECTION -->
    <h4>Trucking</h4>    
    <div class="trucks">
        <ul>
            <li>Truck ID</li>
            <li>Time in</li>
            <li>Time out</li>
            <li>Total time</li>
            <li>Product</li>
            <li>Pit/Plant</li>
            <li>Tonnage</li>                    
        </ul>
    <?php
    $t = 1;
    if (isset(${"Truck".$t})) {
        for ($t=1; ${"Truck".$t} != NULL; $t++) {
            echo "<ul>
                    <li><div class='report-info'>" . ${"Truck".$t} . "</div></li>
                    <li><div class='report-info'>" . ${"TTimeIn".$t} . "</div></li>
                    <li><div class='report-info'>" . ${"TTimeOut".$t} . "</div></li>
                    <li><div class='report-info'>" . ${"TTotal".$t} . "</div></li>
                    <li><div class='report-info'>" . ${"Prod".$t} . "</div></li>
                    <li><div class='report-info'>" . ${"Loc".$t} . "</div></li>
                    <li><div class='report-info'>" . ${"Tons".$t} . "</div></li>                    
                </ul>";
        }
    }
    ?>
        
    </div>
<!-- REPORT SECTION -->
    <h4>Report Details</h4>
    <div class="report">
        <ul>
            <li>Foreman Report</li>
            <li>Extras/ Concerns</li>
        </ul>
        <ul>
            <li><div class="report-info"><?php echo $ActualFR; ?></div></li>
            <li><div class="report-info"><?php echo $ExtrasConcerns; ?></div></li>
        </ul>
    </div>
   
</div><!-- CLOSING main-container DIV -->
<div class="center">
    <div>
    </div>
    <div id="timestamp">
        <?php echo $TimeStamp; ?>
        <p id="ipstamp"><?php echo $IpAddress; ?></p>
    </div>
</div>

    
</body>
</html>