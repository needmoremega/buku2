document.getElementById('formTambahBuku').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    // Kirim data menggunakan fetch API
    fetch('tambah_buku.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data) {
            // Tambah buku baru ke tabel tanpa refresh
            const tableBody = document.getElementById('bukuTableBody');
            const newRow = document.createElement('tr');
            newRow.classList.add('hover:bg-gray-50', 'transition', 'duration-300', 'ease-in-out');

            newRow.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap">
                    <img src="${data.gambarBuku}" alt="Cover Buku" class="w-16 h-24 object-cover rounded-lg shadow-sm">
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${data.judul}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${data.author}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${data.category}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${data.deskripsi.split(' ').slice(0, 15).join(' ')}...</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <a href="${data.pdf}" target="_blank" class="text-indigo-600 hover:text-indigo-800 font-semibold underline">Lihat PDF</a>
                </td>
            `;
            tableBody.appendChild(newRow);

            // Reset form setelah menambahkan
            document.getElementById('formTambahBuku').reset();

            // Tampilkan notifikasi
            showNotification('Buku berhasil ditambahkan!');
        }
    })
    .catch(error => console.error('Error:', error));
});
