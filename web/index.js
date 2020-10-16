$(document).ready(function(){
    $('#load_excel_form').on('submit', function(event){
        console.log(document.getElementById("filename").value);
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
                document.getElementById("file_name").value="";
                document.getElementById("content").value="";
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
                var res = response.split(",");
                var sel = document.getElementById('fileSelectList');
                $("#fileSelectList").find('option')
                .remove()
                .end();


                for(var i = res.length-1; i >=0 ; i--) {
                        var opt = document.createElement('option');
                        opt.innerHTML = res[i];
                        opt.value = res[i];
                        sel.appendChild(opt);
                }

            }
        })

    });


    $("select").change(function () {
        var data = $(this).find(":selected").text();
        $.ajax({
            url : "router.php?file="+data ,
            type: "GET",
            success : function (response) {
                $('#displayFile').html(response);
            }
        })
    });


    $('.buttons').click(function(event) {
        var target = event.target.attributes[2].value;
        $('.divs').not(target).hide();
        $(target).show();
    });
});


