var show_item=document.getElementsByClassName("show_item");

for(i=0;i<show_item.length;i++){
    show_item[i].setAttribute("onclick","change_img(this)");
}

function change_img(b){

var show=document.getElementById("show");    
var des_title=document.getElementById("des_title");
var des_detail=document.getElementById("des_detail");

var title=b.title;
var alt=b.alt;
var src=b.src;


// console.log(title);
des_detail.innerText=alt;
des_title.innerText=title;
show.src=b.src;

}

function next_img(a){
    var alt=a.alt;
    var show_item=document.getElementsByClassName("show_item");
    console.log(show_item[alt]);
    change_img(show_item[alt]);
    a.alt++;
}