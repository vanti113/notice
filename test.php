<?php




if($_SERVER['REQUEST_METHOD'] == 'POST'){

print $_POST['test'];
print "<br/>";
print $_POST['test2'];
print $testpoint;

}else{

$testpoint = "Reloading?";
print <<< _html_

<form method="post" action="$_SERVER[PHP_SELF]">
<input type="text" name="test" value="1" disabled>
<p>$testpoint</p>
<input type="text" name="test2"> 
<input type="submit">
_html_;


}
$testpoint = "default";


?>