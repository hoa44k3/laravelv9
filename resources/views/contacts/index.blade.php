<!-- resources/views/contacts/index.blade.php -->
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
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Danh sách liên hệ</h4>
                    </div>
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="laravel_9_datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Họ và tên</th>
                                    <th>Email</th>
                                    <th>Tin nhắn</th>
                                    <th>Ngày gửi</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $contact)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->message }}</td>
                                        <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                                        <td>    
                                                            
                                            <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $contact->id }}">Xóa</button>
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
