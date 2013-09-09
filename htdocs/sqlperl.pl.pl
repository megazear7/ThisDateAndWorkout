#!C:/xampp/perl/bin/perl
use DBI;

$username = 'root';
$password = '';
$database = 'test';
$hostname = 'localhost';

$dbh = DBI ->connect("dbi:mysql:database=$database;" . "host=$hostname;port=3306", &username, $password);

$SQL = "INSERT INTO testtable (it worked, 5)";

$InsertRecord = $dbh ->do($SQL);

print "Content-type:text/html\n\n\n";

if($InsertRecord)
{
	print "Succes";
}
else
{
	print "Failure<br/>$DBI::errstr";
}