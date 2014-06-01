<?php
// Include the main Propel script
require_once '/usr/share/php/propel/Propel.php';

// Initialize Propel with the runtime configuration
$con=Propel::init("build/conf/cobra-conf.php");

// Add the generated 'classes' directory to the include path
set_include_path("build/classes" . PATH_SEPARATOR . get_include_path());

