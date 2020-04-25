<?php

print <<< _html_

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>글 수정 화면</title>
  </head>
  <body>
    <form method="POST" action="main_page.php">
			<div class="update_colomn" align="center" style="padding: 5%;">
				<h2>게시글 수정</h2>
				<hr />
				<label>번호:</label><input type="text" name="title_num" value="$point"/>
        <label>제목 : </label
        ><input type="text" name="title_update" style="width: 400px;" value="$v[title]" />
        <br /><br />
        <label>본문 입력: </label><br />
        <textarea name="comments_update" cols="100" rows="20">$v[comments]
        </textarea
				><br />
				<hr >
				<input type="submit" value="수정완료">
				<input type="reset" value="다시쓰기">
				<form method="GET" action="main_page.php">
					<input type="submit" value="돌아가기">
				</form>
			</div>
    </form>
  </body>
</html>
_html_;
