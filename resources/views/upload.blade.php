<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
</head>

<body class="font-roboto">
    <div class="flex justify-between items-center p-4 border-b">
        <div class="flex items-center space-x-2">
            <i class="fas fa-info-circle"></i>
            <span>Giới thiệu</span>
            <i class="fas fa-language"></i>
            <span>VI</span>
        </div>
        <div class="flex items-center space-x-4">
            <i class="fas fa-cloud-upload-alt"></i>
            <span>Upload</span>
        </div>
    </div>

    <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="text-center mt-8">
            <img alt="ImgBB logo" class="mx-auto mb-4" height="50"
                src="https://storage.googleapis.com/a1aa/image/d2HOaPSRz4rhERa8qsXerllHbpPkIRrwmevajqMEr9TEdQlTA.jpg"
                width="100" />
            <h1 class="text-2xl font-bold mb-2">Thêm hoặc xóa bất kỳ tài nguyên nào của bạn</h1>
            <p class="text-gray-600 mb-4">
                Bạn có thể thêm nhiều dữ liệu từ
                <a class="text-blue-500" href="#">máy tính của bạn</a>
                hoặc
                <a class="text-blue-500" href="#">thêm địa chỉ tài nguyên</a>.
            </p>

            <label for="file">Choose an image or video:</label>
            <input type="file" name="file" id="file" required accept="image/*,video/*">

            <div class="mb-4">
                <label class="block mb-2" for="auto-delete">Tự động xóa ảnh/video</label>
                <select class="border p-2" id="auto-delete">
                    <option>Sau 1 ngày</option>
                </select>
            </div>

            <button class="bg-green-500 text-white px-6 py-2 rounded" type="submit">TẢI LÊN NGAY</button>

            <!-- Hiển thị thông báo thành công và file tải lên -->
            @if (session('success'))
                <div class="alert alert-success mt-4">
                    {{ session('success') }}
                </div>

                <!-- Hiển thị hình ảnh hoặc video đã tải lên -->
                @if (session('file'))
                    @if (str_contains(session('file')->type, 'image'))
                        <img class="mt-4 mx-auto" src="{{ session('file')->url }}" alt="Uploaded Image" style="max-width: 400px; height: auto;">
                    @elseif (str_contains(session('file')->type, 'video'))
                        <video class="mt-4 mx-auto" controls style="max-width: 400px; height: auto;">
                            <source src="{{ session('file')->url }}" type="{{ session('file')->type }}">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                @endif
            @endif
        </div>
    </form>

    <!-- Footer -->
    <div class="bg-gray-800 text-white text-center py-8 mt-8">
        <h2 class="text-2xl font-bold">ImgBB Pro account</h2>
        <p>ImgBB is a free image hosting service. Upgrade to unlock all the features.</p>
    </div>
</body>

</html>
