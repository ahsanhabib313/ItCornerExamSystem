<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CodeEditorController extends Controller
{
    public function codeWrite(Request $request){
        $path = public_path('codeEditorFile');
        $fp = fopen($path."/codeEditable.php", "w") or die("Unable to open file!");
        $editorCode = $_POST['input'];
        fwrite($fp, $editorCode);
        fclose($fp);
  }
}
