#!C:/xampp/perl/bin/perl
use DBI;
use CGI qw/:standard/;

$left = param('left');
$thetop = param('top');
$username = 'root';
$password = '';
$database = 'wallsgame';
$hostname = 'localhost';

if($left > 150 || $thetop > 150)
{

$dbh = DBI ->connect("dbi:mysql:database=$database;" .
	"host=$hostname;port=3306", $username, $password);

$SQL = "delete from walls (fromleft,fromtop) values('$left','$thetop')";

$DeleteRecord = $dbh ->do($SQL);

print "Content-type: text/html\n\n\n";

if($DeleteRecord)
{
	
}
else
{
	print "Failure<br>$DBI::errstr";
}
}