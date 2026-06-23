import * as bootstrap from 'bootstrap';

window.bootstrap = bootstrap;

import { Fancybox } from "@fancyapps/ui";
import "@fancyapps/ui/dist/fancybox/fancybox.css";

Fancybox.bind("[data-fancybox]", {
    Thumbs: {
        autoStart: true,
    },
});