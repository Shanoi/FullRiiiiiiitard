function save(){
    var callback = function () {
        var show=document.getElementById("show");
        show.innerHTML= xmlhttp.responseText;
    };
    var input=document.getElementById("message").value;
    var url = "http://fix:8080/guestbookleavemessage.php?message="+input;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open('GET',url, true);
    xmlhttp.onreadystatechange = callback;
    xmlhttp.send(null);
}

document.getElementById("save").addEventListener("click", function(){ save() },false); 
