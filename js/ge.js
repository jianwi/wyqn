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