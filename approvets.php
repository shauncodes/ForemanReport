<?php

include("PHPs/dbconnect.fr.inc.php");
// We now have use of $conn for mysqli functions

$Foreman = $_POST["Foreman"];
$Date = $_POST["Date"];

$auth_sql = "SELECT Pass
            FROM auth
            WHERE User = 'Mark'";
$result = $conn->query($auth_sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pass = $row["Pass"];
    }
}

if ($_POST["SuperKey"] == $pass) {
    $approved = "INSERT INTO approved (Foreman, Date) 
                VALUES ('$Foreman','$Date')";
    if(!($conn->query($approved))) {
        echo "uhhh mightve had an error. Call Shaun and read him this: " . $conn->error;
    } else {
        echo "<script>alert('Thank you Mr. Fotou. You will be redirected back to timesheet page.');</script>";
        echo "<script>setTimeout(function () { window.location = 'timesheet.php'; }, 0100)</script>";
        
    }
} else {
    echo "<script>alert('Incorrect password. Attempts remaining: 2');</script>";
    echo "<script>window.history.back();</script>";
}


?>