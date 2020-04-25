<?php

$list_num = array(); // check박스의 번호
$G_point = array();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$write_error = array();
	$write_data = array();


	if ($_POST['update']) {
		$point = $_POST['check'];

		try {
			$db = new PDO('mysql:host=localhost:3307;dbname=notice2', 'root', '111111');
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			print "다음과 같은 에러가 발생했습니다." . $e->getMessage();
		}
		$query_data = $db->query("SELECT title, comments FROM notice_board WHERE p_id = $point");
		$data_query = $query_data->fetchall(PDO::FETCH_ASSOC);
		$v = array();
		foreach ($data_query as $key => $value) {
			$v = $value;
		}
		require "update.php";
	}

	if ($_POST['title_update']) {
		/* print $_POST['title_update'];
		print $_POST['comments_update']; */
		list($write_data, $write_error) = validate_form();

		print $_POST['title_num'];
		$check_point = $_POST['title_num'];
		var_dump($check_point);
		$title = $write_data['title'];
		$comments = $write_data['comments'];
		try {
			$db = new PDO('mysql:host=localhost:3307;dbname=notice2', 'root', '111111');
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$obj = $db->exec("UPDATE notice_board SET title = '$title', comments = '$comments' WHERE p_id = $check_point");
		} catch (PDOException $e) {
			print "다음과 같은 에러가 발생했습니다." . $e->getMessage();
		}
		var_dump($obj);
		if(is_int($obj)){
			print "게시글이 정상 수정 되었습니다.";
		}else{
			print "오류가 발생했습니다.";
		}

		/*error_reporting(E_ALL);
		ini_set("display_errors",1);
		$sql ="UPDATE notice_board SET title = '$title' WHERE p_id = $check_point";
		
		$obj = $db->prepare($sql);
		$obj->execute();
		echo $obj->rowCount()."줄이 성공적으로 반영되었습니다.";
		if ($obj) {
			print "정상 수정되었습니다.";
		} else {
			print "수정되지 않았습니다.";
		}
*/
		/* print <<< _html_
		<div align="center" style="padding:10%;">
		<h2>기록되었습니다.</h2><br/><br/>
		<form method="GET" action="main_page.php"><input type="submit" value="돌아가기">
		</form>
		</div>
		_html_; */
	}

	if ($_POST['delete']) {
		$point = $_POST['check'];
		try {
			$db = new PDO('mysql:host=localhost:3307;dbname=notice2', 'root', '111111');
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			print "다음과 같은 에러가 발생했습니다." . $e->getMessage();
		}
		$delete_result = $db->exec("DELETE FROM notice_board WHERE p_id = $point");
		require "delete.php";
	}


	if ($_POST['read']) { //읽기 모드시 나오는 화면과 처리모음.
		$point = $_POST['check'];
		echo $point;
		try {
			$db = new PDO('mysql:host=localhost:3307;dbname=notice2', 'root', '111111');
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			print "다음과 같은 에러가 발생했습니다." . $e->getMessage();
		}
		$query_data = $db->query("SELECT title, comments FROM notice_board WHERE p_id = $point");
		$data_query = $query_data->fetchall(PDO::FETCH_ASSOC);
		var_dump($data_query);
		$v = array();
		foreach ($data_query as $key => $value) {
			$v = $value;
		}
		require "read.php";
	}


	if ($_POST['insert']) {
		require "write.php";
	}
	if ($_POST['title_write']) {

		//show_form();
		/*$write_error = array();
		$write_data = array();*/
		list($write_data, $write_error) = validate_form();
		var_dump($write_data);
		var_dump($write_error);

		require "database_exec.php";
		page_write($write_data);

		print <<< _html_
		<div align="center" style="padding:10%;">
		<h2>기록되었습니다.</h2><br/><br/>
		<form method="GET" action="main_page.php"><input type="submit" value="돌아가기">
		</form>
		</div>
		_html_;
	}
} else {
	show_form();
}

function show_form($errors = array())
{ //이 메소드는 현재의 데이터 베이스 현황을 호출하는 것이 첫째,
	$contents_title = array();
	$contents_comment = array();
	$contents_errors = '';
	require "database_exec.php";

	$data = page_back();
	//var_dump($data);
	foreach ($data as $k => $v) {
		$contents_title[] = $v['title'];
		$contents_comment[] = $v['comments'];
		$GLOBALS['list_num'][] = $v['p_id'];
	}

	if ($errors) {
		$contents_errors .= implode("</p><p>", $errors);
	}

	require "form.php";
}
//var_dump($list_num);

function validate_form()
{
	$validate_data = array();
	$errors = array();
	if ($_POST['title_write']) {

		$validate_data['title'] = htmlentities($_POST['title_write']);
		var_dump($validate_data['title']);
		if ($validate_data['title'] === null || strlen($validate_data['title']) > 150) {
			$errors[] = "제목을 정확하게 입력해 주세요.";
		}

		$validate_data['comments'] = htmlentities($_POST['comments_write']);
		if (strlen($validate_data['comments']) > 3000) {
			$errors[] = "내용이 너무 많습니다.";
		}
	}
	if ($_POST['title_update']) {
		$validate_data['title'] = htmlentities($_POST['title_update']);
		if ($validate_data['title'] === null || strlen($validate_data['title']) > 150) {
			$errors[] = "제목을 정확하게 입력해 주세요.";
		}
		$validate_data['comments'] = htmlentities($_POST['comments_update']);
		if (strlen($validate_data['comments']) > 3000) {
			$errors[] = "내용이 너무 많습니다.";
		}
	}
	return array($validate_data, $errors); //$errors는 인덱스 배열, $validate_data는 연관배열로

}
