#!C:/xampp/perl/bin/perl


print "Content-type:text/html\n\n";
use CGI qw/:standard/;
use DBI;


$user = param('user');
$workout = param('workout');
$day = param('day');
$username = 'root';
$password = '';
$database = 'workout';
$hostname = 'localhost';

$dbh = DBI ->connect("dbi:mysql:database=$database;" .
 	"host=$hostname;port=3306", $username, $password);


$SQL = "update users set $day='$workout' where username='$user'";

$Add = $dbh->prepare($SQL);
$Add->execute();

if($Add)
{
	print $day . "'s workout set to workout: $workout";
}
else
{
	print "error";
}
