#!C:/xampp/perl/bin/perl
print "Content-type:text/html\n\n";
use CGI qw/:standard/;
use DBI;

$password_u = param('password');
$username_u = param('user');
$username = 'root';
$password = '';
$database = 'workout';
$hostname = 'localhost';

$dbh = DBI ->connect("dbi:mysql:database=$database;" .
 	"host=$hostname;port=3306", $username, $password);

$SQL = "select * from users where username = '$username_u'";
$Sth = $dbh->prepare($SQL);
$Sth->execute();

$yes_no = "created";

while($Row = $Sth->fetchrow_hashref){
	$yes_no = "already_taken";	
}

if($yes_no == "created"){
	$SQL = "INSERT INTO `users`(`username`, `sunday`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `password`, `email`, `id`) 
			VALUES ('$username_u','','','','','','','', '$password_u','','')";
	$Sth = $dbh->prepare($SQL);
	$Sth->execute();
}

print "$yes_no";












