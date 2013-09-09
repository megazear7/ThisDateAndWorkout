#!C:/xampp/perl/bin/perl
print "Content-type:text/html\n\n";

use DBI;

$username = 'root';
$password = '';
$database = 'test';
$hostname = 'localhost';

$dbh = DBI ->connect("dbi:mysql:database=$database;" .
 	"host=$hostname;port=3306", $username, $password);

$SQL= "select * from testtable";

$Select = $dbh->prepare($SQL);
$Select->execute();

while($Row=$Select->fetchrow_hashref)
{
  print "$Row->{words} $Row->{integers}<br/>";
}
