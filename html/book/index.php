<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>文艺青年</title>
    <link href="main.css" rel="stylesheet">
</head>

<body>
    <header>
        <nav>
            <li>
                <a href="../index.html">首页</a>
            </li>*
            <li>
                <a href="../html/shi.html">诗</a>
            </li>*
            <li>
                <a href="../html/ge.html" >歌</a>
            </li>*
            <li>
                <a href="../html/tu.html">画</a>
            </li>*
             <li>
                <a href="../html/tu.html"style=" display: inline-block;
                border: #343434 double 2px;
                background: #343434;
               border-radius:50% ;
                width: 22px;
                height: 22px;
                color: #caddf5;">书</a>
            </li>*

            <li>
                <a href="../html/ly.html">留言</a>
            </li>
        </nav>
    </header>
    <section>


<?php
require_once "global.php";

$api = new API();
$data = $api->getDayWord();

if (!isset($_GET['bkn'])) {
	print <<<html
<section class="main"><img src='{$data->picture2}' width="60%" id="pic"/>
<p id="eng">{$data->content}</p><hr></hr><br>
<h1>福慧图书馆藏书查询系统！<br>陕科大用户专享</h1>
<br><br>
<form action="/">
<input type='text'name="bkn" placeholder="请在这里输入图书名称"></input>
<input type="submit" class="submit" value="搜索馆藏">
</form>
<br><br>

<h3>联系我：qq1615420877</h3>
<h4>Powered By jianwi.cn</h4>
</section>
html;
	return;
}

$bkn = $_GET["bkn"];
$page = isset($_GET["page"]) ? $_GET["page"] : 0;
//判断有没有搜到
$pattern = "/没有检索到记录/";
$state = $api->getBookDetail($pattern, $bkn, $page);
if (count($state[0]) == 1) {
	print <<<html
<section>
   <h2>oops，没找到你要的书。。。</h2>
   <img src="girlTear.jpg" width='55%'/>
   <a href="/">返回首页</a>
    <h3>联系我：qq1615420877</h3>
    <h4>Powered By jianwi.cn</h4>
    </section>
html;
	return;
}

// 记录数
$pattern = "/共有：(.*?)条/";
$count = $api->getBookDetail($pattern, $bkn, $page);
$count = $count[1][0];
// 书名
$pattern = '/blank">(.*?)<\/a>/';
$bookname = $api->getBookDetail($pattern, $bkn, $page);
$bookname = $bookname[1];
// id
$pattern = '/"gcinfo(.*?)">/';
$bookid = $api->getBookDetail($pattern, $bkn, $page);
$bookid = $bookid[1];
// 作者
$pattern = '/creatorSearch">([\s\S]*?)<\/a>/';
$bookauthor = $api->getBookDetail($pattern, $bkn, $page);
$bookauthor = $bookauthor[1];
for ($i = 0; $i < count($bookid); $i++) {
	$detail = $api->opencurl("http://222.24.94.243:8088/opac/book/getHoldingsInformation/{$bookid[$i]}");
	$detail = stripslashes($detail);
	$detail = json_decode($detail);
	echo "<div class='book'><br><br><p class='bookname'>{$bookname[$i]}<br></p><p class='author'>{$bookauthor[$i]}</p><table><tr><td>where</td><td>检索序号</td><td>书本状态</td></tr>";
	foreach ($detail as $details) {
		print <<<html
<tr><td>{$details->部门名称}</td><td>{$details->索书号}</td><td>{$details->bookstatus}</td></tr>
html;
	}
	print("</table></div>");
}
$pagesALL = ceil($count / 10) - 1;
$page_before = $page / 10 - 1;
$page_next = $page / 10 + 1;
echo "<h4>共{$count}条数据，{$pagesALL}页</h4>";
echo "<<< <a href='/?bkn=$bkn&page=00'>首页</a>-";
if ($page / 10 > 0) {
	echo "<a href='/?bkn=$bkn&page={$page_before}0'>上一页</a>-";
}
// for($i=0;$i<ceil($count/10);$i++){
//     if ($page<30) {
//         $p=$i+1;
//         print <<<a
// <a href="/?bkn=$bkn&page={$i}0">第{$p}页-</a>
// a;
//     }else{
//         $ii=($page/10)+$i-2;
//         $p=($page/10)+$i-1;
//         print <<<a
//         <a href="/?bkn=$bkn&page={$ii}0">第{$p}页-</a>
// a;
//     }
// if($i>3||$p>=ceil($count/10)){
//     break;
// }

// }
echo "
<a href='/?bkn=$bkn&page={$page_next}0'>下一页</a>-
<a href='/?bkn=$bkn&page={$pagesALL}0'>末页</a>>>>"
;
