// add fund card
function checkChange(clickedCheckbox) {
  const checkboxes = document.querySelectorAll('input[name="plan"]');

  if (clickedCheckbox.checked) {
    checkboxes.forEach(checkbox => {
      if (checkbox !== clickedCheckbox) {
        checkbox.checked = false;
      }
    });
  }
}

// sign in and sign up page circle animation
const circles = document.querySelector(".circles");

setInterval(() => {
  if (circles.classList.contains("active")) {
    circles.classList.remove("active");
  } else {
    circles.classList.add("active");
  }
}, 3000);

