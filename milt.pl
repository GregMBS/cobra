use strict;
use DBI;
use POSIX;

my $calldir = "/var/spool/asterisk/outgoing";
my @outchan = ("SIP/AxtelConmigo","SIP/AxtelConmigo2","SIP/AxtelConmigo3","SIP/AxtelConmigo4");
; # What channel do we call our customers back on?
my $dbhost = "localhost";
my $dbuser = "gmbs";
my $dbpass = "4sale";
my $dbname = "robot";
my @row0;
my @row;
my $q1;
my $row;
my $login;
my $pass;
my $uid;
my $gid;

($login,$pass,$uid,$gid) = getpwnam('asterisk');

my $dbh = DBI->connect("dbi:mysql:$dbname:$dbhost","$dbuser","$dbpass")
or die $DBI::errstr;

my $q0 = "SELECT distinct auto,msg, lineas FROM msglist
WHERE hour(now())>5;";

my $sth = $dbh->prepare($q0);
$sth->execute; 

my $i=0;

while (@row0=$sth->fetchrow_array()) {

$q1 = "SELECT auto,id,tel,turno FROM calllist " .
"WHERE msg = '".$row0[1]."' " .
"ORDER BY turno LIMIT ".$row0[2].";";

my $sth1 = $dbh->prepare($q1);
$sth1->execute; 

while (@row=$sth1->fetchrow_array()) {

open CALLFILE, ">>/tmp/cb$row[2]$row[0].call";
print CALLFILE "Channel: SIP/AxtelConmigo2/$row[2]\n";
print CALLFILE "MaxRetries: 0\n";
print CALLFILE "Account: $row[0],$row[2]\n";
print CALLFILE "RetryTime: 60\n";
print CALLFILE "WaitTime: 30\n";
print CALLFILE "Application: playback\n";
print CALLFILE "Data: $row0[1]\n";
print CALLFILE "Extension: s\n";
print CALLFILE "Priority: 1\n";
close CALLFILE;

$dbh->do("UPDATE calllist SET turno=turno+1 WHERE auto=$row[0]");
chown $uid, $gid, "/tmp/cb$row[2]$row[0].call"; 
rename("/tmp/cb$row[2]$row[0].call", 
"$calldir/$row[2]$row[0].call");
sleep 30;
$i++;
}
}
