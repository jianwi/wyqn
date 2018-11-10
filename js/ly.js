var pl_show=document.getElementById("pl_show");
var html_ly="";
for(vale of lysj){
    html_ly+=`<div class="plq">
            <p id="name" style="text-align: left;">${vale[0]}</p>
            <br>
            <p id="text" style="text-align: left">${vale[1]}</p>
          
            </div>
    `; 
}
pl_show.innerHTML=html_ly;


function submit_it() {
    var ly_form=document.getElementById("ly_form");
   
    ly_form.submit();
    setTimeout(() => {
        alert("提交成功");
        location.reload();
    }, 1000);
   
}
