<!--    Wowwww, this shit gets kinda messy.
        1. We chop the date into segments ($Year, $Month, $Day).
        2. Then cut the leading zeros so it looks nice (01 = 1 for Jan).
        2. Then use math to cycle through proper days of the month
            and months of the year ($tsDay, $tsMonth).
        3. Then put it back in ugly form to search the DB ($dbDay, $dbMonth) -->
<?php

$Date = $_POST["Date"];

$dateSplit = explode("-",$Date);
$Year = $dateSplit[0];
$Month = $dateSplit[1];
$tsMonth = preg_replace("/^0/", "", $Month);
$Day = $dateSplit[2];
$tsDay = preg_replace("/^0/", "", $Day);

$days31 = ["1", "3", "5", "7", "8", "10", "12"];
$days30 = ["4", "6", "9", "11"];
$days28 = "2";

foreach ($days31 as $tryThese) {
    if ($tryThese == $tsMonth) {
        $highestDay = "31";
    }
}
foreach ($days30 as $tryThese) {
    if ($tryThese == $tsMonth) {
        $highestDay = "30";
    }
}
if ($tsMonth == $days28) {
    $highestDay = "28";
}

for ($d = 1; $d < 8; $d++) {
    if ($tsDay > $highestDay) {
        $tsDay = "1";
        if ($tsMonth == "12") {
            $tsMonth = "1";
            $Year += 1;
        } else {
            $tsMonth += "1";
        }
    }
    ${"Day".$d} = $tsMonth . "/" . $tsDay;

    // Now convert back to ugly mode "01/01" instead of "1/1".
    if (strlen($tsMonth) == 1) {
        $dbMonth = "0".$tsMonth;
    } else {
        $dbMonth = $tsMonth;
    }
    if (strlen($tsDay) == 1) {
        $dbDay = "0".$tsDay;
    } else {
        $dbDay = $tsDay;
    }
    ${"Date".$d} = $Year . "-" . $dbMonth . "-" . $dbDay;
    $tsDay += "1";
}

?>