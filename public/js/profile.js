
$(document).ready(function(){
    var url = $('#url').val();
    var id = $('#id').val();

    $(document).on('click','#btn-edit',function(){
        $.ajax({
            type: "GET",
            url: url + '/' + id + '/' + 'edit',
            success: function (data) {
                $('#name').val(data.name);
                $('#gender').val(data.jk);
                $('#email').val(data.email);
                $('#phone').val(data.no_tlp);
                $('#address').val(data.alamat);
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
            jk: $('#gender').val(),
            email: $('#email').val(),
            no_tlp: $('#phone').val(),
            alamat: $('#address').val(),
            photo: filename
        }
        console.log(formData),
        $.ajax({
            type: "PUT",
            url: url + '/' + id + '/' + 'update',
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                    location.reload();
            },
            error: function (data) {
                console.log('Error:', data);
                location.reload();
            }
        });
    });
    
});