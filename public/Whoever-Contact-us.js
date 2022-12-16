const container = document.querySelector(".container");
const mainContainer = document.querySelector(".main-container");
const btnOne = document.querySelector(".btn-button");
const btnTwo = document.querySelector(".btn2-button");
const predefinedText = document.querySelector(".predefined-text");
const inputText = document.querySelector(".inputText");

btnOne.addEventListener("click", function () {
  mainContainer.classList.add("hide");
  container.classList.add("show");
});
btnTwo.addEventListener("click", function () {
  mainContainer.classList.remove("hide");
  container.classList.remove("show");
});
predefinedText.addEventListener("click", function () {
  inputText.value = "Hey Seller, can you help me with";
});
