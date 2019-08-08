    $(document).on('click','#btn-detail',function(){
        var id = $(this).val();
        var table = '';
        var total = '';
        console.log(id);
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: '/admin/laporan/detail/' + id,
            success: function (data) {
                console.log(data);
                for(var i = 0; i<data.length; i++){
                	table+=' <tr><td>' + data[i].nama_barang + '</td><td>' + data[i].jumlah + '</td><td>' + data[i].subtotal + '</td></tr>';
                }
                total+=' <tr><td>Ongkir</td><td></td><td>Rp 10000</td></tr><tr><td><b>Total</b></td><td></td><td>Rp '+ data[0].total +'</td></tr>';
                $('#isi').empty();
                $('#total').empty();
                $('#total').append(total);
                $('#isi').append(table);
                $('#myModal').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });