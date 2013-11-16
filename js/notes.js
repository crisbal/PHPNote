$(".glyphicon-pencil").click(
	function(){
		var note = $(this).parent().parent().parent();
		var noteTitle = $(note).children('.noteTitle').text().trim();
		var noteText = $(note).children('.noteText').text();
		alert (noteTitle + "\n" + noteText);
		//alert ($(this).parent().parent().parent().children('.noteTitle').text());
	});



$(".glyphicon-trash").click(
	function(){
		var note = $(this).parent().parent().parent();
		var noteTitle = $(note).children('.noteTitle').text().trim();
		var noteText = $(note).children('.noteText').text().trim();
		var noteDateTime = $(note).children('.noteDateTime').text().trim();
		

		var postData = {title:noteTitle,text:noteText,dateTime:noteDateTime};

		var jqxhr = $.post( "php/delete.php",postData, function(data, textStatus, jqXHR) {
			switch($.trim(data))
			{
				case "success":
					note.hide('400');
					break;
				case "queryError":
					alert ("Unexpected Error!\nPlease try again in a few minutes.")
					break;
				case "noPost":
					location.reload();
					break;
				case "redirect":
					window.location.assign("login.php");
					break;
				default:
					alert("If you see this alert please alert the administrator.");
					break;
			}	
		})
		.fail(function() {
			alert( "I can't reach the server.\nPlease try again in a few minutes." );
		})
	});



