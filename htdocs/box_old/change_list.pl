#!C:/xampp/perl/bin/perl

print "Content-type:text/html\n\n";
use CGI qw/:standard/;
use DBI;

$user = param('user');
$movie = param('movie');
$password_u = param('password');
$rank = param('rank');
$username = 'root';
$password = '';
$database = 'movie_game';
$hostname = 'localhost';

$dbh = DBI ->connect("dbi:mysql:database=$database;" .
 	"host=$hostname;port=3306", $username, $password);


$SQL = "update users set $rank='$movie' where username='$user' and password='$password_u'";

$Add = $dbh->prepare($SQL);
$Add->execute();

if($Add)
{
	print "$movie set to position: $rank for user: $user";
}
else
{
	print "error";
}
