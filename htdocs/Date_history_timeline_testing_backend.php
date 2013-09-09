<?php

// Get needed variables from what was sent to from the calling file
$date = $_POST['date'];
$bday = $_POST['bday'];
$bday_database = 'birthdays';
$milhis = $_POST['milhis'];
$milhis_database = 'milhis';
$polhis = $_POST['polhis'];
$polhis_database = 'polhis';

// Make a mysql_connect object
$info = mysql_connect("localhost","root","");

// ensure the object is open
if (!$info)
{
die('Could not connect: ' . mysql_error());
}

// select a table from the database
mysql_select_db("dates", $info);

// make a function that gets info from the database, if the correct checkbox was clicked
function return_data($subject, $date, $subject_database)
{
if($subject == "1")
{
    // get info from the database
    $result = mysql_query("SELECT * FROM " . $subject_database . " 
    WHERE date = '" . $date . "'");

    // get info from database for the correct date
    while($row = mysql_fetch_array($result))
    {
	echo $row['info'];
	echo "<br />";
    }
    
}
}

// call the function for each possible table
return_data($bday, $date, $bday_database);
return_data($milhis, $date, $milhis_database);
return_data($polhis, $date, $polhis_database);

// close the database connection
mysql_close($info);

?>