<?php






 function page_back(){//현재 데이터베이스의 페이지를 전부 출력하는 역할
 	try{
 		$db = new PDO('mysql:host=localhost:3307;dbname=notice2', 'root', '111111');
 		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 	}catch(PDOException $e){
 		print "다음과 같은 에러가 발생했습니다.".$e->getMessage();
 	}	
 	
 	$list = $db->query('SELECT * FROM notice_board');
 	$c = $list-> fetchall(PDO::FETCH_ASSOC);
 	return $c;
 }


 function page_write($writed_data){ //$writed_data=['title'=>'내용', 'comments'=>'내용']
 	try{
 		$db = new PDO('mysql:host=localhost:3307;dbname=notice2', 'root', '111111');
 		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 	}catch(PDOException $e){
 		print "다음과 같은 에러가 발생했습니다.".$e->getMessage();
 	}
 	$title = $writed_data['title'];
 	$comments = $writed_data['comments'];
 	$obj = $db->exec("INSERT INTO notice_board(title, comments)VALUES('$title','$comments')");
 	var_dump($obj);
 }







 ?>