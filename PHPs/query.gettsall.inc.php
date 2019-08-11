<?php
// We already have use of $Date1-$Date7 via 'work.gettsdates.inc.php'

$allEmployees_sql = "SELECT DISTINCT(employee.Name)
            FROM employee
            JOIN empjob ON empjob.fk_empid = employee.empid
            JOIN report ON report.rid = empjob.fk_rid
            JOIN foreman ON foreman.fid = report.fk_fid
            WHERE (report.Date = '$Date1'
                OR report.Date = '$Date2' OR report.Date = '$Date3'
                OR report.Date = '$Date4' OR report.Date = '$Date5'
                OR report.Date = '$Date6' OR report.Date = '$Date7')
                ORDER BY employee.Name ASC";
$allEmps_result = $conn->query($allEmployees_sql);
if ($allEmps_result->num_rows > 0) {
    $e = 1;
    while ($row = $allEmps_result->fetch_assoc()) {
        ${"Emp".$e} = $row["Name"];
        $e++;
    }
}



?>