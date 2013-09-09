#!C:/xampp/perl/bin/perl
use DBI;
use CGI qw/:standard/;

$left = param('left');
$thetop = param('fromtop');
$username = 'root';
$password = '';
$database = 'wallsgame';
$hostname = 'localhost';

$dbh = DBI ->connect("dbi:mysql:database=$database;" .
	"host=$hostname;port=3306", $username, $password);

$SQL = "insert into walls (fromleft,fromtop) values('$left','$thetop')";

$InsertRecord = $dbh ->do($SQL);

print "Content-type: text/html\n\n\n";

if($InsertRecord)
{
	print "Wall Added, left:$left top:$thetop";
}
else
{
	print "Failure<br>$DBI::errstr";
}