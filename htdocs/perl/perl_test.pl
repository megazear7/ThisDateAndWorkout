#!C:/xampp/perl/bin/perl

open(my $in, "<", "input.txt");

while(<$in>){
	print "Just read line: $_";
}