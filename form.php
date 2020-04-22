<?php

print <<< _html_
<html><meta charset="utf-8">
<head><title></title><style>
input{
	padding : 10px;
	margin : 10px;
}
</style></head>
<body><div align="center" style="padding-top:10%;">
<table border="1px" width="1000px" height="40px">
<tr><th colspan="2" align="center"><strong>게시글 현황</strong></th></tr>
<form method="POST" action="main_page.php">
_html_;
/*if($titles){
	for($i = 1; $i < count($titles)+1; $i++){
		print "<tr><td align=\"center\" width=\"5px\"><input type=\"checkbox\" name=\"check\" value={$i}>";
		print $titles[$i-1];
	}
}*/
for($i = 0; $i < count($GLOBALS['list_num']); $i++){
	print "<tr><td align=\"center\" width=\"5px\"><input type=\"checkbox\" name=\"check\" value=".$GLOBALS['list_num'][$i].">";
	print "<td width=\"995px\">".$contents_title[$i]."</td></tr>";
}

print <<< _html_
</table>
<table width="1000px" height="40px">
<tr><td align="center"><input type="submit" name="insert" value="글쓰기"><input type="submit" name="read" value="글읽기"><input type="submit" name="update" value="글수정"><input type="submit" name="delete" value="글삭제"></td></tr>
</form>
</table>
</div></body>
</html>
_html_;






?>