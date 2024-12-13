@extends('layout')


@section('content')
    <button type="button" class="btn btn-primary" id="openModal" data-toggle="modal" data-target="#addBoardList">
        Add Board List
    </button>


    <div class="modal fade" id="addBoardList" tabindex="-1" role="dialog" aria-labelledby="addBoardListModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBoardListModal">Add New Board List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="BoardListForm">
                        @csrf

                        <div class="form-group">
                            <label for="name">Board List Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>


                        <button type="submit" class="btn btn-primary">Add Board</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    @push('script')
        <script>
            $(document).ready(function() {

                $('#BoardListForm').submit(function(event) {
                    event.preventDefault();
                    var formData = new FormData(this);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('board_list.store') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            const isActiveToggle = `
                        <label class="switch">
                            <input type="checkbox" class="toggle-status" data-id="${response.id}" ${response.is_active ? 'checked' : ''}>
                            <span class="slider round"></span>
                        </label>`;
                            response.id,
                                response.name,


                                $('#addBoardList').modal('hide');
                            $('#BoardListForm')[0].reset();
                        },
                        error: function(xhr) {
                            alert("Error while adding Board.");
                        }
                    });
                });

            });
        </script>
    @endpush
@endsection
