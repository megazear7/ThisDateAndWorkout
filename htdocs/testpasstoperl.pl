#!C:/xampp/perl/bin/perl
use CGI qw/:standard/;

if (param('latitude')) 
{
	$latitude = param('latitude')
} 
else 
{
	$latitude = 52.62
} 

if (param('longitude')) 
{
	$longitude = param('longitude')
} 
else 
{
	$longitude = -0.48
}
