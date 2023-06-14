var toggler = document.getElementsByClassName("jscaret");
var i;

for (i = 0; i < toggler.length; i++) {
  toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".jsnested").classList.toggle("jsactive");
    this.classList.toggle("jscaret-down");
  });
}