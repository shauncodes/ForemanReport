
<html lang="en">
<head>
    <?php include("dbconnect.fr.inc.php"); ?>
    <!-- We now have use of $conn for mysqli functions -->
    <?php include("query.getforemen.inc.php"); ?>
    <!-- This gives use of $ForemanCount and $Foreman_ -->
</head>
<body>



<h5>2019 Foreman Reports</h5>
<ul>
    <?php
    
    for ($f = 1; $f <= $ForemanCount; $f++) {
        echo <<<HereDocString
            <li><a href="#" onclick="loadDoc('PHPs/imbed.pullfr.php?f=${"Foreman".$f}', displayTwo)">${"Foreman".$f}</a></li>
HereDocString;
    }
    ?>
</ul>


</body>
</html>