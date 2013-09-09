#!C:/xampp/perl/bin/perl
print "Content-type:text/html\n\n";

use DBI;

$username = 'root';
$password = '';
$database = 'wallsgame';
$hostname = 'localhost';

$dbh = DBI ->connect("dbi:mysql:database=$database;" .
 	"host=$hostname;port=3306", $username, $password);

$SQL= "select * from walls";

$Select = $dbh->prepare($SQL);
$Select->execute();

while($Row=$Select->fetchrow_hashref)
{	
	print "<div id='block' style='background-color:$Row->{color};width:50px;height:50px;padding:10px;border:5px solid black;margin:10px;position:absolute;left:$Row->{fromleft};top:$Row->{fromtop};'></div>";
}
