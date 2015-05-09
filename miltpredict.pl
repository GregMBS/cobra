#!/usr/bin/perl
#
# @File miltpredict.pl
# @Author gmbs
# @Created May 9, 2015 1:30:32 PM
#

use strict;
use JSON;
use POSIX;

my $calldir = "/var/spool/asterisk/outgoing";
; # What channel do we call our customers back on?
my $login;
my $pass;
my $uid;
my $gid;
my $route;
my $row;
my $json;
my @data;

($login,$pass,$uid,$gid) = getpwnam('asterisk');

use LWP::UserAgent;

my $ua = LWP::UserAgent->new;

my $req = HTTP::Request->new(
   GET => 'http://192.168.0.71/miltpredict.php');
$req->header('Accept' => 'text/html');

# send request
my $res = $ua->request($req);

# check the outcome
if ($res->is_success) {
   $json = $res->decoded_content;
   @data = @{decode_json($json)};
} else {
   print "Error: " . $res->status_line . "\n";
}

foreach $row (@data) {
my $tt = $row->{tel};
my $auto = $row->{id};
my $cta = $row->{cuenta};
my $msg = $row->{msg};
my $route="local/$tt";
my $calling = $route."\@from-internal-robot";

open CALLFILE, ">>/tmp/cb$tt$cta.call";
print CALLFILE "Channel: $calling\n";
print CALLFILE "MaxRetries: 0\n";
print CALLFILE "Account: $cta,$tt\n";
print CALLFILE "RetryTime: 60\n";
print CALLFILE "WaitTime: 30\n";
print CALLFILE "Application: Queue\n";
print CALLFILE "Data: 665\n";
print CALLFILE "Extension: s\n";
close CALLFILE;

#$dbh->do("UPDATE calllist SET turno=turno+1 WHERE auto=$row[0]");
my $url = 'http://192.168.0.71/miltmark.php?id='.$auto;
my $req1 = HTTP::Request->new(
   GET => $url);
$req1->header('Accept' => 'text/html');

# send request
my $res1 = $ua->request($req1);

chown $uid, $gid, "/tmp/cb$tt$cta.call"; 
rename("/tmp/cb$tt$cta.call", 
"$calldir/$tt$cta.call");
chown $uid, $gid, "$calldir/$tt$cta.call";
sleep 7;
}