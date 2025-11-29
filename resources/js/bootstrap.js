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
window.Swal = window.Swal.mixin({
    customClass: {
        popup: "!relative !transform !overflow-hidden !rounded-lg !bg-white !text-left !shadow-xl !transition-all !w-full !max-w-sm sm:!max-w-lg !p-0 !grid-cols-none !mx-4 sm:!mx-auto sm:!my-8",
        icon: '!m-0 !mx-auto !flex !h-12 !w-12 !flex-shrink-0 !items-center !justify-center !rounded-full !border-0 !bg-red-100 sm:!h-10 sm:!w-10 !mt-5 sm:!mt-6 sm:!ml-6 !col-start-1 !col-end-3 sm:!col-end-2',
        title: "!p-0 !pt-3 !text-center sm:!text-left !text-lg sm:!text-base !font-semibold !leading-6 !text-gray-900 !px-4 sm:!pl-0 sm:!pr-6 sm:!pt-6 sm:!ml-4 !col-start-1 sm:!col-start-2 !col-end-3",
        htmlContainer: "!mt-2 sm:!mt-0 !m-0 !text-center sm:!text-left !text-sm !text-gray-500 !px-4 sm:!pl-0 sm:!pr-6 !pb-4 sm:!ml-4 !col-start-1 sm:!col-start-2 !col-end-3",
        actions: "!bg-gray-50 !px-4 !py-3 sm:!flex sm:!flex-row-reverse sm:!px-6 !w-full !justify-start !mt-0 !col-start-1 !col-end-3",
        confirmButton: "inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto cursor-pointer",
        cancelButton: "mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto cursor-pointer",
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
