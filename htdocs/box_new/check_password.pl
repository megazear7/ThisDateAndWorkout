#!C:/xampp/perl/bin/perl
print "Content-type:text/html\n\n";
use CGI qw/:standard/;
use DBI;

$password_u = param('password');
$username_u = param('username');
$username = 'root';
$password = '';
$database = 'movie_game';
$hostname = 'localhost';

$dbh = DBI ->connect("dbi:mysql:database=$database;" .
 	"host=$hostname;port=3306", $username, $password);

$SQL = "select * from users where username = '$username_u' and password = '$password_u'";
$Sth = $dbh->prepare($SQL);
$Sth->execute();

$yes_no = "no";

while($Row = $Sth->fetchrow_hashref){
	$yes_no = "yes";	
}

print "$yes_no";

