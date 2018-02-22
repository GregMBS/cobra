<?php
$string = 
"Response:.Follows<br>Privilege:.Command<br>IAX2/603-5741!from-internal!!1!Up!AppDial!(Outgoing.Line)!603!!3!260!Local/603@from-internal-92f4,2<br>Local/603@from-internal-92f4,2!macro-dial!s!7!Up!Dial!IAX2/603||trM(auto-blkvm)!8182831675!!3!260!IAX2/603-5741<br>Local/603@from-internal-92f4,1!from-internal!900!1!Up!AppQueue!(Outgoing Line)!8182831675!!3!260!DAHDI/5-1<br>DAHDI/5-1!ext-queues!900!11!Up!Queue!900|tr|||20!8182831675!!3!262!Local/603@from-internal-92f4,1<br>--END COMMAND--";
sscanf($string,"%sIAX2%d-%s",$trash,$ext,$trash2);
// show types and values
var_dump($trash,$ext,$trash2);
?>