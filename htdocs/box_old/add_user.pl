#!C:/xampp/perl/bin/perl
print "Content-type:text/html\n\n";
use CGI qw/:standard/;
use DBI;

$user = param('username');
$pass = param('password');
$username = 'root';
$password = '';
$database = 'movie_game';
$hostname = 'localhost';

$dbh = DBI ->connect("dbi:mysql:database=$database;" .
 	"host=$hostname;port=3306", $username, $password);


$SQL = "insert into users (username, password) values('$user', '$pass')";

$Add = $dbh->prepare($SQL);
$Add->execute();

if($Add)
{
	print "New user added: $user";
}

else
{
	print "Failure<br>$DBI::errstr";
}


