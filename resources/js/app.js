import Alpine from 'alpinejs';
import _ from 'lodash';
import axios, { HttpStatusCode } from 'axios';

window._ = _;

window.HttpStatusCode = HttpStatusCode;
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Alpine = Alpine;
Alpine.start();
