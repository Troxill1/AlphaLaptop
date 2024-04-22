function toggleStar(element, index) {
  document.getElementById('rating').value = index + 1;

  // Toggle the fas/fa-star classes to change from empty to filled star
  element.classList.toggle('fas');
  element.classList.toggle('far');

  // Change the icon of previous stars as well
  for (let i = 0; i < index; i++) {
    let star = document.querySelectorAll('.write-comment .fa-star')[i];
    star.classList.add('fas');
    star.classList.remove('far');
  }
  
  // Change the icon of stars after the clicked one
  for (let i = index + 1; i < 5; i++) {
    let star = document.querySelectorAll('.write-comment .fa-star')[i];
    star.classList.remove('fas');
    star.classList.add('far');
  }
}