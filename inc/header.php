<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
  <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
  <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <style type="text/css">

    .nav-link{
      padding: 8px;
      color: #fff;
      font-weight: 400;
    }
    .navbar-dark .navbar-nav .nav-link.active, 
    .navbar-dark .navbar-nav .show>.nav-link {
      color: #333;
      background-color: #F0F0F0;
      border-radius: 8px;
    }
    .navbar-dark .navbar-nav .nav-link {
      color: rgba(255,255,255, 1);
    }

    /*list view Css Starts*/
    ody {
        margin: 0;
        font-family: Roboto, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        font-size: .8125rem;
        font-weight: 400;
        line-height: 1.5385;
        color: #333;
        text-align: left;
        background-color: #f5f5f5
    }

    .mt-50 {
        margin-top: 50px
    }

    .mb-50 {
        margin-bottom: 50px
    }

    .bg-teal-400 {
        background-color: #26a69a
    }

    a {
        text-decoration: none !important
    }

    .fa {
        color: red
    }


  </style>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body oncontextmenu='return false' class='snippet-body'>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Market - Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    