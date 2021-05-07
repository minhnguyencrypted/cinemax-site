const cookieContainer = document.querySelector(".cookie_container");
const cookieButton = document.querySelector(".cookie_button");

cookieButton.addEventListener("click", () => {
  cookieContainer.classList.remove("active");
  localStorage.setItem("Cookie_Banner_Displayed", "true");
});

setTimeout(() => {
  if (!localStorage.getItem("Cookie_Banner_Displayed")) {
    cookieContainer.classList.add("active");
  }
}, 100);
