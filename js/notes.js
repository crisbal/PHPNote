$(".glyphicon-bullhorn").click(
	function(){
		var note = $(this).parent().parent().parent().parent();
		var noteTitle = $(note).children('.noteTitle').text().trim();
		var noteText = $(note).children('.noteText').text().trim();
		var noteDateTime = $(note).children('.noteDateTime').text().trim();
		var postData = {title:noteTitle,text:noteText,dateTime:noteDateTime};

		var jqxhr = $.post( "public.php",postData, function(data, textStatus, jqXHR) {
			if($.trim(data).match("^id="))
			{
				window.location.assign("public.php?"+$.trim(data));
			}
			else
			{
				switch($.trim(data))
				{
					case "queryError": case "noConnection":
						alert ("Unexpected Error!\nPlease try again in a few minutes.");
						location.reload();
						break;
					case "redirect":
						window.location.assign("login.php");
						break;
					default:
						location.reload();
						break;
				}	
			}
		})
		.fail(function() {
			alert( "I can't reach the server.\nPlease try again in a few minutes." );
		})
	});


$(".glyphicon-trash").click(
	function(){
		var note = $(this).parent().parent().parent().parent();
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
				case "redirect":
					window.location.assign("login.php");
					break;
				default:
					location.reload();
					break;
			}	
		})
		.fail(function() {
			alert( "I can't reach the server.\nPlease try again in a few minutes." );
		})
	});



$(".glyphicon-floppy-disk").click(
	function(){
		var note = $(this).parent().parent().parent().parent();
		var noteTitle = $(note).children('.noteTitle').text().trim();
		var noteText = $(note).children('.noteText').text().trim();
		var noteDateTime = $(note).children('.noteDateTime').text().trim();
	
		$('<form action="php/generate.php" method="post"><input type="hidden" name="title" value="' + noteTitle + '" /><input type="hidden" name="text" value="' + noteText + '" /><input type="hidden" name="dateTime" value="' + noteDateTime + '" /></form>').appendTo('body').submit();
	});


