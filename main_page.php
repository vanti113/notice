<?php

$list_num = array();


if($_SERVER['REQUEST_METHOD'] =='POST'){
	if($_POST['insert']){
		require "write.php";
	}
	if($_POST['title']&&$_POST['comments']){
		validate_form();
	}






}else{
	show_form();
}
function show_form(){ //이 메소드는 현재의 데이터 베이스 현황을 호출하는 것이 첫째,
	$contents_title = array();
	$contents_comment = array();

	require "database_exec.php";
	
	$data = page_back();
	var_dump($data);
	foreach ($data as $k => $v) {
		$contents_title[] = $v['title'];
		$contents_comment[] = $v['comments'];
		$GLOBALS['list_num'][] = $v['p_id'];
	}

	require "form.php";

}
var_dump($list_num);

function validate_form(){
	$validate_data = array();
	$errors = array();
	$validate_data['title'] = htmlentities($_POST['title']);
	if(strlen($validate_data['title']) == 0 || strlen($validate_data['title']) > 150){
		$errors[] = "제목을 정확하게 입력해 주세요.";
	}

	$validate_data['comments'] = htmlentities($_POST['comments']);
	if(strlen($validate_data['comments']) > 3000){
		$errors[] = "내용이 너무 많습니다.";
	}
	return array($validate_data, $errors);

}

?>