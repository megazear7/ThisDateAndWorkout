#!C:/xampp/perl/bin/perl
print "Content-type:text/html\n\n";
use CGI qw/:standard/;
use DBI;

$workout = param('workout');
$user = param('user');
$username = 'root';
$password = '';
$database = 'workout';
$hostname = 'localhost';

$dbh = DBI ->connect("dbi:mysql:database=$database;" .
 	"host=$hostname;port=3306", $username, $password);


$SQL = "insert into workouts (user, name, id) values('$user', '$workout', 1)";
$Add = $dbh->prepare($SQL);
$Add->execute();

if($Add){
	print "Successfully added $workout to list of workouts for $user";
}