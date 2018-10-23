<script>
    function clearBook() {
        var callback = function () {
            var show = document.getElementById("show");
            show.innerHTML = xmlhttp.responseText;
        };
        var url = "http://attacks/guestbookdeletemessage.php";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open('GET', url, true);
        xmlhttp.onreadystatechange = callback;
        xmlhttp.send(null);
    }

</script>

<button onclick='clearBook()'>Clear Messages</button>
