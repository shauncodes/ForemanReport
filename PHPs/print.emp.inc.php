<?php

for ($e = 1, $c = 1; $e < 11; $e++, $c++) {
    if ($c <= 2) {
        $class = "";
    } else {
        $class = "hidden";
    }    
    echo "
        <ul id='EmpUL-".$e."' class='".$class."'>
            <li>
                <label for='Emp".$e."'>Select: </label>
                <select name='Emp".$e."' id='Emp".$e."' />
                    <option selected>Employee</option>";
        
    $emp_sql = "SELECT employee.Name
                FROM employee";
    $result = $conn->query($emp_sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo   "<option>".$row["Name"]."</option>";
        }
    }
    $category = 1;   
    echo "      </select>
            </li>
            <li><label for='EmpTimeIn".$e."'>Time in: </label><input id='EmpTimeIn".$e."' name='EmpTimeIn".$e."' class='timepicker' autocomplete='off' type='text' /></li>
            <li><label for='EmpTimeOut".$e."'>Time out: </label><input id='EmpTimeOut".$e."' name='EmpTimeOut".$e."' class='timepicker' onFocusOut='totalTime(".$category.", ".$e.");' autocomplete='off' type='text' /></li>
            <li><div id='EmpTotal".$e."' class='leftpad50'></div><input name='EmpTotal".$e."' class='hidden'  type='text' /></li>
        </ul>"; 
}

?>