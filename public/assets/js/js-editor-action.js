$(document).ready(function () {
	var codeEditorElement = $(".codemirror-textarea")[0];
	var editor = CodeMirror.fromTextArea(codeEditorElement, {
		mode: "application/javascript",
		lineNumbers: true,
		matchBrackets: true,
		theme: "ambiance",
		lineWiseCopyCut: true,
		undoDepth: 200,
		lineWrapping: true,
		fixedGutter: true


	});

	editor.setValue('\n\n\n\nvar output = "your answer";\n/*Result assign should be output varibale.  */\n document.getElementById("result").innerHTML = output; ');

	$('#run').click(function (e) {
		e.preventDefault();
		var editorCode = editor.getValue();
		$('#result').html('<script>' + editorCode + '</script>')


	});

	$('#clear').click(function (e) {
		e.preventDefault();
		$("#error").html("").hide();
		$("#result").html("");
		editor.setValue('<?php\n\n\n\n\n\n\n?>');
	});

});
