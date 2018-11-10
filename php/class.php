<?php
/**
 * 2018.10.28
 */
class tools {

// curl
	function opencurl($url, $data = null, $header = "") {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		if (!empty($data)) {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}
		if (strstr($url, "https")) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		}
		$result = curl_exec($ch);
		return $result;
		curl_close($ch);
	}

//song_detail

	function get_song($song_name) {
		// var_dump($song_name);
		$yl = $this->opencurl("https://tool.rainss.cn/music_163/mvSearch.php?keywords={$song_name}");
		$pattern = "/id=(.*?)\">([\s\S]*?)<\/a>/";
		preg_match_all($pattern, $yl, $result);
		// var_dump($result);
		return $result;

	}

//mv_detail

	function get_mv($song_id) {
		$yl = $this->opencurl("https://tool.rainss.cn/music_163/mvInfo.php?id={$song_id}");
		$pattern = "/<a\shref\s=\"(.*?)\"\srel\s=\s\"noreferrer\">(.*?)<\/a>/";
		preg_match_all($pattern, $yl, $result);
		return $result;
	}

}