function change_link(a){
    var ge=document.getElementById("ge");
    // console.log(this);
    // typeof(this);
    ge.setAttribute("src",a.href);
    ge.setAttribute("autoplay","autoplay")
}

var a=document.getElementsByClassName("musc");

for(i=0;i<a.length;i++){
a[i].setAttribute("onclick","change_link(this);return false");
}

var section=document.getElementsByTagName("section")[0];
section.setAttribute("style","height:fit-content;");

function search_song(){
	clearInterval(auto);
	song=null; 

	// 写script标签。跨域准备
	var s_ge=document.getElementById("s_ge");
	var song=s_ge.value;
	var script=document.createElement("script");
	script.src=`http://wysj.jianwi.cn/ge.php?name=${song}`;
	document.body.removeChild(document.body.lastChild);
	document.body.append(script);
	var song_list=document.getElementById('song_list');
	//替换内容 

	var auto=setInterval("song()",1000);
	
}

