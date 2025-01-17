

  // *********
  // NAVMENU
  // **********

  const btnNav = document.getElementById("toggle-mobile-nav");
  const header = document.getElementsByClassName("menu--main").item(0);
  console.log('test');
  console.log(header);
  console.log(btnNav);
  btnNav.addEventListener("click", function () {
    header.classList.toggle("nav-open");
    console.log(header.classList);
  });
