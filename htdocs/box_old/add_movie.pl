#!C:/xampp/perl/bin/perl
print "Content-type:text/html\n\n";
use CGI qw/:standard/;
use DBI;

$name = param('name');
$username = 'root';
$password = '';
$database = 'movie_game';
$hostname = 'localhost';

$dbh = DBI ->connect("dbi:mysql:database=$database;" .
 	"host=$hostname;port=3306", $username, $password);


$SQL = "insert into movies (name, rank) values('$name', '0')";

$Add = $dbh->prepare($SQL);
$Add->execute();

if($Add)
{
	print "$name added to list";
}

else
{
	print "Failure<br>$DBI::errstr";
}


