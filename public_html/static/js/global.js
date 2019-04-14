$(document.body).on("click", ".page-href", ev => {
   let i = ev.currentTarget;
   window.location.href = i.getAttribute("data-page");
   console.log("hi");
});