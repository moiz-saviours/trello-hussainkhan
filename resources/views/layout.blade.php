<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.3/css/buttons.dataTables.min.css">


    <style>
        section {
            margin-top: 20px;
        }

        .custom_button {

            margin: 10px 20px;
        }

        .fa-edit:before,
        .fa-pen-to-square:before {
            content: "\f044";
            color: #fff !important;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 34px;
            height: 20px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 12px;
            width: 12px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: green;
        }

        input:checked+.slider:before {
            transform: translateX(14px);
        }

        .slider.round {
            border-radius: 20px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>


</head>

<body>

    <h1>This is Header</h1>

    @yield('content')



    <h1>This Is Footer</h1>


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {

            function getParam(key, value) {

                var url = new URL(window.location.href); // Get current URL
                var params = new URLSearchParams(url.search); // Get search parameters
                // If the key already exists, update its value, else add a new key-value pair
                if (value === '') {
                    params.delete(key); // Remove the key if the value is empty
                } else {
                    // If the key already exists, update its value, else add a new key-value pair
                    if (params.has(key)) {
                        params.set(key, value);
                    } else {
                        params.append(key, value);
                    }
                }
                // Update the URL with the new parameters
                url.search = params.toString();
                window.history.pushState({}, '', url.toString());

                return url.toString();
            }
            $('#example_filter input[type="search"]').on('keyup', function() {
                let searchValue = table.search(); // Get the current search term
                getParam('search', searchValue); // Update URL with the new value
            });
            var urlParams = new URLSearchParams(window.location.search);
            var searchValue = urlParams.get('search'); // Get the 'search' parameter value from the URL
            if (searchValue) {
                $('#example_filter input[type="search"]').val(searchValue);
                table.search(searchValue).draw(); // Perform the search and redraw the table
            }

        });
    </script>
    @stack('script')
    <script>
        $(document).ready(function() {

            $(".table").each(function() {
                if ($.fn.DataTable.isDataTable(this)) {
                    let id = $(this).attr("id");
                    // console.log(id);
                }

            });

        });
    </script>
</body>

</html>
