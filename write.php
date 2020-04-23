<?php

print <<< _html_
<html><meta charset="utf-8"><head><title>게시글 쓰기</title></head>
<body><div align="center" style="padding-top:5%;">
<form method="POST" action="main_page.php">
<label>제목 : </label><input type="text" name="title_write" style="width : 400px;" placeholder="제목을 입력하세요(50자이내).">
<br/><br/>
<label>본문 입력: </label><br/>
<textarea name="comments_write" cols="100" rows="20" placeholder="내용을 입력하세요(1000자이내).">
</textarea><br/>
<input type="submit" value="제출">
</form>
</div>
</body>
</html>



_html_;



?>