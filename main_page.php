<?php

$list_num = array(); // check박스의 번호


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$write_error = array();
	$write_data = array();
	if ($_POST['read']) {
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
		print "show_form을 작동시킴.";
		require "database_exec.php";
		page_write($write_data);
		print "기록되었습니다.";
		//show_form();
		/*if($write_error){
			show_form($write_error);
		}else{
			var_dump($write_data);
			var_dump($write_error);
			require "database_exec.php";
			page_write($write_data);
		}*/
		// show_form();
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
	var_dump($data);
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
	$validate_data['title'] = htmlentities($_POST['title_write']);
	var_dump($validate_data['title']);
	if ($validate_data['title'] === null || strlen($validate_data['title']) > 150) {
		$errors[] = "제목을 정확하게 입력해 주세요.";
	}

	$validate_data['comments'] = htmlentities($_POST['comments_write']);
	if (strlen($validate_data['comments']) > 3000) {
		$errors[] = "내용이 너무 많습니다.";
	}
	return array($validate_data, $errors); //$errors는 인덱스 배열, $validate_data는 연관배열로

}
