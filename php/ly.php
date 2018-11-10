<?php
date_default_timezone_set("Asia/Shanghai");
// 发送数据
function postWord() {

	$name = addslashes($_POST["name"]);
	$word = addslashes($_POST["ly"]);
	$email = addslashes($_POST['email']);

	$date = time();
	$data = array($name, $word, $email, $date);
	$data = json_encode($data);
	$filename = "word.txt";
	$fp = fopen($filename, 'a+');
	fwrite($fp, $data . "\n");
	fclose($fp);
}
// 读取数据
function getWord() {
	$words = array();
	$filename = "word.txt";
	$fp = fopen($filename, 'r');
	while ($data = fgets($fp)) {
		$data = json_decode($data);
		$words[] = $data;
	}
	fclose($fp);
	return $words;
}

if (isset($_POST['name'])) {
	postWord();
	echo "提交成功";
	return;
} else {
	$word = getWord(10);
	$word = json_encode($word);
	echo "var word=$word;const lysj=word.reverse();";
}