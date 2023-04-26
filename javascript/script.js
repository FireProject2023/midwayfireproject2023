function showCOT() {
    const divCOT = document.getElementById("divCOT");
    if (divCOT.style.display = "none") {divCOT.style.display = "block";}
    else {divCOT.style.display = "none";}
};//close showCOT

/*
//SIGNATURE PAD - Referenced from https://dev.to/stackfindover/how-to-create-signature-pad-in-html-signature-pad-javascript-3866
var canvas = document.getElementById("signature-pad");

function resizeCanvas() {
    var ratio = Math.max(window.devicePixelRatio || 1, 1);
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;
    canvas.getContext("2d").scale(ratio, ratio);
}
window.onresize = resizeCanvas;
resizeCanvas();

var signaturePad = new SignaturePad(canvas, {
    backgroundColor: 'rgb(250,250,250)'
});

document.getElementById("clear").addEventListener('click', function(){
    signaturePad.clear();
})

 */
