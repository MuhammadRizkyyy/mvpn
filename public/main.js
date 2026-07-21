document.querySelectorAll('.vm-box').forEach(box => {
    box.addEventListener('click', () => {
        box.classList.toggle('clicked');
    });
});
