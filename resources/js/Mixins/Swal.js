import Swal from "sweetalert2"  ;

export const SwalTailwind = Swal.mixin({
        customClass: {
            confirmButton: 'px-2 py-1 lg:px-3 lg:py-1.5 mx-1 text-white  rounded  transition duration-300 bg-indigo-900 hover:bg-indigo-900/90 hover:text-white focus:outline-none focus:ring-4 focus:ring-indigo-900/25 focus:bg-indigo-900/90',
            cancelButton: 'px-2 py-1 lg:px-3 lg:py-1.5 mx-1 text-white rounded transition duration-300 bg-red-500 hover:bg-red-500/90 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-500/25 focus:bg-red-500/90'
        },
        buttonsStyling: false, 
        reverseButtons: true,
    }) ;
