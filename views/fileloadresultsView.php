<?php if ($_FILES["file"]["error"] > 0) { ?>
    <p>Error: <?php echo $_FILES["file"]["error"]; ?></p>
    <?php
} else {
    $flag = true;
    ?>
    <p>Upload: " . $_FILES["file"]["name"]; ?><br>
        Type: <?php echo $_FILES["file"]["type"]; ?><br>
        Size: <?php echo ($_FILES["file"]["size"] / 1024); ?>Kb<br>
        Stored in: <?php
        echo $_FILES["file"]["tmp_name"];
        $deststr = moveLoadedFile();
        ?>
        Stored in: <?php echo $deststr; ?></p>
    <?php
}
