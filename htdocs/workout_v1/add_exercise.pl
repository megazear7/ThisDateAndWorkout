#!C:/xampp/perl/bin/perl
print "Content-type:text/html\n\n";
use CGI qw/:standard/;
use DBI;


$user = param('user');
$workout = param('workout');
$sets = param('sets');
$reps = param('reps');
$name = param('name');
$is_timed = param('is_timed');
$time = param('time');
$username = 'root';
$password = '';
$database = 'workout';
$hostname = 'localhost';

$dbh = DBI ->connect("dbi:mysql:database=$database;" .
 	"host=$hostname;port=3306", $username, $password);


$SQL = "insert into exercises (user, workout, sets, reps, name, is_timed, time) values('$user', '$workout', '$sets', '$reps', '$name', '$is_timed', '$time')";

$Add = $dbh->prepare($SQL);
$Add->execute();

if($Add){
	if($is_timed==0){
		print "Exercise Added to user $user in workout $workout: $sets sets of $reps reps of $name";
	}elsif($is_timed==1)	{
		print "Exercise Added to user $user in workout $workout: $sets sets of $reps reps of $name, done withen $time seconds";
	}
}else{
	print "Failure<br>$DBI::errstr";
}


