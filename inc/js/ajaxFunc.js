
/*
$(document).ready(function(){
	$("form").submit(function(){
	/*	var username = $('#class_taskstream').val();
		var mail = $('#section_taskstream').val();

		var dataa = 'username' + username + ' mail' + mail;
		console.log(dataa);
	 
		$.ajax({
			type: "POST",
			url: "saveToDB.php",
			data: ({name: 124}),
			success: function(data){
				console.log(data);
				alert("submited");
			}
		});
	});
});
*/


$(document).ready(function(){
    $("#taskStream").on("click",function(){
        //alert("Submitted");
		//var username = $('#class_taskstream').val();
		var mail = $('#section_taskstream').val();
		//var dataa = 'username' + username + ' mail' + mail;
		//console.log(mail);
		//this.write(5 + 6);
		
		$.ajax({
			type: "POST",
			url: "saveToDB.php",
			//data: ({name: 124}),
			success: function(response){
				$('#output').html(response.responseText);
				console.log(mail);
				alert("Submitted1");
			}
		});
    });
});
