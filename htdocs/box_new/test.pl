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


$SQL= "select * from users where username='$user'";

$Select = $dbh->prepare($SQL);
$Select->execute();



while($Row=$Select->fetchrow_hashref)
{	
	print "First:  $Row->{first}<br/>Second: $Row->{second}<br/>Third: $Row->{third}<br/>Fourth: $Row->{fourth}<br/>Fifth: $Row->{fifth}<br/>Bonus One: $Row->{sixth}<br/>Bonus Two: $Row->{seventh}"
	#print "hello";
	#print "Second: $Row->{second}<br/>"
	#print "Third:  $Row->{third}<br/>"
	#print "Fourth: $Row->{fourth}<br/>"
	#print "Fifth:  $Row->{fifth}<br/>"

}


