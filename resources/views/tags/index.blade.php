@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')

<style>
    .table tbody tr:hover {
    background-color: #e8f0fe;
}

.table thead th, .table tbody td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

    .table thead th {
    background-color: #717172;
    color: white;
}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Danh sách thẻ </h4>
                        <a href="{{ route('tags.create') }}" class="btn btn-primary btn-round ms-auto">
                            <i class="fa fa-plus"></i> Thêm thẻ
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody id="likesTable">
                                @foreach ($tags as $tag)
                                    <tr>
                                        <td>{{ $tag->id }}</td>
                                        <td>{{ $tag->name }}</td>
                                        <td>
                                            <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                            <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $tag->id }}">Xóa</button>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script') 
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const tagId = this.getAttribute('data-id');
                if (confirm('Bạn có chắc chắn muốn xóa thẻ tag này?')) {
                    fetch(`/tags/${tagId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            alert('Xóa thành công');
                            location.reload();
                        } else {
                            alert('Có lỗi xảy ra khi xóa!');
                        }
                    });
                }
            });
        });
    });
</script>


