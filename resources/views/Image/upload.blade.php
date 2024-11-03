<html>
<head>
    <title>ImgBB</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-sm">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <div class="flex items-center space-x-4">
                <i class="fas fa-question-circle text-xl"></i>
                <span class="text-lg">Giới thiệu</span>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-language text-xl"></i>
                    <span class="text-lg">VI</span>
                    <i class="fas fa-caret-down text-xl"></i>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('Image.upload.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Upload</a>
            </div>
        </div>
    </header>

    <main class="container mx-auto mt-10 text-center">
        <div class="bg-white shadow-md rounded-lg p-10">
            @if(session('success'))
                <p class="text-green-500">{{ session('success') }}</p>
            @elseif(session('error'))
                <p class="text-red-500">{{ session('error') }}</p>
            @endif

            <form action="{{ route('Image.upload.store') }}" method="POST" enctype="multipart/form-data" class="mt-6">
                @csrf
                <div id="drop-zone" class="border-2 border-dashed border-blue-500 p-10 cursor-pointer" onclick="document.getElementById('file-input').click()">
                    <i class="fas fa-cloud-upload-alt text-6xl text-blue-500"></i>
                    <p class="mt-4 text-lg">Kéo thả hoặc chọn ảnh/tệp để upload</p>
                    <input type="file" name="files[]" id="file-input" class="hidden" accept="image/*,video/*,.pdf,.zip,.docx,.txt" multiple onchange="previewFiles(event)">
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Upload</button>
            </form>

            <p class="text-gray-500 mt-2">Bạn có thể tải lên từ máy tính hoặc thêm địa chỉ ảnh.</p>

            <!-- Khu vực hiển thị ảnh thu nhỏ và tên các tệp khác -->
            <div id="thumbnail-container" class="mt-8 hidden">
                <h3 class="text-lg font-semibold mb-4">Xem trước tệp:</h3>
                <div id="file-previews" class="grid grid-cols-2 gap-4"></div>
            </div>
        </div>

        <div class="mt-4 text-gray-500">
            Hỗ trợ DOC, PDF, ZIP, PHP, TEXT, JPG, PNG, BMP, GIF, TIF, WEBP, HEIC, AVIF, MP4... GIỚI HẠN: 10MB
        </div>
    </main>

    <footer class="bg-gray-800 text-white text-center py-10 mt-10">
        <h2 class="text-2xl">ImgBB Pro account</h2>
        <p class="mt-2">ImgBB is a free image hosting service. Upgrade to unlock all the features.</p>
    </footer>

    <!-- JavaScript để xử lý kéo thả và xem trước nhiều tệp -->
    <script>
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('file-input');
        const thumbnailContainer = document.getElementById('thumbnail-container');
        const filePreviews = document.getElementById('file-previews');

        // Kích hoạt kéo thả
        dropZone.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropZone.classList.add('bg-blue-100');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('bg-blue-100');
        });

        dropZone.addEventListener('drop', (event) => {
            event.preventDefault();
            dropZone.classList.remove('bg-blue-100');
            const files = event.dataTransfer.files;
            fileInput.files = files;
            previewFiles({ target: { files } });
        });

        // Xem trước nhiều tệp
        function previewFiles(event) {
            filePreviews.innerHTML = ''; // Xóa các xem trước cũ
            const files = event.target.files;
            if (files.length > 0) {
                thumbnailContainer.classList.remove('hidden');
                Array.from(files).forEach(file => {
                    const filePreview = document.createElement('div');
                    filePreview.classList.add('border', 'p-2', 'rounded', 'bg-gray-100', 'text-center');

                    if (file.type.startsWith('image/')) {
                        // Xử lý ảnh
                        const img = document.createElement('img');
                        img.classList.add('w-32', 'h-32', 'object-cover', 'mx-auto');
                        img.src = URL.createObjectURL(file);
                        filePreview.appendChild(img);
                    } else {
                        // Xử lý tệp khác (hiển thị tên tệp)
                        const fileIcon = document.createElement('i');
                        fileIcon.classList.add('fas', 'fa-file-alt', 'text-4xl', 'text-blue-500');
                        const fileName = document.createElement('p');
                        fileName.classList.add('mt-2', 'text-gray-700');
                        fileName.textContent = file.name;

                        filePreview.appendChild(fileIcon);
                        filePreview.appendChild(fileName);
                    }

                    filePreviews.appendChild(filePreview);
                });
            }
        }
    </script>
</body>
</html>
