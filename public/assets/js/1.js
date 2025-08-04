$(document).ready(function () {
    // -------------------------------
    // Preview Gambar saat File Dipilih
    // -------------------------------
    function previewImage(input, previewId) {
        const file = input.files[0];
        const preview = $(previewId)[0];
        const reader = new FileReader();

        // Reset preview sebelumnya
        preview.src = '';
        $(preview).hide();

        if (file) {
            if (file.type.match('image.*')) {
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    $(preview).show();
                };
                reader.readAsDataURL(file);
            } else {
                alert('File harus berupa gambar (JPG/PNG).');
                input.value = ''; // Reset input
            }
        }
    }

    // Preview untuk Lambang
    $('#om_lambang').on('change', function () {
        previewImage(this, '#preview_lambang');
    });

    // Preview untuk Bendera
    $('#om_bendera').on('change', function () {
        previewImage(this, '#preview_bendera');
    });

    // Preview untuk Stempel
    $('#om_stempel').on('change', function () {
        previewImage(this, '#preview_stempel');
    });

    // Tambahkan elemen preview secara dinamis di sebelah input file
    $('input[type="file"]').each(function () {
        const id = $(this).attr('id');
        const previewId = `#preview_${id.split('_')[1]}`;

        // Jangan tambahkan dua kali
        if ($(previewId).length === 0) {
            $(`<img src="" class="img-thumbnail mt-2" alt="Preview" style="max-width: 200px; display: none;" id="preview_${id.split('_')[1]}">`).insertAfter($(this).closest('.custom-file'));
        }
    });

    // -------------------------------
    // Submit Form dengan AJAX
    // -------------------------------
    $('#form-user').on('submit', function (e) {
        e.preventDefault(); // Cegah submit default

        const formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'), // Pastikan form memiliki atribut action
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Pastikan ada <meta name="csrf-token" content="{{ csrf_token() }}">
            },
            beforeSend: function () {
                // Tampilkan loading atau disable tombol
                $('button[type="submit"]').prop('disabled', true).text('Menyimpan...');
            },
            success: function (response) {
                // Ganti dengan logika sesuai kebutuhan
                if (response.success) {
                    alert('Data berhasil disimpan!');
                    // Redirect atau reload
                    // window.location.href = '/list-ormas';
                } else {
                    alert('Gagal menyimpan: ' + response.message);
                }
            },
            error: function (xhr) {
                let err = 'Terjadi kesalahan.';
                if (xhr.status === 422) {
                    // Validasi gagal
                    const errors = xhr.responseJSON.errors;
                    err = Object.values(errors).flat().join('\n');
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    err = xhr.responseJSON.message;
                }
                alert('Error:\n' + err);
            },
            complete: function () {
                $('button[type="submit"]').prop('disabled', false).text('Simpan');
            }
        });
    });

    // -------------------------------
    // Update label file input
    // -------------------------------
    $('.custom-file-input').on('change', function () {
        const fileName = $(this).prop('files')[0]?.name || 'Pilih file';
        $(this).next('.custom-file-label').text(fileName);
    });
});