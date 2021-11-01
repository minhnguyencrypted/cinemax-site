var thinhmodal = document.getElementById("thinhmodal")
var thinhbutton = document.getElementById("thinh-info");
var thinhspan = document.getElementsByClassName("thinhclose")[0];
thinhbutton.onclick = function() {
    thinhmodal.style.display = "block";
}
thinhspan.onclick = function() {
    thinhmodal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == thinhmodal) {
      thinhmodal.style.display = "none";
    }
}

var minhmodal = document.getElementById("minhmodal")
var minhbutton = document.getElementById("minh-info");
var minhspan = document.getElementsByClassName("minhclose")[0];
minhbutton.onclick = function() {
    minhmodal.style.display = "block";
}
minhspan.onclick = function() {
    minhmodal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == minhmodal) {
      minhmodal.style.display = "none";
    }
}

var hienmodal = document.getElementById("hienmodal")
var hienbutton = document.getElementById("hien-info");
var hienspan = document.getElementsByClassName("hienclose")[0];
hienbutton.onclick = function() {
    hienmodal.style.display = "block";
}
hienspan.onclick = function() {
    hienmodal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == hienmodal) {
      hienmodal.style.display = "none";
    }
}

var nhatmodal = document.getElementById("nhatmodal")
var nhatbutton = document.getElementById("nhat-info");
var nhatspan = document.getElementsByClassName("nhatclose")[0];
nhatbutton.onclick = function() {
    nhatmodal.style.display = "block";
}
nhatspan.onclick = function() {
    nhatmodal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == nhatmodal) {
      nhatmodal.style.display = "none";
    }
}