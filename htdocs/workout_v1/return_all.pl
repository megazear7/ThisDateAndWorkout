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

$SQL= "select * from exercises where workout='$workout' and user='$user'";

$Select = $dbh->prepare($SQL);
$Select->execute();

#$Row=$Select->fetchrow_hashref;

#print $Row->{sets};

print "<h3>Workout for today: $workout</h3>";

while($Row=$Select->fetchrow_hashref)
{	
	#print $Row->{sets};

	if($Row->{is_timed}==0)
	{
		print "$Row->{sets} sets of $Row->{reps} reps of $Row->{name}<br/>";
	}

	elsif($Row->{is_timed}==1)
	{
		print "$Row->{sets} sets of $Row->{reps} reps of $Row->{name} in $Row->{time} seconds<br/>";
	}
	else
	{
	print "error";
	}

}