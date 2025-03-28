document.addEventListener('DOMContentLoaded', () => {
  const menuItems = document.querySelectorAll('.menu-item a');

  menuItems.forEach((item) => {
    item.addEventListener('click', () => {
      document.querySelector('.menu-item.active')?.classList.remove('active');
      item.parentElement.classList.add('active');
    });
  });
});
