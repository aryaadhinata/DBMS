$(document).ready(function () {
    $('#provinsi').on('change', function () {
        // Ambil ID provinsi yang dipilih pengguna.
        var id_terpilih = $(this).val();
        var $select = $('#kota');
        // Tampilkan pesan loading sementara data kota dimuat.
        $select.empty()
            .append('<option>Sabar, lagi narik data...</option>')
            .prop('disabled', true);

        $.ajax({
            url: 'get_cities.php',
            type: 'POST',
            data: {
                province_id: id_terpilih
            },
            dataType: 'json',

            success: function (response) {
                // Reset select kota dan tampilkan pilihan default.
                $select.empty().append('<option value="" disabled selected>-- Pilih Kota --</option>');

                // Tambahkan setiap kota ke dalam dropdown.
                response.forEach(function (item) {
                    $select.append('<option value="' + item.ID + '">' + item.name + '</option>');
                });

                // Aktifkan kembali dropdown kota.
                $select.prop('disabled', false);
            },
            error: function (xhr, status, error) {
                console.error('Gagal memuat kota:', status, error);
                $select.empty().append('<option value="" disabled selected>-- Gagal memuat kota --</option>');
            }
        });
    });
});