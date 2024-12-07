$('#pemasukan-table').DataTable({
    responsive: true,
    order: [],
    dom: 'frltip',
    // "pageLength": 7,
    scrollX: true,
    scrollY: '450px', // Set the desired height here
});

function previewImage(input) {
    var previewContainer = document.getElementById('preview-container');
    var previewImage = document.getElementById('preview-image');

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            // Get the base64 data URL
            var base64Data = e.target.result;

            // Set the preview image src to the loaded file's base64 data
            previewImage.src = base64Data;

            // Show the preview container
            previewContainer.style.display = 'block';

            // Store the base64 image data globally
            window.base64ImageData = base64Data;
        };

        // Read the selected file as a data URL (base64)
        reader.readAsDataURL(input.files[0]);
    } else {
        // Reset preview if no file is selected
        previewImage.src = '#';
        previewContainer.style.display = 'none';
    }
}

// Function to open the image in a new tab
function viewImage() {
    if (window.base64ImageData) {
        // Create a new window and dynamically inject the image
        var newWindow = window.open('', '_blank');
        if (newWindow) {
            newWindow.document.write('<html><head><title>View Image</title></head><body>');
            newWindow.document.write('<img src="' + window.base64ImageData + '" style="width: 100%; height: auto;">');
            newWindow.document.write('</body></html>');
            newWindow.document.close();
        } else {
            alert('Unable to open new tab.');
        }
    } else {
        alert('No image to view!');
    }
}

function resetPreview() {
    var previewImage = document.getElementById('preview-image');
    var previewContainer = document.getElementById('preview-container');
    var loadPicDiv = document.getElementById('loadpic');
    document.getElementById('warning-message').innerText = '';

    // Reset the image source and hide the preview container
    previewImage.src = '#';
    previewContainer.style.display = 'none';

    // Show the loadpicedit div
    loadPicDiv.style.display = 'block';
}

