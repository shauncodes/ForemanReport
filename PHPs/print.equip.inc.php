<?php

for ($e = 1, $c = 1; $e < 11; $e++, $c++) {
    if ($c <= 2) {
        $class = "";
    } else {
        $class = "hidden";
    }
    echo "
        <ul id='EquipUL-".$e."' class='".$class."'>
            <li>
                <label for='Equip".$e."'>Select</label>
                <select name='Equip".$e."' id='Equip".$e."'>
                    <option selected>Equip ID</option>";
    
    $equip_sql =    "SELECT equipment.EID
                    FROM equipment";
    $result = $conn->query($equip_sql);
    if ($result->num_rows > 0 ) {
        while ($row = $result->fetch_assoc()) {
            echo   "<option>".$row["EID"]."</option>";
        }
    }
        
    echo "      </select>
            </li>
            <li><label for='EquipOdoStart".$e."'>Odo start: </label><input id='EquipOdoStart".$e."' name='EquipOdoStart".$e."' type='text' /></li>
            <li><label for='EquipOdoEnd".$e."'>Odo end: </label><input id='EquipOdoEnd".$e."' name='EquipOdoEnd".$e."' onFocusOut='totalOdo(".$e.");' type='text' /></li>
            <li><div id='EquipOdoTotal".$e."' class='leftpad50'></div><input name='EquipOdoTotal".$e."' class='hidden' type='text' /></li>
        </ul>";
}

?>