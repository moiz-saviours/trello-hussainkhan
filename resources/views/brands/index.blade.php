@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="custom_button">
                    <button type="button" class="btn btn-primary" id="openModal" data-toggle="modal"
                        data-target="#addBrandModal">
                        Add Brand
                    </button>
                    <div class="right_btn">
                        <div class="form-group">
                            <label for="brandSelect">Select Brand</label>
                            <select class="form-control" id="brandSelect">
                                <option value="0" {{ $brandKey == 0 ? 'selected' : '' }}>All</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->code }}" {{ $brandKey == $brand->code ? 'selected' : '' }}>
                                        {{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section>
        <div class="container-fluid">
            <table id="brandTable" class="display table" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>URL</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td>
                                @if ($brand->image)
                                    <img class="rounded-circle" src="{{ asset('images/' . $brand->image) }}" width="50"
                                        height="50" alt="Brand Image">
                                @else
                                    No image
                                @endif
                            </td>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->code }}</td>
                            <td>{{ $brand->url }}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-id="{{ $brand->id }}"
                                        {{ $brand->is_active ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <button class="btn btn-warning editBrandBtn" data-id="{{ $brand->id }}"
                                    data-name="{{ $brand->name }}" data-code="{{ $brand->code }}"
                                    data-url="{{ $brand->url }}" data-image="{{ asset('images/' . $brand->image) }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger deleteBrandBtn" data-id="{{ $brand->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    @include('brands.add_modal')

    @include('brands.edit_modal')
@endsection



@push('script')


        


   

    <script>
        $(document).ready(function() {
            var table = $('#brandTable').DataTable({
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


            $('#brandForm').submit(function(event) {
                event.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "{{ route('brands.store') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        const isActiveToggle = `
                        <label class="switch">
                            <input type="checkbox" class="toggle-status" data-id="${response.id}" ${response.is_active ? 'checked' : ''}>
                            <span class="slider round"></span>
                        </label>`;

                        table.row.add([
                            response.id,
                            response.image ?
                            `<img class="rounded-circle" src="{{ asset('images') }}/${response.image}" width="50" height="50">` :
                            'No image',
                            response.name,
                            response.code,
                            response.url,
                            isActiveToggle, // Toggle switch HTML for 'Active/Inactive' status
                            `<button class="btn btn-warning editBrandBtn" data-id="${response.id}" data-name="${response.name}" data-code="${response.code}" data-url="${response.url}" data-image="{{ asset('images') }}/${response.image}">
                                <i class="fas fa-edit"></i>
                            </button>` +
                            `<button class="btn btn-danger deleteBrandBtn" data-id="${response.id}">
                                <i class="fas fa-trash"></i>
                            </button>`
                        ]).draw();


                        $('#brandSelect').append(
                            `<option value="${response.code}">${response.code}</option>`);


                        $('#addBrandModal').modal('hide');
                        $('#brandForm')[0].reset();
                    },
                    error: function(xhr) {
                        alert("Error while adding brand.");
                    }
                });
            });
            //edit brand

            $(document).on('click', '.editBrandBtn', function() {

                $('#editBrandModal .modal-body img').remove();

                const brandId = $(this).data('id');
                const brandName = $(this).data('name');
                const brandCode = $(this).data('code');
                const brandUrl = $(this).data('url');
                const brandImage = $(this).data('image');

                $('#editBrandId').val(brandId);
                $('#editName').val(brandName);
                $('#editCode').val(brandCode);
                $('#editUrl').val(brandUrl);

                // Display existing image in modal  
                if (brandImage) {
                    $('#editBrandModal .modal-body').prepend(
                        `<img src="${brandImage}" alt="Brand Image" class="img-fluid mb-2" width="100">`
                    );
                }

                $('#editBrandModal').modal('show');
            });




            $('#editBrandForm').submit(function(event) {
                event.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: `/brands/${$('#editBrandId').val()}/update`,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        var row = table.row($(`button[data-id="${response.id}"]`).closest(
                        'tr'));
                        row.data([
                            response.id,
                            response.image ?
                            `<img class="rounded-circle" src="{{ asset('images') }}/${response.image}" width="50" height="50">` :
                            'No image',
                            response.name,
                            response.code,
                            response.url,
                            `<label class="switch">
                    <input type="checkbox" class="toggle-status" data-id="${response.id}" ${response.is_active ? 'checked' : ''}>
                    <span class="slider round"></span>
                </label>`,
                            `<button class="btn btn-warning editBrandBtn" data-id="${response.id}" data-name="${response.name}" data-code="${response.code}" data-url="${response.url}" data-image="{{ asset('images') }}/${response.image}">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-danger deleteBrandBtn" data-id="${response.id}">
                    <i class="fas fa-trash"></i>
                </button>`
                        ]).draw(); // This will update the specific row in DataTable

                        $('#editBrandModal').modal('hide');
                    },
                    error: function(xhr) {
                        alert("Error while updating brand.");
                    }
                });
            });


            //delete brand

            $(document).on('click', '.deleteBrandBtn', function() {
                let brandId = $(this).data('id');

                $.ajax({
                    type: "DELETE",
                    url: `/brands/${brandId}`,
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        table.row($(`button[data-id="${brandId}"]`).closest('tr')).remove()
                            .draw();

                    },
                    error: function(xhr) {
                        let errorMessage = xhr.responseJSON?.message ||
                            "Error while deleting brand.";
                        alert(errorMessage);
                    }
                });
            });

            // Filter

            // Example usage:
            $('#brandSelect').change(function() {
                var brandValue = $(this).val(); // Get selected brand value
                var updatedUrl = getParam('brandKey', brandValue); // Update URL with the new value
                window.location.href = updatedUrl;
            });
            $('#teamSelect').change(function() {
                var teamValue = $(this).val(); // Get selected team value
                var updatedUrl = getParam('teamKey', teamValue); // Update URL with the new value
                window.location.href = updatedUrl;
            });


            // Status Toggle

            $(document).on('change', '.toggle-status', function() {
                const brandId = $(this).data('id');
                const isActive = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    type: "POST",
                    url: `/brands/${brandId}/toggle-status`,
                    data: {
                        _token: "{{ csrf_token() }}",
                        is_active: isActive
                    }
                });
            });

        });
    </script>
@endpush
