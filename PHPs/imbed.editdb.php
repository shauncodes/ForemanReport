
<html lang="en">
<head>
    <!--<link rel="stylesheet" type="text/css" href="../Files/admin.css">-->
    <?php include("dbconnect.fr.inc.php"); ?>
    <!-- We now have use of $conn for mysqli functions -->
    <?php include("query.getforemen.inc.php"); ?>
    <!-- This gives use of $ForemanCount and $Foreman_ -->
    <?php include("query.getequips.inc.php"); ?>
    <!-- This gives use of $EquipCount and $Equip_ -->
    <?php include("query.getemployees.inc.php"); ?>
    <!-- This gives use of $EmpCount and $Emp_ -->
</head>
<body>


<br /><br />

<?php
    

if (isset($_GET["edit"]) && ($_GET["edit"] == "foremen")) {
    if (isset($_GET["f"])) {
        //echo "<br />";
        $Foreman = $_GET["f"];
        if ($Foreman == "Add a foreman") {
            echo <<<HSD
                <h5>Add foreman</h5>
                <form name="UpdateDB" method="POST" action="PHPs/imbed.updatedb.php?add=foreman">
                    <input type="text" name="Name" value="Foreman Name" onFocus="this.value='';" autocomplete="off" required /> <br /><br />
                    <label for="Still">Set as: </label> <br />
                        <input type="radio" name="Status" value="1" required /> Foreman <br />
                        <input type="radio" name="Status" value="0" /> Not a foreman <br /><br />
                        <input type="submit" value="Submit Changes" id="UpdateDBBUTTON" />
                </form>
HSD;
        } else {
            $foreman_sql =    "SELECT *
                            FROM foreman
                            WHERE foreman.Name = '$Foreman'";
            $result = $conn->query($foreman_sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $fid = $row["fid"];
                    $StillForeman = $row["StillForeman"];
                }
            }
            if ($StillForeman == 1) {
                $StatYes = "checked";
                $StatNo = "";
            } else if ($StillForeman == 0) {
                $StatYes = "";
                $StatNo = "checked";
            }
            echo <<<HSD
                <h5>Edit foreman</h5>
                <form name="UpdateDB" method="POST" action="PHPs/imbed.updatedb.php?edit=foreman">
                    <input type="text" name="fid" value="$fid" class="hidden" />
                    <input type="text" name="Name" value="$Foreman" /> <br /><br />
                    <label for="Still">Set as: </label> <br />
                        <input type="radio" name="Status" value="1" $StatYes /> Still a foreman <br />
                        <input type="radio" name="Status" value="0" $StatNo /> No longer a foreman <br /><br />
                        <input type="submit" value="Submit Changes" id="UpdateDBBUTTON" />
                </form>
HSD;
        }
    } else {
        echo <<<HearSayDoc
        <h5>Choose foreman</h5>
        <select onChange="loadDoc('PHPs/imbed.editdb.php?edit=foremen&f='+this.value, displayTwo);">
            <option>-- Select --</option>
            <option value="Add a foreman">Add a foreman</option>
HearSayDoc;
        for ($f = 1; $f <= $ForemanCount; $f++) {
            echo <<<HSD
            <option value="${'Foreman'.$f}">${'Foreman'.$f}</option>;
HSD;
        }
        echo "</select>";
    }
} else if (isset($_GET["edit"]) && ($_GET["edit"] == "employees")) {
    if (isset($_GET["e"])) {
        //echo "<br />";
        $Employee = $_GET["e"];
        if ($Employee == "Add employee") {
            echo <<<HSD
                <h5>Add employee</h5>
                <form name="UpdateDB" method="POST" action="PHPs/imbed.updatedb.php?add=employee">
                    <input type="text" name="Name" value="Employee Name" onFocus="this.value='';" autocomplete="off" required /> <br /><br />
                    <label for="Still">Set as: </label> <br />
                        <input type="radio" name="Status" value="1" required /> Employed <br />
                        <input type="radio" name="Status" value="0" /> Not employed <br /><br />
                        <input type="submit" value="Submit Changes" id="UpdateDBBUTTON" />
                </form>
HSD;
        } else {
            $emp_sql =    "SELECT *
                            FROM employee
                            WHERE employee.Name = '$Employee'";
            $result = $conn->query($emp_sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $empid = $row["empid"];
                    $StillEmployed = $row["StillEmployed"];
                }
            }
            if ($StillEmployed == 1) {
                $StatYes = "checked";
                $StatNo = "";
            } else if ($StillEmployed == 0) {
                $StatYes = "";
                $StatNo = "checked";
            }
            echo <<<HSD
                <h5>Edit employee</h5>
                <form name="UpdateDB" action="PHPs/imbed.updatedb.php?edit=employee" method="POST">
                    <input type="text" name="empid" value="$empid" class="hidden" />
                    <input type="text" name="Name" value="$Employee" /> <br /><br />
                    <label for="Still">Set as: </label> <br />
                        <input type="radio" name="Status" value="1" $StatYes /> Still employed <br />
                        <input type="radio" name="Status" value="0" $StatNo /> No longer employed <br /><br />
                        <input type="submit" value="Submit Changes" />
                </form>
HSD;
        }
    } else {
        echo <<<HearSayDoc
        <h5>Choose employee</h5>
        <select onChange="loadDoc('PHPs/imbed.editdb.php?edit=employees&e='+this.value, displayTwo);">
            <option>-- Select --</option>
            <option value="Add employee">Add employee</option>
HearSayDoc;
        for ($n = 1; $n <= $EmpCount; $n++) {
            echo <<<HSD
            <option value="${'Emp'.$n}">${'Emp'.$n}</option>;
HSD;
        }
        echo "</select>";
    }
} else if (isset($_GET["edit"]) && ($_GET["edit"] == "equipment")) {
    if (isset($_GET["eq"])) {
        //echo "<br />";
        $Equip = $_GET["eq"];
        if ($Equip == "Add equipment") {
            echo <<<HSD
                <h5>Add equipment</h5>
                <form name="UpdateDB" action="PHPs/imbed.updatedb.php?add=equipment" method="POST">
                    <input type="text" name="EID" value="Equip ID" onFocus="this.value='';" />
                    <input type="text" name="Year" value="Year" onFocus="this.value='';" />
                    <input type="text" name="Make" value="Make" onFocus="this.value='';" />
                    <input type="text" name="Model" value="Model" onFocus="this.value='';" /><br /><br />
                    <label for="Still">Set as: </label> <br />
                        <input type="radio" name="Status" value="1" /> In service <br />
                        <input type="radio" name="Status" value="0" /> Not in service <br /><br />
                        <input type="submit" value="Submit Changes" />
                </form>
HSD;
            
        } else {
            $equip_sql =    "SELECT *
                            FROM equipment
                            WHERE equipment.EID = '$Equip'";
            $result = $conn->query($equip_sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $eqid = $row["eqid"];
                    $Year = $row["Year"];
                    $Make = $row["Make"];
                    $Model = $row["Model"];
                    $StillInService = $row["StillInService"];
                }
            }
            if ($StillInService == 1) {
                $StatYes = "checked";
                $StatNo = "";
            } else if ($StillInService == 0) {
                $StatYes = "";
                $StatNo = "checked";
            }
            echo <<<HSD
                <h5>Edit equipment</h5>
                <form name="UpdateDB" action="PHPs/imbed.updatedb.php?edit=equipment" method="POST">
                    <input type="text" name="eqid" value="$eqid" class="hidden" />
                    <input type="text" name="EID" value="$Equip" />
                    <input type="text" name="Year" value="$Year" />
                    <input type="text" name="Make" value="$Make" />
                    <input type="text" name="Model" value="$Model" /><br /><br />
                    <label for="Still">Set as: </label> <br />
                        <input type="radio" name="Status" value="1" $StatYes /> Still in service <br />
                        <input type="radio" name="Status" value="0" $StatNo /> No longer in service <br /><br />
                        <input type="submit" value="Submit Changes" />
                </form>
HSD;
        }
    } else {
        echo <<<HearSayDoc
        <h5>Choose equipment</h5>
        <select onChange="loadDoc('PHPs/imbed.editdb.php?edit=equipment&eq='+this.value, displayTwo);">
            <option>-- Select --</option>
            <option value="Add equipment">Add equipment</option>
HearSayDoc;
        for ($eq = 1; $eq <= $EquipCount; $eq++) {
            echo <<<HSD
            <option value="${'EquipID'.$eq}">${'EquipID'.$eq}</option>;
HSD;
        }
        echo "</select>";
    }
}

?>

</body>
</html>