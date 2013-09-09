#!C:/xampp/perl/bin/perl
use DBI;
use CGI qw/:standard/;

$race = param('race');
$class = param('class');
$username = 'root';
$password = '';
$database = 'fantasy';
$hostname = 'localhost';

$dbh = DBI ->connect("dbi:mysql:database=$database;" .
	"host=$hostname;port=3306", $username, $password);

$SQL = "insert into character_list (race, class) values('$race','$class')";

$InsertRecord = $dbh ->do($SQL);

print "Content-type: text/html\n\n\n";

if($InsertRecord)
{
	print "Added Character of race: $race and class: $class";
}
else
{
	print "Failure<br>$DBI::errstr";
}