

  // *********
  // NAVMENU
  // **********

  const btnNav = document.getElementById("toggle-mobile-nav");
  const header = document.getElementsByClassName("menu--main").item(0);
  btnNav.addEventListener("click", function () {
    header.classList.toggle("nav-open");
  });
