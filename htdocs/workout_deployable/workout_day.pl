#!C:/xampp/perl/bin/perl
print "Content-type:text/html\n\n";
use CGI qw/:standard/;
use DBI;


$day = param('day');
$user = param('user');
$username = 'root';
$password = '';
$database = 'workout';
$hostname = 'localhost';

$dbh = DBI ->connect("dbi:mysql:database=$database;" .
 	"host=$hostname;port=3306", $username, $password);

$SQL= "select * from users where username='$user'";

$Select = $dbh->prepare($SQL);
$Select->execute();

while($Row=$Select->fetchrow_hashref)
{	
	print "$Row->{$day}";
}
