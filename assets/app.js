// assets/app.js
//vueJs
import { registerVueControllerComponents } from '@symfony/ux-vue';
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

//registerVueControllerComponents(require.context('./vue/controllers', true, /\.vue$/));


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

