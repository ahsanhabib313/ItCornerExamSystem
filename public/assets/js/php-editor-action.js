$(document).ready(function () {
	var codeEditorElement = $(".codemirror-textarea")[0];
	var editor = CodeMirror.fromTextArea(codeEditorElement, {
		mode: "application/x-httpd-php",
		lineNumbers: true,
		matchBrackets: true,
		theme: "ambiance",
		lineWiseCopyCut: true,
		undoDepth: 200,
		lineWrapping: true,
		fixedGutter: true

	});

	editor.setValue('<?php\n echo "Hello World"\n?>');

	$('#run').click(function (e) {
		e.preventDefault();
		$("#error").html("").hide();
		var editorCode = editor.getValue();

		if (editorCode != '') {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url: fileWriteUrl,
				type: 'POST',
				dataType: 'json',
				data: { "input": editorCode },
				success: function (response) {
				},
				complete: function () {
					$.ajax({
						url: codeEditableUrl,
						type: 'GET',
						success: function (response) {
							$("#result").html(response);
						},
						error: function (response) {
							console.log("error: " + response);
						}
					});
				}
			});

		} else {
			$("#error").html("Code should not be empty").show();
		}

	});

	$('#clear').click(function (e) {
		e.preventDefault();
		$("#error").html("").hide();
		$("#result").html("");
		editor.setValue('<?php\n\n\n\n\n\n\n?>');
	});

});