$(document).ready(function () {
    // Get the `id` and `method` from the URL
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    const method = urlParams.get('method');
    var param = 'pemasukan';

    // onClick Cari, ketika klik tombol cari melakukan pencarian data berdasarkan ID_PENGELUARAN
    $('#cari').on('click', function () {
        // Get the current value of the datepicker
        const idKeluar = $("#ID_PENGELUARAN").val();
        var previewContainer = document.getElementById('preview-container');
        var previewImage = document.getElementById('preview-image');

        $.ajax({
            url: 'api/getCariPengeluaran.php',
            method: 'POST',
            data: JSON.stringify({ id: idKeluar }),
            contentType: 'application/json',
            dataType: 'json',
            success: function (response) {
                if (response.result.message === "OK" && response.data && response.data.length > 0) {
                    const data = response.data[0];
                    $("#NAMA").val(data.NAMA);
                    $("#OPERATING_UNIT").val(data.OPERATING_UNIT);
                    $("#DIVISI").val(data.DIVISI);
                    $("#selectize-select")[0].selectize.setValue(data.ID_KATEGORI);
                    setTimeout(function () {
                        $("#selectize-select2")[0].selectize.setValue(data.ID_BARANG);
                    }, 200);
                    $("#selectize-select4")[0].selectize.setValue(data.KONDISI);
                    $("#QTY").val(data.QTY);
                    $("#KETERANGAN_PERSEDIAAN").val(data.KETERANGAN_PERSEDIAAN);

                    // reset image preview
                    previewImage.src = '#';
                    previewContainer.style.display = 'none';

                    // Hide the "no data" message if data is found
                    $("#result").addClass("hidden");
                } else {
                    console.error('Error: Invalid response or no data available');
                }
            },
            error: function (error) {
                console.error('Error fetching data:', error);
                // Clear the form inputs
                $("#NAMA").val("");
                $("#OPERATING_UNIT").val("");
                $("#DIVISI").val("");
                $("#selectize-select")[0].selectize.clear();
                $("#selectize-select2")[0].selectize.clear();
                $("#selectize-select4")[0].selectize.clear();
                $("#QTY").val("");
                $("#KETERANGAN_PERSEDIAAN").val("");
                // Show the "no data" message
                $("#result").removeClass("hidden");
            }
        });
    });

    // onCHange datepicker52 Tanggal
    $('#datepicker52').on('change', function () {
        // Get the current value of the datepicker
        let tanggal = $("#datepicker52").val();
        let idBarang = $("#selectize-select2").val();

        $.ajax({
            url: 'api/getDetailBarang.php',
            method: 'POST',
            data: JSON.stringify({ id: idBarang, param: param, tanggal: tanggal }), // Use the correct key
            contentType: 'application/json',
            dataType: 'json',
            success: function (response) {
                if (response.result.message === "OK" && response.data && response.data.Barang.length > 0) {
                    response.data.Barang.forEach(function (item) {
                        $("#NO_BATCH").val(item.NO_BATCH);
                    });
                } else {
                    console.error('Error fetching barang data:', response.result.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error fetching barang data:', status, error);
            }
        });
    });
    
    if ($('#selectize-select').length > 0) {
        idKategori = $('#selectize-select').selectize();
        kategori = idKategori[0].selectize;
        
        kategori.on('change', function (kategori) {
            idBarang.clearOptions();
            let tanggal = $("#datepicker52").val();

            $.ajax({
                url: 'api/getDataBarang.php',
                method: 'POST',
                data: JSON.stringify({ id: kategori, tanggal: tanggal }), // Use the correct key
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

    if ($('#selectize-select2').length > 0) {
        barangSelectize = $('#selectize-select2').selectize();
        idBarang = barangSelectize[0].selectize;

        idBarang.on('change', function (idBarang) {
            // Get the current value of the datepicker
            let tanggal = $("#datepicker52").val();

            $.ajax({
                url: 'api/getDetailBarang.php',
                method: 'POST',
                data: JSON.stringify({ id: idBarang, param: param, tanggal: tanggal }), // Use the correct key
                contentType: 'application/json',
                dataType: 'json',
                success: function (response) {
                    if (response.result.message === "OK" && response.data && response.data.Barang.length > 0) {
                        response.data.Barang.forEach(function (item) {
                            $("#SATUAN").val(item.SATUAN);
                            $("#NO_BATCH").val(item.NO_BATCH);
                        });
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

    // Check if both `id` and `method` are available
    if (id && method === 'edit') {
        $.ajax({
            url: 'api/getDetailPemasukan.php',
            method: 'POST',
            data: JSON.stringify({ id: id }),
            contentType: 'application/json',
            dataType: 'json',
            success: function (response) {
                if (response.result.message === "OK" && response.data && response.data.length > 0) {
                    const data = response.data[0];
                    $("#ID_PEMASUKAN").val(data.ID_PEMASUKAN);
                    $("#ID_PENGELUARAN").val(data.ID_PENGELUARAN);
                    $("#TANGGAL_MASUK").val(data.TANGGAL_MASUK);
                    $("#NAMA").val(data.NAMA);
                    $("#OPERATING_UNIT").val(data.OPERATING_UNIT);
                    $("#DIVISI").val(data.DIVISI);
                    $("#KETERANGAN_PEMASUKAN").val(data.KETERANGAN_PEMASUKAN);
                    $("#selectize-select")[0].selectize.setValue(data.ID_KATEGORI);
                    setTimeout(function () {
                        $("#selectize-select2")[0].selectize.setValue(data.ID_BARANG);
                    }, 200);
                    $("#preview-image").attr("src", data.FOTO);
                    $("#openFoto").attr("href", data.FOTO);
                    $("#QTY").val(data.QTY);
                    $("#selectize-select3")[0].selectize.setValue(data.KONDISI);
                    $("#KETERANGAN_PERSEDIAAN").val(data.KETERANGAN_PERSEDIAAN);
                } else {
                    console.error('Error: Invalid response or no data available');
                }
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
        });
    } else if (id && method === 'view') {
        $.ajax({
            url: 'api/getDetailPemasukan.php',
            method: 'POST',
            data: JSON.stringify({ id: id }),
            contentType: 'application/json',
            dataType: 'json',
            success: function (response) {
                if (response.result.message === "OK" && response.data && response.data.length > 0) {
                    const data = response.data[0];
                    $("#ID_PEMASUKAN").val(data.ID_PEMASUKAN);
                    $("#ID_PENGELUARAN").val(data.ID_PENGELUARAN);
                    $("#TANGGAL_MASUK").val(data.TANGGAL_MASUK);
                    $("#NAMA").val(data.NAMA);
                    $("#OPERATING_UNIT").val(data.OPERATING_UNIT);
                    $("#DIVISI").val(data.DIVISI);
                    $("#KETERANGAN_PEMASUKAN").val(data.KETERANGAN_PEMASUKAN);
                    $("#ID_KATEGORI").val(data.NAMA_KATEGORI);
                    $("#ID_BARANG").val(data.NAMA_BARANG);
                    $("#preview-image").attr("src", data.FOTO);
                    $("#openFoto").attr("href", data.FOTO);
                    $("#QTY").val(data.QTY);
                    $("#KONDISI").val(data.KONDISI);
                    $("#KETERANGAN_PERSEDIAAN").val(data.KETERANGAN_PERSEDIAAN);
                } else {
                    console.error('Error: Invalid response or no data available');
                }
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
        });
    }
});



