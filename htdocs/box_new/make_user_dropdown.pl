#!C:/xampp/perl/bin/perl
print "Content-type:text/html\n\n";
use CGI qw/:standard/;
use DBI;

$user = param('user');
$username = 'root';
$password = '';
$database = 'movie_game';
$hostname = 'localhost';

$dbh = DBI ->connect("dbi:mysql:database=$database;" .
 	"host=$hostname;port=3306", $username, $password);

$SQL= "select * from users";


$Select = $dbh->prepare($SQL);
$Select->execute();

print '<select id="user_dropdown_menu">';

while($Row=$Select->fetchrow_hashref)
{	
	print "<option>$Row->{username}</option>";
}

print "</select>";