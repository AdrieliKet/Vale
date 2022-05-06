function gerar() {

    var checkBox = document.getElementById("segundaVia");
    var recibo2 = document.getElementById("recibo2");
    if (checkBox.checked == true) {
        recibo2.style.display = "block";
    } else {
        recibo2.style.display = "none";
    }



}
