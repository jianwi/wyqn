<?php
header("Content-type: text/html; charset=utf-8");
if (!isset($_GET['name']) && !isset($_GET['id'])) {
	echo "未传入参数";
	return;
}

require_once 'class.php';
$tools = new tools();

if (isset($_GET['name'])) {
	$song_name = $_GET['name'];
	$song_id = $tools->get_song($song_name)[1];
	$song_name = $tools->get_song($song_name)[2];
	$n = count($song_id);

	$js =
		<<<js
function song(){
	var song_list=document.getElementById('song_list');
	var ele='
js;

	for ($i = 0; $i < $n; $i++) {
		$s_id = $song_id[$i];
		$s_name = $song_name[$i];
		$s_mv = $tools->get_mv($s_id)[1][0];

		$js .=
			<<<js
<li> <a class="musc" href="{$s_mv}" onclick="change_link(this);return false">{$s_name}</a> </li>
js;
	}

	$js .= "';song_list.innerHTML = ele;}";
	echo "$js";
}

if (isset($_GET['id'])) {
	$song_id = $_GET['id'];
	echo "const mv_link=" . json_encode($tools->get_mv($song_id)[1]);
	echo ";\n";
	echo "const mv_qxd=" . json_encode($tools->get_mv($song_id)[2]);
	return;
}