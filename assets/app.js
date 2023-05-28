// assets/app.js
//vueJs
//import { registerVueControllerComponents } from '@symfony/ux-vue';
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (style.scss in this case)
import './styles/style.scss';

// start the Stimulus application
import './bootstrap';

// import Swiper JS
import Swiper from 'swiper/bundle';
// import Swiper styles
import 'swiper/css/bundle';
//carousel gallery trick
const progressCircle = document.querySelector(".autoplay-progress svg");
const progressContent = document.querySelector(".autoplay-progress span");

const swiper = new Swiper(".mySwiper", {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
    },
    on: {
        autoplayTimeLeft(s, time, progress) {
            progressCircle.style.setProperty("--progress", 1 - progress);
            progressContent.textContent = `${Math.ceil(time / 1000)}s`;
        }
    }
});


function readURL(input) { //nom de la function à appeler dans l'attribut onchange de l'input
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById('blah').setAttribute('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

window.readURL = readURL;

function clean_textarea()
{
    //const newCommentSoumettre = document.getElementById("comment_soumettre");
    const newComment = document.getElementById("comment_comment");
    //const alert = document.getElementsByClassName("alert-success")[0];



        newComment.value = "";
}

window.clean_textarea = clean_textarea;