

@extends('layout')

@section('content')

<div class="container-fluid">
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>User</th>
                <th>Logs</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
            <tr>
                <td>
                    {{ $log->user->name }}
                </td>
                <td>
                    {{ $log->action === 'create' ? 'created a new' : ($log->action === 'status changed' ? 'changed status of' : ($log->action === 'updated' ? 'updated' : 'deleted')) }} 
                    {{ class_basename($log->model_type) }}: {{ $log->entity_name }}
                </td>
                <td>{{ $log->created_at->timezone('Asia/Karachi')->diffForHumans() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.3/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                dom: 'Blfrtip',
                buttons: [
                    'copy',
                    'csv',
                    'excel',
                    'pdf',
                    'print',
                ],
                responsive: true,
                

            });

        });
    </script>
@endsection