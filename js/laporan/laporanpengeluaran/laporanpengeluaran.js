$('#laporanpengeluaran-table').DataTable({
    responsive: true,
    order: [],
    dom: 'Bfrtlip',
    // "pageLength": 7,
    scrollX: true,
    scrollY: '420px', // Set the desired height here
    buttons: [
        'copy', 'csv', 'excel', 'pdf'
    ]
});

$(document).ready(function () {
    
    // OnChange Kategori Initialize selectize only if it exists
    var idKategori, kategori, barangSelectize, idBarang;
    // Get the `id` and `method` from the URL
    const urlParams = new URLSearchParams(window.location.search);
    const psd = urlParams.get('psd');

    if ($('#selectize-select').length > 0) {
        idKategori = $('#selectize-select').selectize();
        kategori = idKategori[0].selectize;

        barangSelectize = $('#selectize-select2').selectize();
        idBarang = barangSelectize[0].selectize;
        
        kategori.on('change', function (kategori) {
            idBarang.clearOptions();
            $.ajax({
                url: 'api/getDataBarang.php',
                method: 'POST',
                data: JSON.stringify({ id: kategori }), // Use the correct key
                contentType: 'application/json',
                dataType: 'json',
                success: function (response) {
                    if (response.result.message === "OK" && response.data && response.data.Barang.length > 0) {
                        response.data.Barang.forEach(function (item) {
                            // Convert &quot; into " for correct display in HTML
                            var namaBarang = item.NAMA_BARANG.replace(/&quot;/g, '"');
                            
                            // Add the item to the dropdown
                            idBarang.addOption({ value: item.ID_BARANG, text: namaBarang });
                        });
                        idBarang.setValue('');
                    } else {
                        console.error('Error fetching barang data:', response.result.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching barang data:', status, error);
                }
            });
        });
    }
});



