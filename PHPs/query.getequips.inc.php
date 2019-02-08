<?php

include ("dbconnect.fr.inc.php");
// We now have use of $conn for mysqli functions

$equip_sql =    "SELECT equipment.EID
                FROM equipment";
$result = $conn->query($equip_sql);
if ($result->num_rows > 0 ) {
    $EquipCount = $result->num_rows;
    $eq = 1;
    while ($row = $result->fetch_assoc()) {
        ${"EquipID".$eq} = $row["EID"];
        $eq++;
    }
}

?>