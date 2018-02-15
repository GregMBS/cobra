<p>Upload: <?php 
echo $_FILES["file"]["name"];
?><br>
   Type: <?php 
   echo $_FILES["file"]["type"];
   ?><br>
   Size: <?php 
   echo ($_FILES["file"]["size"] / 1024);
   ?>Kb<br>
   Stored in: <?php 
   echo $_FILES["file"]["tmp_name"];
   ?></p>
