import $ from 'jquery';
import axios from 'axios';

window.$ = $;
window.jQuery = $;
window.axios = axios;

// Set default CSRF token for all axios requests
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]')?.content;

import 'popper.js';
import 'bootstrap/dist/js/bootstrap.min.js';