<!DOCTYPE html>
<html>
<head>
    <title>Data Table</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
</head>
<body>
    <table id="myTable" class="table table-striped">
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Name</th>
                <th>Phone</th>
                <th>State</th>
                <th>District</th>
                <th>City</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "atblefetch.php", // Replace with your PHP script URL
                    "type": "POST"
                },
                "columns": [
                    { "data": "sr_no" },
                    { "data": "name" },
                    { "data": "phone" },
                    { "data": "state" },
                    { "data": "district" },
                    { "data": "city" }
                ],
                "dom": 'Bfrtip',
                "buttons": [
                    'copy', 'excel', 'pdf'
                ]
            });

            // Add filtering to all columns
            $('#myTable').DataTable().columns().every( function () {
                var that = this;
                $( 'input', this.header() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        });
    </script>
</body>
</html>