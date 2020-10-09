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
});