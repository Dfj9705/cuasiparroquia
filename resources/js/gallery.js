import Masonry from 'masonry-layout';
import imagesLoaded from 'imagesloaded';
import GLightbox from 'glightbox';
import '../../node_modules/glightbox/dist/css/glightbox.min.css';

document.addEventListener('DOMContentLoaded', () => {

    const grid = document.querySelector('#gallery-grid');
    if (!grid) return;

    imagesLoaded(grid, () => {
        new Masonry(grid, {
            itemSelector: '.gallery-item',
            percentPosition: true,
        });
    });

    GLightbox({
        selector: '.gallery-lightbox',
        touchFollowAxis: false,
        touchNavigation: true,
        loop: true,
    });
});