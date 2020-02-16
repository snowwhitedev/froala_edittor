
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="../../favicon.ico">
    <title>Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="{{url('/')}}/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <link href="{{url('/')}}/css/dashboard/treepanel.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{url('/')}}/bootstrap/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{url('/')}}/bootstrap/dashboard.css" rel="stylesheet">
    <!--Styles for JS tree--->
    <link href="{{url('/')}}/jstree/dist/themes/default/style.min.css" rel="stylesheet">
    <script src="{{url('/')}}/bootstrap/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--styles for WYSIWYG-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{url('/')}}/froala_editor/css/froala_editor.css">
    <link rel="stylesheet" href="{{url('/')}}/froala_editor/css/froala_style.css">
    <link rel="stylesheet" href="{{url('/')}}/froala_editor/css/plugins/code_view.css">
    <link rel="stylesheet" href="{{url('/')}}/froala_editor/css/plugins/colors.css">
    <link rel="stylesheet" href="{{url('/')}}/froala_editor/css/plugins/emoticons.css">
    <link rel="stylesheet" href="{{url('/')}}/froala_editor/css/plugins/image_manager.css">
    <link rel="stylesheet" href="{{url('/')}}/froala_editor/css/plugins/image.css">
    <link rel="stylesheet" href="{{url('/')}}/froala_editor/css/plugins/line_breaker.css">
    <link rel="stylesheet" href="{{url('/')}}/froala_editor/css/plugins/table.css">
    <link rel="stylesheet" href="{{url('/')}}/froala_editor/css/plugins/char_counter.css">
    <link rel="stylesheet" href="{{url('/')}}/froala_editor/css/plugins/video.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">

    <script>window.$q=[];window.$=window.jQuery=function(a){window.$q.push(a);};</script>
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">DashBoard</a>
        <button type="button" class="btn btn-success btn-sm" id="new_doc" style="margin-top:10px;" >
            <i class="glyphicon glyphicon-asterisk"></i>New Doc
        </button>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li style="top:10px;"> 
            <button type="button" class="btn btn-success btn-sm" id="save_btn" >
              <i class="glyphicon glyphicon-asterisk"></i>Save
            </button>
          </li>
          <li>
            <a href="{{url('user/logout')}}">Log Out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container-fluid">
      <div class="row">
          <div class="col-md-2 treepanel">
            <div calss="wrap">
              <input id = "treeID" type = "hidden">
              <div class="clearfix"></div>
              <div id = "jstree_demo" class="" style="z-index:100"></div>
            </div>
          
        </div>
        <div class="col-md-2 "></div>
        <div class="col-md-10  main">
              

            
              <div id="editor">
                <form id='edit' method="POST" enctype="multipart/form-data"></form>
              </div>
            
        </div>
      </div>
  </div>
	
   <!---JS TREE-->
  <script src="//static.jstree.com/3.3.7/assets/jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
	<script src="//static.jstree.com/3.3.7/assets/vakata.js"></script>
	<script src="{{url('/')}}/jstree/dist/jstree.js"></script>
	<script>$.each($q,function(i,f){$(f)});$q=null;</script>
  <script src="{{url('/')}}/jstree/mytree.js"></script>

  <!---FOR WYSIWYG-->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/froala_editor/js/froala_editor.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/froala_editor/js/plugins/align.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/froala_editor/js/plugins/code_beautifier.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/froala_editor/js/plugins/code_view.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/froala_editor/js/plugins/colors.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/froala_editor/js/plugins/draggable.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/froala_editor/js/plugins/emoticons.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/froala_editor/js/plugins/font_size.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/froala_editor/js/plugins/font_family.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/froala_editor/js/plugins/image.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/froala_editor/js/plugins/image_manager.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/froala_editor/js/plugins/line_breaker.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/froala_editor/js/plugins/link.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/froala_editor/js/plugins/lists.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/froala_editor/js/plugins/paragraph_format.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/froala_editor/js/plugins/paragraph_style.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/froala_editor/js/plugins/table.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/froala_editor/js/plugins/url.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/froala_editor/js/plugins/entities.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/froala_editor/js/plugins/char_counter.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/froala_editor/js/plugins/inline_style.min.js"></script>
  <script type="text/javascript" src="{{url('/')}}/froala_editor/js/plugins/save.min.js"></script>

  <script src="{{url('/')}}/froala_editor/myeditor.js"></script>
</body>
</html>
