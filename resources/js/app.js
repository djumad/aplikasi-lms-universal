import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();

import AOS from "aos";
import "aos/dist/aos.css";

AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true,
});

window.livewire.on('livewire:update', () => {
    AOS.refresh();
});
