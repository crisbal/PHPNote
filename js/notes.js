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

$(".glyphicon-pencil").click(
	function(){
		var note = $(this).parent().parent().parent().parent();
		var noteTitle = $(note).children('.noteTitle');
		var noteText = $(note).children('.noteText');
		var noteDateTime = $(note).children('.noteDateTime');


		var titleInput = $("<input/>", {
			"class": "form-control editNoteTitle",
			"type": "text",
			"value" : noteTitle.text().trim(),
			"id": "title",
			"name" : "title",
			"css": {
				"width": noteTitle.css('width')
			}
		});

		var textInput = $("<textarea/>", {
			"class": "form-control editNoteText",
			"text" : noteText.text().trim(),
			"cols" : "30",
			"rows" : "10",
			"id": "text",
			"name" : "text",
			"required" : true,
			"css": {
				"width": noteTitle.css('width')
			}
		});

		noteTitle.replaceWith(titleInput); /* replace p with ta */
		noteText.replaceWith(textInput);
		note.append('<button class="btn btn-lg btn-primary btn-block saveTheNote" type="submit">Save the note</button>');
		$(".saveTheNote").on("click",edit);
	}
);

function edit(){
		var note = $(this).parent();
		var noteTitle = $(note).children('.editNoteTitle').val().trim();
		var noteText = $(note).children('.editNoteText').val().trim();
		if(noteTitle.length == 0 && noteText.length == 0)
		{
			alert("Please fill at least one field, or if you want to delete press the delete icon!");
			return;
		}

		var noteDateTime = $(note).children('.noteDateTime').text().trim();

		$('<form action="php/edit.php" method="post"><input type="hidden" name="title" value="' + noteTitle + '" /><input type="hidden" name="text" value="' + noteText + '" /><input type="hidden" name="dateTime" value="' + noteDateTime + '" /></form>').appendTo('body').submit();
		
		}
