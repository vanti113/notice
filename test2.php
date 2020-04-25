<?php

$global = "globals";



function myfunc(){
	$global = "locals";
	print $global;
	print $GLOBALS['global'];
	$GLOBALS['global'] = "global_local";
}
myfunc();
print $global;








?>