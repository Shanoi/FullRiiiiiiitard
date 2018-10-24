function clearBook() {
    var callback = function () {
        var show = document.getElementById("show");
        show.innerHTML = xmlhttp.responseText;
    };
    var url = "http://fix/guestbookdeletemessage.php";
    var xmlhttp = new a();
    xmlhttp.open('GET', url, true);
    xmlhttp.onreadystatechange = callback;
    xmlhttp.send(null);
}

document.getElementById("clearbook").addEventListener("click", function(){ clearBook() },false);