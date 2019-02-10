
<html lang="en">
<head>
    <?php include("dbconnect.fr.inc.php"); ?>
    <!-- We now have use of $conn for mysqli functions -->
    <?php include("query.getforemen.inc.php"); ?>
    <!-- This gives use of $ForemanCount and $Foreman_ -->
</head>
<body>

<br /><br />


<?php
    
if (isset($_GET["m"])) {
    $Month = $_GET["m"];
    if ($Month == "January") {
        $StartDate = "2019-01-01";
        $EndDate = "2019-01-31";
    } else if ($Month == "February") {
        $StartDate = "2019-02-01";
        $EndDate = "2019-02-28";
    } else if ($Month == "March") {
        $StartDate = "2019-03-01";
        $EndDate = "2019-03-31";
    } else if ($Month == "April") {
        $StartDate = "2019-04-01";
        $EndDate = "2019-04-30";
    } else if ($Month == "May") {
        $StartDate = "2019-05-01";
        $EndDate = "2019-05-31";
    } else if ($Month == "June") {
        $StartDate = "2019-06-01";
        $EndDate = "2019-06-30";
    } else if ($Month == "July") {
        $StartDate = "2019-07-01";
        $EndDate = "2019-07-31";
    } else if ($Month == "August") {
        $StartDate = "2019-08-01";
        $EndDate = "2019-08-31";
    } else if ($Month == "September") {
        $StartDate = "2019-09-01";
        $EndDate = "2019-09-30";
    } else if ($Month == "October") {
        $StartDate = "2019-10-01";
        $EndDate = "2019-10-31";
    } else if ($Month == "November") {
        $StartDate = "2019-11-01";
        $EndDate = "2019-11-30";
    } else if ($Month == "December") {
        $StartDate = "2019-12-01";
        $EndDate = "2019-12-31";
    }
}

    
if (isset($_GET["f"])) {
    $Foreman = $_GET["f"];

    $report_sql = "SELECT rid, report.Date, report.JobNum
            FROM report
            JOIN foreman ON foreman.fid = report.fk_fid
            WHERE report.Date >= '$StartDate' 
                AND report.Date <= '$EndDate' 
                AND foreman.Name = '$Foreman'";
    $report_result = $conn->query($report_sql);
    if ($report_result->num_rows > 0) {
        echo "<h5>" . ucfirst($Foreman) . " | " .$Month. "</h5>";
        echo "<ul>";
        while ($row = $report_result->fetch_assoc()) {
            echo "<li><a target='new' href='getfr.php?r=".$row["rid"]."'>".$row["Date"]." - #".$row["JobNum"]."</a></li>";
        }
    }
    echo "</ul>";
} else if ((isset($Month)) && (!isset($Foreman))) {
    $foreman_sql = "SELECT DISTINCT foreman.Name
                    FROM foreman
                    JOIN report ON report.fk_fid = foreman.fid
                    WHERE report.Date >= '$StartDate' AND report.Date <= '$EndDate'";
    $foreman_result = $conn->query($foreman_sql);
    if ($foreman_result->num_rows > 0 ) {
        echo "<h5>".$Month." 2019</h5>";
        echo "<ul>";
        while ($row = $foreman_result->fetch_assoc()) {
            echo <<<HSD
                <li><a href='#' onclick="loadDoc('PHPs/imbed.2019reports.php?m=$Month&f=$row[Name]', displayThree);">$row[Name]</a></li>
HSD;        
        }
    }
    echo "</ul>";
} else {
    echo "<h5>2019 Reports</h5>";
    echo "<ul>";
    echo <<<HereDocString
        <li><a href="#" onclick="loadDoc('PHPs/imbed.2019reports.php?m='+this.innerHTML, displayTwo)">January</a></li>
        <li><a href="#" onclick="loadDoc('PHPs/imbed.2019reports.php?m='+this.innerHTML, displayTwo)">February</a></li>
        <li><a href="#" onclick="loadDoc('PHPs/imbed.2019reports.php?m='+this.innerHTML, displayTwo)">March</a></li>
        <li><a href="#" onclick="loadDoc('PHPs/imbed.2019reports.php?m='+this.innerHTML, displayTwo)">April</a></li>
        <li><a href="#" onclick="loadDoc('PHPs/imbed.2019reports.php?m='+this.innerHTML, displayTwo)">May</a></li>
        <li><a href="#" onclick="loadDoc('PHPs/imbed.2019reports.php?m='+this.innerHTML, displayTwo)">June</a></li>
        <li><a href="#" onclick="loadDoc('PHPs/imbed.2019reports.php?m='+this.innerHTML, displayTwo)">July</a></li>
        <li><a href="#" onclick="loadDoc('PHPs/imbed.2019reports.php?m='+this.innerHTML, displayTwo)">August</a></li>
        <li><a href="#" onclick="loadDoc('PHPs/imbed.2019reports.php?m='+this.innerHTML, displayTwo)">September</a></li>
        <li><a href="#" onclick="loadDoc('PHPs/imbed.2019reports.php?m='+this.innerHTML, displayTwo)">October</a></li>
        <li><a href="#" onclick="loadDoc('PHPs/imbed.2019reports.php?m='+this.innerHTML, displayTwo)">November</a></li>
        <li><a href="#" onclick="loadDoc('PHPs/imbed.2019reports.php?m='+this.innerHTML, displayTwo)">December</a></li>
        
HereDocString;
    echo "</ul>";
}
    

?>

</body>
</html>