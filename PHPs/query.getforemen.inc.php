<?php

include ("dbconnect.fr.inc.php");
// We now have use of $conn for mysqli functions

$foreman_sql =  "SELECT foreman.Name
                FROM foreman
                WHERE foreman.StillForeman = 1";
$result = $conn->query($foreman_sql);
if ($result->num_rows > 0 ) {
    $ForemanCount = $result->num_rows;
    $f = 1;
    while ($row = $result->fetch_assoc()) {
        ${"Foreman".$f} = $row["Name"];
        $f++;
    }
}

?>