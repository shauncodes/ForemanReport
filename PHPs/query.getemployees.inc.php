<?php

include ("dbconnect.fr.inc.php");
// We now have use of $conn for mysqli functions

$emp_sql = "SELECT employee.Name
            FROM employee
            WHERE employee.StillEmployed = 1";
$result = $conn->query($emp_sql);
if ($result->num_rows > 0) {
    $EmpCount = $result->num_rows;
    $e = 1;
    while ($row = $result->fetch_assoc()) {
        ${"Emp".$e} = $row["Name"];
        $e++;
    }
}

?>