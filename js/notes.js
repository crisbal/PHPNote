$(".glyphicon-pencil").click(
	function(){
		var note = $(this).parent().parent().parent();
		var noteTitle = $(note).children('.noteTitle').text().trim();
		var noteText = $(note).children('.noteText').text();
		alert (noteTitle + "\n" + noteText);
		//alert ($(this).parent().parent().parent().children('.noteTitle').text());
	});
