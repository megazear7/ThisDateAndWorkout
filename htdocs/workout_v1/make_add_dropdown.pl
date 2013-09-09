#!C:/xampp/perl/bin/perl
print "Content-type:text/html\n\n";
use CGI qw/:standard/;
use DBI;

$user = param('user');
$username = 'root';
$password = '';
$database = 'workout';
$hostname = 'localhost';

$dbh = DBI ->connect("dbi:mysql:database=$database;" .
 	"host=$hostname;port=3306", $username, $password);

$SQL= "select * from workouts where user='$user'";


$Select = $dbh->prepare($SQL);
$Select->execute();

print 'Add exercise to workout: <select id="current_workout">';

while($Row=$Select->fetchrow_hashref)
{	
	print "<option>$Row->{name}</option>";
}

print "</select>";