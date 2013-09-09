#!C:/xampp/perl/bin/perl
use strict;
use warnings;

my $fun_var = 50;

my @my_list = ("fun", "boring", "debation", "robotic");
my %my_hash = (apple => "red", bannana =>, "yellow", pumpkin => "orange");


my $food = {
	fruit =>	{
				apple => 	{
							description => "a tasty round thing",
							color => "red",
							},
				bannanna =>	{
							decription => "a less tasty long thing",
							color => "yellow"
							}
				},
	vegetable =>{
				carrot =>	{
							description => "a crappy root",
							color => "orange"
							},
				tomato =>	{
							description => "a crappy weed",
							color => "red"
							}
				}
};

print $food->{'fruit'}->{'apple'}->{'description'};




