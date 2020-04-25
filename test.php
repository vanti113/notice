<?php




try {

	$db = new PDO('mysql:host=localhost:3307;dbname=notice2','root','111111');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
} catch (PDOException $e) {
	print "다음과 같은 오류로 실행할수 없습니다.".$e->getMessage();
}
$title = "테스트 주도 개발";
$comments = "실험 대상 1호로 지목된";

$result = $db->exec("UPDATE notice_board SET title='$title', comments='$comments' WHERE p_id=1");

echo $result;

?>