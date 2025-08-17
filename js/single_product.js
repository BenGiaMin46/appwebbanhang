var mainImg = document.getElementById("main-img");
var smallImg = document.getElementsByClassName("small-img");

for (let i = 0; i < 4; i++) {
    smallImg[i].onmouseover = function () {
        mainImg.src = smallImg[i].src;
    }
}
