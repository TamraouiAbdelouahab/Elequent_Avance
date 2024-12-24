import 'admin-lte/dist/css/adminlte.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'admin-lte/dist/js/adminlte.min.js';
import 'bootstrap/dist/js/bootstrap.bundle.min.js'

import $ from 'jquery';
import select2 from 'select2';
import 'select2/dist/css/select2.min.css';

select2();

$(document).ready(function() {
    console.log('jQuery et Select2 sont chargés');

    $('#tags').select2({
        placeholder: "Choisissez des options",
        allowClear: true
    });
});



// // import "https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"


// $(document).ready(function () {
//     $('#select2Multi').select2({
//         placeholder: "Choisissez vos options",
//         allowClear: true
//     });
// });


// console.log(select2);




