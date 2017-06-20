<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="{{ url('/') . '//js/index.js' }}" type="text/javascript"></script>
  <title>Chọn ảnh</title>
  <style>
    /*CSS cho phần tiêu đề */
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
      box-shadow: 5px 5px 5px #666;
      padding-left: 400px;
      display: inline;
      background-color: green;
    }
    /*CSS cho phần cột bên trái col-2 */
    .sidenav {
      padding-top: 0px;
      text-align: left;
      margin-top: 10px;
      overflow: hidden;
    }
    .col-2 {
      width: 250px;
    }
    #danganh{
      padding: 20px;
    }
    .banquyen {
      width: 200px;
      height: 200px;
      padding-top: 100px;
      padding-bottom: 100px;
      font-size: 12px;
      font-family: cursive;
      color: rgb(128,128,128)
    }

    /*CSS phần nội dung hiển thị ảnh */
    /* Nội dung chung */
    .row.content {
      padding-top: 200px;
    }

    /* CSS cho mỗi phần hiển thị ảnh của 1 người */
    .user {
      background-color: white;
      padding: 10px;
      margin: 20px;
    }
    /* CSS cho avatar */
    .tieude {
      font-weight: bold;
      padding-left: 20px;
    }

    /* Set black background color, white text and some padding */
    footer {
      background-color: #f1f1f1;
      color: white;
      padding: 15px;
    }

    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;}
    }

  </style>
</head>
<body>
<nav id="nav" class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li><a href="home" style="color: white">Trang chủ</a></li>
      <li><a href="/myapp/public/profile" style="color: white">
		<img src="{{ url('/') . '/images/' . Auth::user()->avatar_photo }}" class="img-circle" alt="Cinque Terre" width="25" height="25"/>
		{{ Auth::user()->name }}
	  </a></li>
    </ul>
    <form class="navbar-form navbar-left">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search">
        <div class="input-group-btn">
          <button class="btn btn-default" type="submit">
            <i class="glyphicon glyphicon-search"></i>
          </button>
        </div>
      </div>
    </form>
    <ul id="login" class="nav navbar-nav navbar-right">
      <li><a href="logout" style="color: white"><span class="glyphicon glyphicon-user" ></span> Đăng xuất </a></li>

    </ul>
  </div>
</nav>
<div class="container-fluid text-center">
  <div class="row content">
    <h1>Chọn ảnh mà bạn muốn tải lên</h1>
    <form method="POST" action="moveimage" enctype="multipart/form-data">
      {!! csrf_field() !!}
      <input type="file" name="image" style="padding-left: 600px;">
      <p>(File ảnh có kích thước nhỏ hơn 10MB)</p>
      <button name="chooseImage" class="btn btn-default">Chọn</button>
    </form>
    @if (count($errors) > 0)
      <div class = "alert alert-danger">
        <ul>
           @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
           @endforeach
        </ul>
      </div>
    @endif
	<p>
	</p>
  </div>
</div>

</body>
</html>
