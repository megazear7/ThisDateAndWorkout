#!C:/xampp/perl/bin/perl
use DBI;
use CGI qw/:standard/;

$left = param('left');
$thetop = param('top');
$color = param('color');
$username = 'root';
$password = '';
$database = 'wallsgame';
$hostname = 'localhost';

if($thetop > 150)
{

$dbh = DBI ->connect("dbi:mysql:database=$database;" .
	"host=$hostname;port=3306", $username, $password);

$SQL = "insert into walls (fromleft,fromtop,color) values('$left','$thetop','$color')";

$InsertRecord = $dbh ->do($SQL);

print "Content-type: text/html\n\n\n";

if($InsertRecord)
{

}
else
{
	print "Failure<br>$DBI::errstr";
}
}