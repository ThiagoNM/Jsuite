document.querySelector("#opcio1").addEventListener("click"  ,() => {

    var seleccio = document.getElementById('opcio1');

    if (seleccio.checked) {
        document.getElementById('destinatari').disabled = true;
        document.getElementById('grup').disabled = false;
    }
});

document.querySelector("#opcio2").addEventListener("click"  ,() => {

    var seleccio2 = document.getElementById('opcio2');

    if (seleccio2.checked) {
        document.getElementById('destinatari').disabled = false;
        document.getElementById('grup').disabled = true;
    }

});