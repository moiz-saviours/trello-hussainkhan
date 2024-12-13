@extends('layout')

@section('content')
<button type="button" class="btn btn-primary" id="openModal" data-toggle="modal" data-target="#addCard">
    Add Card
</button>

<div class="modal fade" id="addCard" tabindex="-1" role="dialog" aria-labelledby="addCardModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addCardModalLabel">Add New Card</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="CardForm">
                @csrf
               
                <div class="form-group">
                    <label for="name">Card Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="code">Start Date</label>
                    <input type="date" class="form-control" id="startdate" name="startdate" required>
                </div>
                <div class="form-group">
                    <label for="code">Due Date</label>
                    <input type="date" class="form-control" id="duedate" name="duedate" required>
                </div>
                

                <div class="form-group">
                    <label for="code">Tags</label>
                    <input type="text" class="form-control" id="tags" name="tags" required>
                </div>
                <div class="form-group">
                    <label for="image">Card Image:</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <div class="form-group">
                    <label for="url">Priority</label>
                    <input type="text" class="form-control" id="priority" name="priority" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Card</button>
            </form>
        </div>
    </div>
</div>
</div>



@endsection

@push('script')

<script>
     $(document).ready(function() {

    $('#CardForm').submit(function(event) {
                event.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "{{ route('cards.store') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                            response.id,
                            response.image ?
                            `<img class="rounded-circle" src="{{ asset('images') }}/${response.image}" width="50" height="50">` :
                            'No image',
                            response.name,
                            response.startdate,
                            response.duedate,
                            response.tags,
                            response.priority,
                        $('#addCard').modal('hide');
                        $('#CardForm')[0].reset();
                    },
                    error: function(xhr) {
                        alert("Error while adding Cards.");
                    }
                });
            });

        });
</script>
    
@endpush