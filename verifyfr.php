<!doctype html>

<html lang="en">
<head>
	<title>Verify Foreman Report</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.css">
	<link rel="stylesheet" type="text/css" href="Files/normalize.css">
	<link rel="stylesheet" type="text/css" href="Files/FRdisplay.css">
    
</head>
<body>

<form action="insertfr.php" method="POST" id="createform" name="Create">
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
            <li><label for="Foreman">Foreman: </label><input name="Foreman" value="<?php echo $_POST['Foreman']; ?>" id="foreman" type="text" required/></li>    
            <li><label for="JobName">Job Name: </label><input name="JobName" value="<?php echo $_POST['JobName']; ?>" type="text" /></li>
            <li><label for="JobNum">Job #: </label><input name="JobNum" value="<?php echo $_POST['JobNum']; ?>" type="text" required/></li>
        </ul>
        <ul>
            <li><label for="Temp">Temp: </label><input name="Temp" value="<?php echo $_POST['Temp']; ?>" type="text" /></li>
            <li><label for="Grade">Grade: </label><input name="Grade" value="<?php echo $_POST['Grade']; ?>" type="text" /></li>
            <li><label for="Date">Date: </label><input name="Date" value="<?php echo $_POST['Date']; ?>" id="datepicker" type="text" autocomplete="off" required/></li>
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
for ($e = 1; isset($_POST["Emp".$e]) && ($_POST["Emp".$e] != "Employee"); $e++) {
    $category = 1;
    echo "
        <ul>
            <li><input name='Emp".$e."' value='".$_POST['Emp'.$e]."' type='text' /></li>
            <li><input id='EmpTimeIn".$e."' name='EmpTimeIn".$e."' value='".$_POST['EmpTimeIn'.$e]."' class='timepicker' onFocusOut='totalTime(".$category.", ".$e.");' autocomplete='off' type='text' /></li>
            <li><input id='EmpTimeOut".$e."' name='EmpTimeOut".$e."' value='".$_POST['EmpTimeOut'.$e]."' class='timepicker' onFocusOut='totalTime(".$category.", ".$e.");' autocomplete='off' type='text' /></li>
            <li><div id='EmpTotal".$e."'>".$_POST['EmpTotal'.$e]."</div><input class='hidden' name='EmpTotal".$e."' value='".$_POST['EmpTotal'.$e]."' type='text' /></li>
        </ul>"; 
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
for ($e = 1; isset($_POST["Equip".$e]) && ($_POST["Equip".$e] != "Equip ID"); $e++) {
    echo "
        <ul>
            <li><input name='Equip".$e."' value='".$_POST['Equip'.$e]."'></li>
            <li><input id='EquipOdoStart".$e."' name='EquipOdoStart".$e."' value='".$_POST['EquipOdoStart'.$e]."' onFocusOut='totalOdo(".$e.")' type='text' /></li>
            <li><input id='EquipOdoEnd".$e."' name='EquipOdoEnd".$e."' value='".$_POST['EquipOdoEnd'.$e]."' onFocusOut='totalOdo(".$e.")' type='text' /></li>
            <li><div id='EquipOdoTotal".$e."'>".$_POST['EquipOdoTotal'.$e]."</div><input name='EquipOdoTotal".$e."' class='hidden' value='".$_POST['EquipOdoTotal'.$e]."' type='text' /></li>
        </ul>";
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
for ($t = 1; isset($_POST["Truck".$t]) && ($_POST["Truck".$t] != ""); $t++) {
    $category = 2;
    echo "
        <ul>
            <li><input name='Truck".$t."' value='".$_POST['Truck'.$t]."' type='text' /></li>
            <li><input id='TruckTimeIn".$t."' name='TruckTimeIn".$t."' value='".$_POST['TruckTimeIn'.$t]."' class='timepicker' onFocusOut='totalTime(".$category.", ".$t.")' autocomplete='off' type='text' /></li>
            <li><input id='TruckTimeOut".$t."' name='TruckTimeOut".$t."' value='".$_POST['TruckTimeOut'.$t]."' class='timepicker' onFocusOut='totalTime(".$category.", ".$t.")' autocomplete='off' type='text' /></li>
            <li><div id='TruckTotal".$t."'>".$_POST['TruckTotal'.$t]."</div><input class='hidden' name='TruckTotal".$t."' value='".$_POST['TruckTotal'.$t]."' type='text' /></li>
            <li><input name='TruckProd".$t."' value='".$_POST['TruckProd'.$t]."' type='text' /></li>
            <li><input name='TruckLoc".$t."' value='".$_POST['TruckLoc'.$t]."' type='text' /></li>
            <li><input name='TruckTons".$t."' value='".$_POST['TruckTons'.$t]."' type='text' /></li>                    
        </ul>";
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
            <li><textarea name="ActualFR" form="createform" rows="8" cols="40" required><?php if(isset($_POST["ActualFR"])){echo $_POST["ActualFR"];} ?></textarea></li>
            <li><textarea name="ExtrasConcerns" form="createform" rows="8" cols="40"><?php if(isset($_POST["ExtrasConcerns"])){echo $_POST["ExtrasConcerns"];} ?></textarea></li>
        </ul>
    </div>
   
</div><!-- CLOSING main-container DIV -->
<div class="center">
    <div>
    <button type="submit" id="submitButton" form="createform">Submit Report</button>
    </div>
    <div id="timestamp">
    </div>
</div>
<div class="hiddeninputs">
    <input type="text" name="DayOfWeek" value="<?php echo $DayOfWeek; ?>" />
    <input type="text" name="TimeStamp" value="<?php echo date('Y-m-d H:i:s'); ?>" />
    <input type="text" name="IpAddress" value="<?php echo($_SERVER[REMOTE_ADDR]); ?>" />
</div>
</form>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.js"></script>
    <script src="Files/FRscripts.js"></script>   
</body>
</html>