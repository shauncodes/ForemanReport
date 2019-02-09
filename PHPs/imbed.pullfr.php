<?php
include("PHPs/dbconnect.fr.inc.php");
// We now have use of $conn for mysqli functions.

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

echo "<br /><br />";

if (isset($_GET["f"])) {
    $Foreman = $_GET["f"];
    $sql = "SELECT rid, Date, JobNum 
            FROM report 
            JOIN foreman ON report.fk_fid=foreman.fid 
            WHERE foreman.Name = '$Foreman'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<h5>" . ucfirst($Foreman) . ":</h5>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li><a target='new' href='../getfr.php?r=".$row["rid"]."'>".$row["Date"]." - #".$row["JobNum"]."</a></li>";
        }
    }
    echo "</ul>";
}

$conn->close();
?>	
