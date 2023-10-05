const formNames = ["email", "username", "tel", "counter", "credit", "consent"];

const form = document.querySelector("#form");
const spinner = document.querySelector(".spinner");
const sended = document.querySelector(".sended");
const showButton = document.getElementById("showList");
const reviewsSection = document.querySelector(".reviews");
const counter = document.querySelector("#persons");
const increaseCounter = document.querySelector("#plus");
const decreaseCounter = document.querySelector("#minus");
const popup = document.getElementById("popup");
const closePopup = document.getElementById("close_popup");

window.onload = () =>
  setTimeout(() => {
    popup.classList.remove("hidden");
    popup.classList.add("fixed");
  }, 20 * 1000);

closePopup.onclick = () => popup.classList.add("hidden");

showButton.onclick = () => {
  reviewsSection.classList.toggle("expanded");
};

const changeCounter = (e) => {
  const value = parseInt(counter.value, 10);
  const updated = value + (e.target.id === "plus" ? 1 : -1);

  if (updated < 1 || updated > 6) {
    return;
  }

  counter.value = updated;
};

decreaseCounter.onclick = increaseCounter.onclick = changeCounter;

form.onsubmit = async (e) => {
  e.preventDefault();
  form.classList.add("hidden");
  spinner.classList.remove("hidden");

  const formInput = new FormData(form);

  try {
    const response = await fetch("send.php", {
      method: "POST",
      body: formInput,
    });

    if (!response.ok) {
      throw new Error("Произошла ошибка при отправке данных");
    }

    const responseText = await response.text();
    console.log(responseText);
    spinner.classList.add("hidden");
    sended.classList.remove("hidden");
  } catch (error) {
    console.error(error);
    spinner.classList.add("hidden");
    form.classList.remove("hidden");
    // Возможно, вы захотите добавить обработку ошибок на вашей странице
  }
};
