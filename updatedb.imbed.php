<?php
include("PHPs/dbconnect.fr.inc.php");

$UpdateHere = $_GET["edit"];

if ($UpdateHere == "foreman") {
    $fid = $_POST["fid"];
    $Foreman = $_POST["Name"];
    $Status = $_POST["Status"];
    
    $update_foreman_sql =   "UPDATE foreman
                            SET Name = '$Foreman', StillForeman = $Status
                            WHERE fid = '$fid'";
    $update_foreman_result = $conn->query($update_foreman_sql);
    if ($update_foreman_result) {
        echo "Successfully updated Foreman record for " . $Foreman;
        echo "<script type='text/javascript'>
            window.location = 'admin.php';
            </script>";
    }

} else if ($UpdateHere == "employee") {
    $empid = $_POST["empid"];
    $Employee = $_POST["Name"];
    $Status = $_POST["Status"];

    $update_employee_sql =   "UPDATE employee
                            SET Name = '$Employee', StillEmployed = $Status
                            WHERE empid = '$empid'";
    $update_employee_result = $conn->query($update_employee_sql);
    if ($update_employee_result) {
        echo "Successfully updated Employee record for " . $Employee;
        echo "<script type='text/javascript'>
            window.location = 'admin.php';
            </script>";
    }

} else if ($UpdateHere == "equipment") {
    $eqid = $_POST["eqid"];
    $EquipID = $_POST["EID"];
    $Year = $_POST["Year"];
    $Make = $_POST["Make"];
    $Model = $_POST["Model"];
    $Status = $_POST["Status"];
    
    $update_equip_sql =   "UPDATE equipment
                            SET EID = '$EquipID', Year = '$Year', Make = '$Make', Model = '$Model', StillInService = $Status 
                            WHERE eqid = '$eqid'";
    $update_equip_result = $conn->query($update_equip_sql);
    if ($update_equip_result) {
        echo "Successfully updated Equipment record for " . $EquipID;
        echo "<script type='text/javascript'>
            window.location = 'admin.php';
            </script>";
    } else {
        echo $eqid;
    }

} else {
    echo "How did you get here?";
}



?>