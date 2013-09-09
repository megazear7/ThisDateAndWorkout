#!C:/xampp/perl/bin/perl

$plain_password = "hello my man";

@val = ('x', '_', '>', '<', '~', 'I', 'u', 'a', 'e', 'z', 'H', 'i', 'q', 't', 'm', 'n', 'y', 'w', 'v', 't', 'g', 'V', ',', 'A', 'E', 'Y');
@abc = ('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');

$index = 0;

while($index < 26){
	$plain_password =~ s/$abc[$index]/$val[$index]/g;
	$index = $index + 1;
}

print "$plain_password\n\n";

$index = 25;

while($index >= 0){
	$plain_password =~ s/$val[$index]/$abc[$index]/g;
	$index = $index - 1;
}

print "$plain_password\n\n";
