$(document).ready(function(){
    $('#load_excel_form').on('submit', function(event){
        event.preventDefault();
        var ln = document.getElementById("filename").value;

            $.ajax({
                url:"router.php",
                type:"POST",
                data:new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                success:function(response)
                {

                    $('#excel_area').html(response);
                }
            })

    });
    $('#create_file').on('submit', function(event){

        event.preventDefault();
        $.ajax({
            url:"router.php",
            type:"POST",
            data:new FormData(this),
            contentType:false,
            cache:false,
            processData:false,
            success:function(response)
            {
                document.getElementById("file_name").value=""
                document.getElementById("content").value=""
                $('#download_area').html(response);
            }
        })

    });

    $('#fileList').on('click', function(event){

        $.ajax({
            url:"router.php?fileList=fileList",
            type:"GET",
            contentType:false,
            cache:false,
            processData:false,
            success:function(response)
            {
                $('#displayList').html(response);
            }
        })

    });


    $('.buttons').click(function(event) {
        var target = event.target.attributes[2].value;
        $('.divs').not(target).slideUp();
        $(target).slideDown();
    });
});


