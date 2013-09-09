#!C:/xampp/perl/bin/perl
print "Content-type:text/html\n\n";
use CGI qw/:standard/;

 print <<HTML;
 <html>
 <head>
 <title>A Simple Perl CGI</title>
 </head>
 <body>
 <h1>A Simple Perl CGI</h1>
 <p>Hello World</p>
 </body>
 HTML
 exit; 