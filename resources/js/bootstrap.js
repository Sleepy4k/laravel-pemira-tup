import axios from 'axios';
import Swal from 'sweetalert2/dist/sweetalert2';
import 'sweetalert2/src/sweetalert2.scss';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.withCredentials = true;

const token = document.head.querySelector('meta[property="csrf-token"]')?.getAttribute('content') || null;
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
}

window.Swal = Swal;
window.Swal.mixin({
    customClass: {
        confirmButton: 'bg-primary-600 mx-2',
        cancelButton: 'bg-secondary-600 mx-2',
    },
    buttonsStyling: false,
});

window.Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    customClass: {
        popup: 'bg-gray-800 text-white rounded-md shadow-lg',
    },
});
