<?php
for ($e = 1, $c = 1; $e < 21; $e++, $c++) {
    if ($c <= 2) {
        $class = "";
    } else {
        $class = "hidden";
    }
    $category = 2;
    echo "<ul id='TruckUL-".$e."'class='".$class."'>
            <li><label for='Truck".$e."'>Truck: </label><input name='Truck".$e."' type='text' /></li>
            <li><label for='TruckTimeIn".$e."'>Start time: </label><input id='TruckTimeIn".$e."' name='TruckTimeIn".$e."' class='timepicker' autocomplete='off' type='text' /></li>
            <li><label for='TruckTimeOut".$e."'>End time: </label><input id='TruckTimeOut".$e."' name='TruckTimeOut".$e."' class='timepicker' onFocusOut='totalTime(".$category.", ".$e.")' autocomplete='off' type='text' /></li>
            <li><div id='TruckTotal".$e."' class='leftpad50'></div><input name='TruckTotal".$e."' class='hidden' type='text' /></li>
            <li><label for='TruckProd".$e."'>Hauled: </label><input name='TruckProd".$e."' type='text' /></li>
            <li><label for='TruckLoc".$e."'>Pit/Plant: </label><input name='TruckLoc".$e."' type='text' /></li>
            <li><label for='TruckTons".$e."'>Tonnage: </label><input name='TruckTons".$e."' type='text' /></li>                    
        </ul>";
    }
?>