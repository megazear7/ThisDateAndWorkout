#!C:/xampp/perl/bin/perl
print "Content-type:text/html\n\n";

use DBI;
use CGI qw/:standard/;

$color = param('color');
$pos = param('pos');
$id = param('id');
	
print "<div id='$id' style='background-color:$color;width:50px;height:50px;padding:10px;border:5px solid black;margin:10px;position:absolute;left:$pos;top:0;opacity:.5;'></div>";

