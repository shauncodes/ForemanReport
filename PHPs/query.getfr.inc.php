<?php
include("dbconnect.fr.inc.php");

if (isset($_GET["r"])) {
    $ReportNum = $_GET["r"];
    // Get foreman for report.rid = "r"
    $ForemanName = $conn->query("SELECT foreman.Name
                            FROM foreman
                            JOIN report ON report.fk_fid=foreman.fid
                            WHERE report.rid=$ReportNum");
    while ($row = $ForemanName->fetch_assoc()) {
        $Foreman = $row["Name"];
    }
    // Get main report for report.rid = "r"
    $report_sql = "SELECT * FROM report WHERE report.rid = $ReportNum";
    $result = $conn->query($report_sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $JobName = $row["JobName"];
            $JobNum = $row["JobNum"];
            $Date = $row["Date"];
            $Temp = $row["Temp"];
            $Grade = $row["Grade"];
            $ActualFR = $row["ActualFR"];
            $ExtrasConcerns = $row["ExtrasConcerns"];
            $DayOfWeek = $row["DayOfWeek"];
            $TimeStamp = $row["TimeStamp"];
            $IpAddress = $row["IpAddress"];
        }
    }
    
    
    
    // Get all records from empjobs table for report.rid = "r"
    $employee_sql = "SELECT *
                    FROM empjob
                    JOIN report ON empjob.fk_rid=report.rid
                    WHERE empjob.fk_rid = $ReportNum";
    $result = $conn->query($employee_sql);
    if ($result->num_rows > 0) {
        $e = 1;
        while ($row = $result->fetch_assoc()) {
            $EmpID = $row["fk_empid"];
            $emp_name_sql = "SELECT employee.Name
                            FROM employee
                            WHERE employee.empid = '$EmpID'";
            $emp_result = $conn->query($emp_name_sql);
            if ($emp_result->num_rows > 0) {
                while ($row2 = $emp_result->fetch_assoc()) {
                    ${"Emp".$e} = $row2["Name"];
                }
            }
            ${"TimeIn".$e} = $row["TimeIn"];
            ${"TimeOut".$e} = $row["TimeOut"];
            ${"Total".$e} = $row["Total"];
            $e++;
        }
        ${"Emp".$e} = NULL;
    }
    
    
    
    // Get all records from equipjob table for report.rid = "r"
    $equip_sql =    "SELECT *
                    FROM equipjob
                    JOIN report ON equipjob.fk_rid=report.rid
                    WHERE equipjob.fk_rid = $ReportNum";
    $result = $conn->query($equip_sql);
    if ($result->num_rows > 0) {
        $eq = 1;
        while ($row = $result->fetch_assoc()) {
            $EquipID = $row["fk_eqid"];
            $equip_eid_sql =    "SELECT equipment.EID
                                FROM equipment
                                WHERE equipment.eqid = '$EquipID'";
            $equip_result = $conn->query($equip_eid_sql);
            if ($equip_result->num_rows > 0) {
                while ($row2 = $equip_result->fetch_assoc()) {
                    ${"Equip".$eq} = $row2["EID"];
                }
            }
            ${"OdoStart".$eq} = $row["OdoStart"];
            ${"OdoEnd".$eq} = $row["OdoEnd"];
            ${"OdoTotal".$eq} = $row["OdoTotal"];
            $eq++;
        }
        ${"Equip".$eq} = NULL;
    }
    
    
    
    // Get all records from truckjob table for report.rid = "r"
    $truck_sql =    "SELECT *
                    FROM truckjob
                    JOIN report ON truckjob.fk_rid=report.rid
                    WHERE truckjob.fk_rid = $ReportNum";
    $result = $conn->query($truck_sql);
    if($result->num_rows > 0) {
        $t = 1;
        while ($row = $result->fetch_assoc()) {
            ${"Truck".$t} = $row["Truck"];
            ${"TTimeIn".$t} = $row["TTimeIn"];
            ${"TTimeOut".$t} = $row["TTimeOut"];
            ${"TTotal".$t} = $row["TTotal"];
            ${"Prod".$t} = $row["Prod"];
            ${"Loc".$t} = $row["Loc"];
            ${"Tons".$t} = $row["Tons"];
            $t++;
        }
        ${"Truck".$t} = NULL;
    }
}

?>	