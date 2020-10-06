window.onload=function(){

	const selectFile = document.getElementById('fileToUpload');
	selectFile.addEventListener("change",readfiles,false);

function readfiles(){
	const fileList = this.files ;
	console.log(fileList);
}

}
$('#submit').click(function() {
    $.ajax({
       
        type: 'POST',
        data: {
            email: 'email@example.com',
            message: 'hello world!'
        },
        success: function(msg) {
            alert('Email Sent');
        }               
    });
});
