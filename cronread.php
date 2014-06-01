<?php
$cronin=$_POST['crontab'];
if (substr($cronin,0,6)=='# greg') {
file_put_contents('/tmp/cron.tmp',$cronin);
system('crontab /tmp/cron.tmp');
}
$command="crontab -l > /tmp/cron.tmp";
exec($command);
$crontab=file_get_contents('/tmp/cron.tmp');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<title>CRON Manager</title>
<style type='text/css'>
    textarea {width:100%;clear:both;}
</style>
</head>
<body>
<form action="cronread.php" method="post" enctype="multipart/form-data" name="cronread">
<textarea name='crontab'><?php echo $crontab; ?></textarea>
<input type='submit' />
</form>

