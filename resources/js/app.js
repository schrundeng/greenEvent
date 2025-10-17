import "./bootstrap";
import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();

import AOS from 'aos';
import 'aos/dist/aos.css';

AOS.init({
  duration: 800, // kecepatan animasi (ms)
  easing: 'ease-in-out', // transisi halus
  once: true, // animasi hanya jalan sekali
});
