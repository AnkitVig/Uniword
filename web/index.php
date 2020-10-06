<!DOCTYPE html>
<html>
   <head>
     <title>Load Documents in Browser using PHPSpreadsheet and PHPWord</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
   </head>
   <body>
     <div class="container">
      <br />
      <h3 align="center">Load Excel Sheet in Browser using PHPSpreadsheet</h3>
      <br />
      <div class="table-responsive">
          <!-- Excel Form Loading Data -->
      <span id="message"></span>
         <form method="post" id="load_excel_form" enctype="multipart/form-data">
           <table class="table">
             <tr>
               <td width="25%" align="right">Select Excel File</td>
               <td width="50%"><input type="file" id ="filename" name="filename" /></td>
               <td width="25%"><input type="submit" name="load" class="btn btn-primary" /></td>
             </tr>
           </table>
         </form>
      <br />
         <div id="excel_area"></div>
     </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 </body>
</html>

<!-- Script to upload the file  -->
<script>
$(document).ready(function(){
$('#load_excel_form').on('submit', function(event){
  event.preventDefault();
    var ln = document.getElementById("filename").value;

 /*
  * Check for document type
  */
if(ln.includes("docx")||ln.includes("doc")){
  $.ajax({
      url:"../src/uploadword.php",
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
}
   else if(ln.includes("xls")||ln.includes("xlsx")){
        $.ajax({
            url:"../src/upload.php",
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
    }

});
});
</script>




