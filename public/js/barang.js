
$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();
    console.log(url);

    //display modal form for creating new product *********************
    $('#btn-add').click(function(){
        $('#btn-save').val("add");
        $('#frmProducts').trigger("reset");
        $('#myModal').modal('show');
    });



    //display modal form for product EDIT ***************************
    $(document).on('click','#btn-edit',function(){
        var id = $(this).val();
        console.log(id);
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + '/' + id + '/' + 'edit',
            success: function (data) {
                console.log(data);
                $('#name').val(data.nama_barang);
                $('#category').val(data.kategori_barang);
                $('#price').val(data.harga_barang);
                $('#stock').val(data.stok_barang);
                $('#description').val(data.deskripsi);
                $('#id').val(data.id);
                $('#btn-save').val("update");
                $('#myModal').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });



    //create new product / update existing product ***************************
    $("#btn-save").click(function (e) {
        var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }   
        })

        e.preventDefault(); 
        var formData = {
            name: $('#name').val(),
            category: $('#category').val(),
            price: $('#price').val(),
            stock: $('#stock').val(),
            description: $('#description').val(),
            foto: filename
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var id = $('#id').val();
        var state = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var my_url = url + '/stores';
        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url = url + '/' + id + '/' + 'update';
        }
        console.log(formData),
        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                location.reload();
                console.log(data);
            },
            error: function (data) {
                console.log('Error:', data);
                location.reload();
            }
        });
    });
    
});