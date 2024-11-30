
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
                                            <button type="button" class="btn btn-success btn-sm btn-reply" data-id="{{ $contact->id }}" data-name="{{ $contact->name }}" data-email="{{ $contact->email }}">
                                                Phản hồi
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $contact->id }}">
                                                Xóa
                                            </button>
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
<div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="replyModalLabel">Phản hồi liên hệ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="replyForm" method="POST" action="{{ route('contacts.reply') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="contact_id" id="contact_id">
                    <div class="mb-3">
                        <label for="contact_name" class="form-label">Tên khách hàng</label>
                        <input type="text" class="form-control" id="contact_name" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="response" class="form-label">Phản hồi</label>
                        <textarea name="response" id="response" class="form-control" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Gửi phản hồi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script')
<script>
    document.querySelectorAll('.btn-reply').forEach(button => {
    button.addEventListener('click', function () {
        const id = this.getAttribute('data-id');
        const name = this.getAttribute('data-name');
        const email = this.getAttribute('data-email');

        document.getElementById('contact_id').value = id;
        document.getElementById('contact_name').value = name;

        const modal = new bootstrap.Modal(document.getElementById('replyModal'));
        modal.show();
    });
});

</script>
