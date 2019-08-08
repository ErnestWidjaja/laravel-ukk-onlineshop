$(document).ready(function(){

    $(document).on('click','#btn-detail',function(){
    	var id = $(this).val();
    	var nama = "";
    	var deskripsi = "";
    	var harga = "";
    	var stock = "";
    	$.ajax({
    		type : 'get',
    		url : '/home/detail/' + id,
    		data : {'id':id},
    		success:function(data){
                if (data[1] == null) {
                    var jumlah2 = 0;
                }else {
                    var jumlah2 = data[1].jumlah;
                }
                
    			console.log(data);
    			var stok_barang = +data[0].stok_barang - +jumlah2;
                var stok_barang2 = +data[0].stok_barang;
				nama += '<b>' + data[0].nama_barang + '</b>';
				deskripsi += data[0].deskripsi;
				stock += '<h4>Stock : ' + stok_barang + '</h4>';
				if (data[1] == null) {
					$('#jumlah').val(1);
					harga += '<h4>Rp ' + data[0].harga_barang + '</h4>';
					
				}else {
					$('#jumlah').val(data[1].jumlah);
					harga += '<h4>' + data[1].subtotal + '</h4>';
				}

				$(document).on('change','#jumlah',function(){
					var jumlah = $(this).val();
					var total = jumlah * data[0].harga_barang;
					var sisa = stok_barang2 - jumlah;
					$('#harga').html('<h4>Rp ' + total + '</h4>');
					$('#stock').html('<h4>Stock : ' + sisa + '</h4>');
				});
                
    			$('#nama').empty();
    			$('#harga').empty();
    			$('#stock').empty();
    			$('#deskripsi').empty();
    			$('#id_barang').empty();

    			$('#id_barang').append(data[0].id);
    			$('#nama').append(nama);
    			$('#stock').append(stock);
    			$('#deskripsi').append(deskripsi);
    			$('#harga').append(harga);
    			$('#myModal').modal('show');

    		},
    		error:function(data){

    		}
    	});
    });

    $("#btn-save").click(function (e) {
    	$.ajaxSetup({
    		headers: {
    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		}   
    	})

    	e.preventDefault(); 
    	var formData = {
    		id_barang: $('#id_barang').text(),
    		jumlah: $('#jumlah').val(),
    		subtotal: $('#harga').text(),
    	}
    	console.log(formData),
    	$.ajax({
    		type: 'POST',
    		url: '/home/detail/stores',
    		data: formData,
    		dataType: 'json',
    		success: function (data) {
                // location.reload();
                console.log(data);
            },
            error: function (data) {
            	console.log('Error:', data);
                // location.reload();
            }
        });
    });

    $(document).ready(function(){
            var text = $('#searchbar').val();

            $.ajax({
                type:"GET",
                url: '/home/autocomplete',
                data: {},
                success: function(data) {

                    console.log(data);

                 }
            });
    });

});