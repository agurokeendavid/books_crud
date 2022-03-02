$(document).ready(function() {
    $('#booksTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            }
        ]
    });
});