$(document).ready(function() {
    $('#provinsi').on('change', function() {
        var p_id = $(this).val();
        $('#kota').empty().append('<option>Memuat...</option>').prop('disabled', true);

                $.ajax({
            url: './get_cities.php', 
            type: 'POST',
            data: { province_id: p_id },
            success: function(res) {
                var $kota = $('#kota');
                $kota.empty().append('<option value="" disabled selected>-- Pilih Kota --</option>');
                res.forEach(function(item) {
                    $kota.append(`<option value="${item.ID}">${item.name}</option>`);
                });
                $kota.prop('disabled', false);
            }
        });
    });
});

$(document).ready(function() {
    $('#provinsi').on('change', function() {
        var id_terpilih = $(this).val();
            $('#kota').empty()
                .append('<option>Sabar, lagi narik data...</option>')
                .prop('disabled', true);
            $.ajax({
            url: 'get_cities.php',
            type: 'POST',
            data: { province_id: id_terpilih },
            dataType: 'json',
            success: function(response) {
                var $select = $('#kota');
                $select.empty().append('<option value="" disabled selected>-- Pilih Kota --</option>');
                
                response.forEach(function(item) {
                    $select.append(`<option value="${item.ID}">${item.name}</option>`);
                });
                $select.prop('disabled', false);
            }
        })
    })
})
