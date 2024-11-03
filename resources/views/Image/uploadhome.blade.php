<!DOCTYPE html>
<html lang="vi">
<head>
    <title>ImgBB - Upload Multiple Files</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-white text-gray-800">

    <!-- Header -->
    <header class="flex justify-between items-center p-4 border-b border-gray-200">
        <div class="flex items-center space-x-4">
            <a href="#" class="text-gray-600 hover:text-gray-800">Giới thiệu</a>
            <a href="#" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-upload"></i>
                <span class="ml-2">Upload</span>
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex flex-col items-center justify-center min-h-screen py-12">
        <h1 class="text-4xl font-bold mb-4">Đăng và chia sẻ dữ liệu trực tuyến</h1>
        <p class="text-center text-gray-600 mb-8">
            Kéo thả dữ liệu hoặc hình ảnh của bạn vào bất kỳ đâu để bắt đầu tải lên ngay.<br>
            Giới hạn 10 MB mỗi file. Liên kết trực tiếp đến dữ liệu, mã BBCode và hình thu nhỏ HTML.
        </p>
        
        <div id="dropzone" class="border-dashed border-4 border-blue-600 rounded-lg p-8 w-1/2 text-center">
            <p class="text-gray-600 mb-4">Kéo và thả ảnh tại đây hoặc nhấn để chọn file</p>
            <input id="fileInput" type="file" class="hidden" multiple onchange="previewFiles(event)" accept="image/*"/>
            <button class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700" onclick="document.getElementById('fileInput').click()">Chọn file</button>
        </div>

        <!-- Khu vực xem trước ảnh -->
        <div id="previewContainer" class="flex flex-wrap gap-4 justify-center mt-6">
            <!-- Ảnh xem trước sẽ được hiển thị tại đây -->
        </div>

        <!-- Hiển thị kết quả sau khi tải lên -->
        <div id="uploadResult" class="mt-6"></div>
    </main>

    <footer class="bg-gray-100 py-8 text-center">
        <div class="text-gray-600">
            Sử dụng 10MB.cc là bạn đã đồng ý với <a href="#" class="text-blue-600 hover:underline">Quy định sử dụng</a> và <a href="#" class="text-blue-600 hover:underline">Chính sách bảo mật</a>.
        </div>
    </footer>

    <script>
        const dropzone = document.getElementById('dropzone');
        const previewContainer = document.getElementById('previewContainer');
        const uploadResult = document.getElementById('uploadResult');

        // Sự kiện kéo thả vào khu vực dropzone
        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('bg-blue-50');
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('bg-blue-50');
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('bg-blue-50');
            previewFiles(e);
        });

        // Hiển thị ảnh xem trước khi chọn hoặc kéo thả
        function previewFiles(event) {
            const files = event.target.files || event.dataTransfer.files;
            previewContainer.innerHTML = ''; // Xóa nội dung cũ

            Array.from(files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = "w-32 h-32 object-cover rounded shadow";
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Upload toàn bộ file
            handleUpload(files);
        }

        // Hàm xử lý tải lên nhiều file
async function handleUpload(files) {
    const formData = new FormData();

    // Thêm các file vào formData
    Array.from(files).forEach(file => {
        if (file.size <= 10 * 1024 * 1024) { // Giới hạn 10MB mỗi file
            formData.append('files[]', file);
        } else {
            alert(`${file.name} vượt quá 10 MB và sẽ không được tải lên.`);
        }
    });

    try {
        const response = await fetch("{{ route('Image.upload.dragdrop') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        });
        const result = await response.json();
        if (result.success) {
            uploadResult.innerHTML = result.paths.map(path => 
                `<p class="text-green-600">Đã tải lên: <a href="${path}" target="_blank" class="text-blue-600 underline">${path}</a></p>`
            ).join('');
        }
    } catch (error) {
        console.error('Upload error:', error);
        uploadResult.innerHTML = `<p class="text-red-600">Đã có lỗi xảy ra khi tải lên.</p>`;
    }
}

// Cập nhật sự kiện dropzone
dropzone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropzone.classList.remove('bg-blue-50');
    const files = e.dataTransfer.files; // Lấy tất cả file
    handleUpload(files); // Gọi hàm để xử lý upload
});

// Cập nhật sự kiện chọn file
fileInput.addEventListener('change', (e) => {
    const files = e.target.files; // Lấy tất cả file
    handleUpload(files); // Gọi hàm để xử lý upload
});

    </script>
</body>
</html>
