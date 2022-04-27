
function Play(objsonido) {
  var thissound=document.getElementById(objsonido); 
  thissound.play();
}

function Stop(objsonido) {
  var thissound=document.getElementById(objsonido);
  thissound.pause();
}

var myModal = document.getElementById('myModal')
var myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', function () {
  myInput.focus()
})