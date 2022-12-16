const decrementButton = document.getElementById("decrement");
const incrementButton = document.getElementById("increment");
const changeBtn = document.querySelector(".change-btn");
const count = document.getElementById("count");
const ones = document.querySelector(".ones");
const twos = document.querySelector(".twos");
const infoPopup = document.querySelector(".info-popup");
const infoPopup1 = document.querySelector(".info-popup1");
const infoPopup2 = document.querySelector(".info-popup2");
const Info = document.querySelector(".info");
const Info1 = document.querySelector(".info1");
const Info2 = document.querySelector(".info2");
const edit = document.querySelector(".edit");
const inputText = document.querySelector(".value");

decrementButton.addEventListener("click", () => {
  count.innerText = parseInt(count.innerText, 10) - 1;
});

incrementButton.addEventListener("click", () => {
  count.innerText = parseInt(count.innerText, 10) + 1;
});

changeBtn.addEventListener("click", function () {
  ones.classList.toggle("hide");
  twos.classList.toggle("hide");
});

Info.addEventListener("mouseover", function () {
  infoPopup.classList.add("show-popup");
});
Info.addEventListener("mouseout", function () {
  infoPopup.classList.remove("show-popup");
});
Info1.addEventListener("mouseover", function () {
  infoPopup1.classList.add("show-popup");
});
Info1.addEventListener("mouseout", function () {
  infoPopup1.classList.remove("show-popup");
});
Info2.addEventListener("mouseover", function () {
  infoPopup2.classList.add("show-popup");
});
Info2.addEventListener("mouseout", function () {
  infoPopup2.classList.remove("show-popup");
});
document.addEventListener("DOMContentLoaded", function () {
  inputText.value = "1418";
});
edit.addEventListener("click", function () {
  inputText.value = "";
});
