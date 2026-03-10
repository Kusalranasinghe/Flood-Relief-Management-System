/*function confirmAction(message) {
    return confirm(message);
}

function showSuccess(message) {
    alert(message);
}*/

window.addEventListener('scroll', function() {
  const nav = document.querySelector('.navbar');
  if (window.scrollY > 50) {
    nav.classList.add('scrolled');
  } else {
    nav.classList.remove('scrolled');
  }
});