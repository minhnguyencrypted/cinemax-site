const cookieBanner = document.querySelector(".cookie-container");
const acceptButton = document.querySelector(".cookie-button");


acceptButton.addEventListener("click", () => {
  cookieBanner.classList.remove("active");
  localStorage.setItem("cookieBannerDisplayed", "true");
});

setTimeout(() => {
  if (!localStorage.getItem("cookieBannerDisplayed")) {
    cookieBanner.classList.add("active");
  }
}, 2000);


