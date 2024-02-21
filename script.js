//SCRIPT for loader
document.onreadystatechange = function() {
    if (document.readyState !== "complete") {
      document.querySelector(
      "body").style.visibility = "hidden";
      document.querySelector(
      "#loader").style.visibility = "visible";
    } else {
      document.querySelector(
      "#loader").style.display = "none";
      document.querySelector(
      "body").style.visibility = "visible";
    }
  };
  
  AOS.init({
easing: 'ease-out-back',
duration: 1000
});