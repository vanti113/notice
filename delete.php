<?php

print <<<_html_
<!doctype html>
<html><meta charset="utf-8">
<head><title>게시글 삭제 현황</title></head>
<body>
<div align="center" style="padding:5%;">
_html_;
if($delete_result){
	print "<h2>정상적으로 삭제되었습니다.</h2><hr />";
}else{
	print "<h2>삭제가 불가능합니다. 오류를 찾아주세요.</h2><hr />";
}
print <<<_html_
<br />
<form method="GET" action="main_page.php">
	<input type="submit" value="돌아가기">
</form>
</div>
</body>
</html>
_html_;







?>