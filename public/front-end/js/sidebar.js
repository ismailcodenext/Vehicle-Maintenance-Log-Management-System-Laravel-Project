const listItems = document.querySelectorAll(".sidebar-list li");
const subListItems = document.querySelectorAll(".submenu");

listItems.forEach((item) => {
  item.addEventListener("click", (e) => {
    let isActive = item.classList.contains("active");

    listItems.forEach((el) => {
      el.classList.remove("active");
    });

    item.classList.add("active");
    console.log(e.target.parentElement);
    if (e.target.parentElement.classList.contains("title")) {
      if (isActive) item.classList.remove("active");
    } else if (e.target.parentElement.classList.contains("link")) {
      if (isActive) item.classList.remove("active");
    }
  });
});

subListItems.forEach((item) => {
  item.addEventListener("click", (e) => {
    let isActive = item.classList.contains("active");

    listItems.forEach((el) => {
      el.classList.remove("active");
    });

    item.classList.add("active");
    console.log(e.target.parentElement);
    if (e.target.parentElement.classList.contains("sub-title")) {
      if (isActive) item.classList.remove("active");
    } else if (e.target.parentElement.classList.contains("sub-link")) {
      if (isActive) item.classList.remove("active");
    }
  });
});



/// sidebar

const toggleSidebar = document.querySelector(".toggle-sidebar");
const logo = document.querySelector(".logo-box");
const sidebar = document.querySelector(".sidebar");

toggleSidebar.addEventListener("click", () => {
  sidebar.classList.toggle("close");
  let toggleSidebarIcon = toggleSidebar.querySelector(".toggle-sidebar svg");
  toggleSidebarIcon.classList.toggle("active");
});

logo.addEventListener("click", () => {
  sidebar.classList.toggle("close");
});

// if device width 900px to sidebar auto close
let media = window.matchMedia("(max-width: 900px)");

function mediaToggle(e) {
  if (e.matches) {
    sidebar.classList.add("close");
  } else {
    sidebar.classList.remove("close");
  }
}
media.addListener(mediaToggle);

let arrows = document.querySelectorAll(".arrow");
arrows.forEach((arrow) => {
    arrow.addEventListener("click", (e) => {
        let arrowParent = e.target.closest("li"); // Find the closest parent <li> element

        // Toggle 'showMenu' and add 'active' class to the clicked item's parent
        arrowParent.classList.toggle("showMenu");
    });
});

let sidebarBtn = document.querySelector(".open_btn");
console.log(sidebarBtn);
sidebarBtn.addEventListener("click", () => {
    sidebar.classList.toggle("close");
});
