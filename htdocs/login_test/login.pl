#!C:/exampp/perl/bin/perl
use CGI;
use DBI;
use strict;
use warnings;

# read the CGI params
my $cgi = CGI->new;
my $username = $cgi->param("username");
my $password = $cgi->param("password");


# connect to the database
my $dbh = DBI->connect("DBI:mysql:database=workout;host=localhost;port=3306",  
  "root", "") 
  or die $DBI::errstr;

# check the username and password in the database
my $statement = qq{SELECT id FROM users WHERE username='alex' and password='megalord7'};
my $sth = $dbh->prepare($statement)
  or die $dbh->errstr;
$sth->execute()
  or die $sth->errstr;
my ($userID) = $sth->fetchrow_array;

# create a JSON string according to the database result
my $json = ($userID) ? 
  qq{{"success" : "login is successful", "userid" : "$userID"}} : 
  qq{{"error" : "username or password is wrong"}};

# return JSON string
print $cgi->header(-type => "application/json", -charset => "utf-8");
print $json;