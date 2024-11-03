<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>ImgBB</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white shadow-lg rounded-lg p-6 w-96">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Đường dẫn tải dữ liệu</h2>
            <button class="text-gray-500 hover:text-gray-700" onclick="closeModal()">×</button>
        </div>
        
        <!-- Hiển thị QR Code -->
        <div class="flex justify-center mb-4">
            <img alt="QR code for downloading data" class="w-24 h-24" src="https://storage.googleapis.com/a1aa/image/4VgdbtHDASYGC5pp6JrCdwwS2QOwGn8ENyA5wy2XjxZega2JA.jpg" />
        </div>
        
        <!-- Nhập đường dẫn tải về ảnh -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Đường dẫn ảnh</label>
            <div class="flex">
                <input class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                       id="imagePath" placeholder="Dán đường dẫn tại đây" type="text" oninput="updateDownloadLink()" />
                <button class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="copyToClipboard('imagePath')">
                    Sao chép
                </button>
            </div>
        </div>

        <!-- Các nút chức năng -->
        <div class="flex justify-between items-center mt-4">
            <a id="downloadBtn" href="#" download class="bg-gray-300 text-white font-bold py-2 px-4 rounded cursor-not-allowed" aria-disabled="true">
                Tải ảnh về
            </a>
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" onclick="closeModal()">Xong</button>
        </div>
    </div>

    <script>
        function copyToClipboard(elementId) {
            const copyText = document.getElementById(elementId);
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices
            navigator.clipboard.writeText(copyText.value);
            alert("Đã sao chép: " + copyText.value);
        }

        function closeModal() {
            alert("Modal đã đóng");
        }

        function updateDownloadLink() {
    const imagePath = document.getElementById('imagePath').value;
    const downloadBtn = document.getElementById('downloadBtn');
    
    if (imagePath) {
        const filename = imagePath.split('/').pop(); // Lấy tên file từ đường dẫn
        downloadBtn.href = "/image/download/" + filename; // Cập nhật link tải về với đúng route Laravel
        downloadBtn.classList.remove('bg-gray-300', 'cursor-not-allowed');
        downloadBtn.classList.add('bg-blue-500', 'hover:bg-blue-700');
        downloadBtn.setAttribute('aria-disabled', 'false');
    } else {
        downloadBtn.href = '#';
        downloadBtn.classList.remove('bg-blue-500', 'hover:bg-blue-700');
        downloadBtn.classList.add('bg-gray-300', 'cursor-not-allowed');
        downloadBtn.setAttribute('aria-disabled', 'true');
    }
}

    </script>
</body>
</html>
