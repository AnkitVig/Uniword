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
                success:function(data)
                {
                    $('#excel_area').html(data);
                    $('table').css('width','100%');
                }
            })

    });

    $('#download').on('click', function(event){

        var download = $(this).attr('name');

        $.ajax({
            url:"router.php",
            type:"GET",
            data: JSON.stringify({'idElement':download}),
            contentType:false,
            cache:false,
            processData:false,
            success:function(data)
            {

            }
        })

    });

    $('#add_student_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url:"router.php",
            type:"POST",
            data:new FormData(this),
            contentType:false,
            cache:false,
            processData:false,
            success:function(data)
            {
            }
        })

    });

    $('.buttons').click(function(event) {
        var target = event.target.attributes[2].value;
        $('.divs').not(target).slideUp();
        $(target).slideDown();
    });
});


