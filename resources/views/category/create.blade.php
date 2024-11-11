
@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Create New Category</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <input type="text" class="form-control" id="comment" name="comment">
                        </div>
                        <div class="form-group">
                            <label for="image_path">Image</label>
                            <input type="file" class="form-control" id="image_path" name="image_path">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script') 