<!DOCTYPE html>
<html lang="en">

<head>
  <title>Online Exam System</title>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    {{-- start code editor style ans script --}}
    <link rel="stylesheet" type="text/css" href="{{asset('assets/lib/codemirror/lib/codemirror.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/lib/codemirror/theme/ambiance.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{asset('assets/lib/jQuery/jQuery.js')}}"></script>
    <script src="{{asset('assets/lib/codemirror/lib/codemirror.js')}}"></script>
    <script src="{{asset('assets/js/editor-action.js')}}"></script>
    <script src="{{asset('assets/lib/codemirror/mode/htmlmixed/htmlmixed.js')}}"></script>
    <script src="{{asset('assets/lib/codemirror/mode/xml/xml.js')}}"></script>
    <script src="{{asset('assets/lib/codemirror/mode/javascript/javascript.js')}}"></script>
    <script src="{{asset('assets/lib/codemirror/mode/css/css.js')}}"></script>
    <script src="{{asset('assets/lib/codemirror/mode/clike/clike.js')}}"></script>
    <script src='{{asset('assets/lib/codemirror/mode/php/php.js')}}'></script>
    <script src='{{asset('assets/lib/codemirror/addon/selection/active-line.js')}}'></script>
    <script src='{{asset('assets/lib/codemirror/addon/edit/matchbrackets.js')}}'></script>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/code_style.css')}}">
    {{-- end code editor style ans script --}}
  <link rel="stylesheet" href="{{asset('assets/css/exam.css')}}" type="text/css">

</head>

<body>


  <div id="main_content">

      @yield('content')
  </div>


      {{--alert box--}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <script>
      var fileWriteUrl = '<?php echo url('file/write') ?>';
      var codeEditableUrl = '<?php echo url('../../codeEditorFile/codeEditable.php') ?>';
      var getNextQuestionUrl = '<?php echo url('get/next/question')?>'
      var getExamineeResultUrl = "<?php echo url('get/examinee/result') ?>"
      var userSuspendUrl= "<?php echo url('user/suspended/') ?>"
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="{{asset('assets/js/examPage.js')}}"></script>

</body>

</html>
