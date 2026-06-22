import './bootstrap';
import Masonry from 'masonry-layout';
import imagesLoaded from 'imagesloaded';
import GLightbox from 'glightbox';
import 'bootstrap-icons/font/bootstrap-icons.css';
import 'glightbox/dist/css/glightbox.css';

window.Masonry = Masonry;
window.imagesLoaded = imagesLoaded;
window.GLightbox = GLightbox;


const navbar = document.querySelector('.layout-navbar');
if (window.innerWidth <= 990) {
    navbar.classList.add('navbar-scrolled');
}

window.addEventListener('scroll', () => {
    navbar.classList.toggle(
        'navbar-scrolled',
        window.scrollY > 50
    );
});