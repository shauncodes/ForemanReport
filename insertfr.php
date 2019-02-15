
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "foremanreports";

// Start the connection.
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection Error : " . $conn->connect_error);
}

// Add the report section.
$Foreman = $_POST["Foreman"];
$Foreman = str_replace("'", "", $Foreman);
$ForemanNum = $conn->query("SELECT foreman.fid FROM foreman WHERE foreman.Name = '$Foreman'");
while($row = mysqli_fetch_assoc($ForemanNum)) {
    $fk_fid = $row["fid"];
}
$JobNum = $_POST["JobNum"];
$JobNum = str_replace("'", "", $JobNum);
$JobName = $_POST["JobName"];
$JobName = str_replace("'", "", $JobName);
$Temp = $_POST["Temp"];
$Temp = str_replace("'", "", $Temp);
$Grade = $_POST["Grade"];
$Grade = str_replace("'", "", $Grade);
$FullDate = $_POST["Date"];
$SplitDate = explode(" ", $FullDate);
$DayOfWeek = $SplitDate[0];
$DayOfWeek = str_replace("'", "", $DayOfWeek);
$Date = $SplitDate[1];
$Date = str_replace("'", "", $Date);
$ActualFR = $_POST["ActualFR"];
$ActualFR = str_replace("'", "", $ActualFR);
$ExtrasConcerns = $_POST["ExtrasConcerns"];
$ExtrasConcerns = str_replace("'", "", $ExtrasConcerns);
$TimeStamp = $_POST["TimeStamp"];
$TimeStamp = str_replace("'", "", $TimeStamp);
$IpAddress = $_POST["IpAddress"];
$IpAddress = str_replace("'", "", $IpAddress);

$report_sql = "INSERT INTO report (fk_fid,JobNum,JobName,Temp,Grade,Date,ActualFR,ExtrasConcerns,DayOfWeek,TimeStamp,IpAddress)
                VALUES ('$fk_fid','$JobNum','$JobName','$Temp','$Grade','$Date','$ActualFR','$ExtrasConcerns','$DayOfWeek','$TimeStamp','$IpAddress')";

if($conn->query($report_sql) === TRUE) {
    echo "Main report info added successfully. <br />";
    $fk_rid = $conn->insert_id;
} else {
    die("Error: " . $conn->error);
}



// Add the employee jobs.
for ($e = 1; isset($_POST["Emp".$e]) && ($_POST["Emp".$e] != ""); $e++) {	
    $Employee = $_POST["Emp".$e];
    $EmployeeNum = $conn->query("SELECT employee.empid FROM employee WHERE employee.Name = '$Employee'");
    while($row = mysqli_fetch_assoc($EmployeeNum)) {
        $fk_empid = $row["empid"];
    }
    $TimeIn = $_POST["EmpTimeIn".$e];
    $TimeOut = $_POST["EmpTimeOut".$e];
    $Total = $_POST["EmpTotal".$e];

    $employee_sql = "INSERT INTO empjob (fk_rid,fk_empid,TimeIn,TimeOut,Total)
                     VALUES('$fk_rid','$fk_empid','$TimeIn','$TimeOut','$Total')";

    if ($conn->query($employee_sql) === TRUE) {
        echo $e . " employee job row(s) added successfully. <br />";
    } else {
        die("Error: " . $conn->error);
    }
}



// Add the equipment jobs.
for ($eq = 1; isset($_POST["Equip".$eq]) && ($_POST["Equip".$eq] != ""); $eq++) {
    $Equip = $_POST["Equip".$eq];
    $Equip = strtoupper($Equip);
    $Equip = str_replace(" ", "", $Equip);
    $EquipNum = $conn->query("SELECT equipment.eqid FROM equipment WHERE equipment.EID = '$Equip'");
    while ($row = mysqli_fetch_assoc($EquipNum)) {
        $fk_eqid = $row["eqid"];
    }
    $OdoStart = $_POST["EquipOdoStart".$eq];
    $OdoEnd = $_POST["EquipOdoEnd".$eq];
    $OdoTotal = $_POST["EquipOdoTotal".$eq];
    
    $equip_sql =    "INSERT INTO equipjob (fk_eqid,fk_rid,OdoStart,OdoEnd,OdoTotal)
                    VALUES ('$fk_eqid','$fk_rid','$OdoStart','$OdoEnd','$OdoTotal')";
    
    if ($conn->query($equip_sql) === TRUE) {
        echo $eq . " equipment job row(s) added. <br />";
    } else {
        die("Error: " . $conn->error);
    }
}



// Add the trucking jobs.
for ($t = 1; isset($_POST["Truck".$t]) && ($_POST["Truck".$t] != ""); $t++) {
    $Truck = $_POST["Truck".$t];
    $TTimeIn = $_POST["TruckTimeIn".$t];
    $TTimeOut = $_POST["TruckTimeOut".$t];
    $TTotal = $_POST["TruckTotal".$t];
    $Prod = $_POST["TruckProd".$t];
    $Loc = $_POST["TruckLoc".$t];
    $Tons = $_POST["TruckTons".$t];
    
    $truck_sql = "INSERT INTO truckjob (fk_rid,fk_fk_fid,Truck,TTimeIn,TTimeOut,TTotal,Prod,Loc,Tons)
                    VALUES ('$fk_rid','$fk_fid','$Truck','$TTimeIn','$TTimeOut','$TTotal','$Prod','$Loc','$Tons')";
    
    if ($conn->query($truck_sql) === TRUE) {
        echo $t . " trucking job row(s) added. <br />";
    } else {
        die("Error: " . $conn->error);
    }
}

$conn->close();

echo "<br /><br /><br />";
echo "<script>setTimeout(function () { window.close(); }, 0100)</script>";
echo "<h1>Thank you, " . $Foreman . ". Please close this window.</h1>";


?>