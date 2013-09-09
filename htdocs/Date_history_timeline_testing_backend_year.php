<?php

// get info that was sent from the front end html (.php) file
$date = $_POST['date'];
$bday = $_POST['bday'];
$bday_database = 'birthdays';
$milhis = $_POST['milhis'];
$milhis_database = 'milhis';
$polhis = $_POST['polhis'];
$polhis_database = 'polhis';

// open a connection to the database
$info = mysql_connect("localhost","root","");

// ensure the connection is open
if (!$info)
{
die('Could not connect: ' . mysql_error());
}

// select the correct database
mysql_select_db("dates", $info);

// this variable turns to 1 (true) when the first year is found
$done=0;

function return_data($subject, $date, $subject_database, &$finished)
// get the year info from the database
{
// if the correct checkbox was clicked do whats inside
if($subject == "1")
{

    // get info from the database occording to the date that was sent to this file
    $result = mysql_query("SELECT * FROM " . $subject_database . " 
    WHERE date = '" . $date . "'");

    // this variable turns to 2 (false) when the first year is found in this database that has the correct date
    $i=1;

    // get the year info and echo it to the calling file
    while(($row = mysql_fetch_array($result)) && ($i==1) && ($finished!==1))
    {
    echo $row['year'];
    // once this has happened once make sure this file cannot echo anything else
    $i=$i+1;
    $finished=1;
    }
    
}
}

// check each check box 
return_data($bday, $date, $bday_database, $done);
return_data($milhis, $date, $milhis_database, $done);
return_data($polhis, $date, $polhis_database, $done);

// close the database connect
mysql_close($info);
?>
