
$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();


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
                $('#category').val(data.kategori);
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }   
        })

        e.preventDefault(); 
        var formData = {
            category: $('#category').val(),
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