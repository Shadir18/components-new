import './bootstrap';
import $ from 'jquery';
import axios from 'axios';

window.$ = $;
window.jQuery = $;
window.axios = axios;

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]')?.content;

import 'popper.js';
import "admin-lte/dist/css/adminlte.min.css"
import "bootstrap-icons/font/bootstrap-icons.css"
import "overlayscrollbars/styles/overlayscrollbars.css";
import "bootstrap"
import "admin-lte"