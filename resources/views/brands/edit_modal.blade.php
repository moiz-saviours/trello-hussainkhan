<div class="modal fade" id="editBrandModal" tabindex="-1" role="dialog" aria-labelledby="editBrandModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBrandModalLabel">Edit Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editBrandForm">
                        @csrf
                        @method('POST')
                        <input type="hidden" id="editBrandId">
                        <div class="form-group">
                            <label for="editImage">Brand Image:</label>
                            <input type="file" class="form-control" id="editImage" name="image">
                        </div>
                        <div class="form-group">
                            <label for="editName">Brand Name:</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="editCode">Code:</label>
                            <input type="number" class="form-control" id="editCode" name="code" required>
                        </div>
                        <div class="form-group">
                            <label for="editUrl">URL:</label>
                            <input type="text" class="form-control" id="editUrl" name="url" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Brand</button>
                    </form>
                </div>
            </div>
        </div>
    </div>