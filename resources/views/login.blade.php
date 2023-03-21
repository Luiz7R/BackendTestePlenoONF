<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://bootswatch.com/4/cerulean/bootstrap.css">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>      
    <title>Onfly API</title>

    <style>
        body {
        background-image:url("{{ asset('img/photo-1451187580459-43490279c0fa.jpg') }}");
        background-position:center;
        background-size:cover;
        
        -webkit-font-smoothing: antialiased;
        font: normal 14px Roboto,arial,sans-serif;
        /** font-family: 'Dancing Script', cursive!important; */
        }

        .container {
            padding: 110px;          
        }
        ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: #ffffff!important;
            opacity: 1; /* Firefox */
            font-size:18px!important;
        } 

        .form-login {           
            background-color: rgba(0,0,0,0.55);            
            padding-top: 10px;
            padding-bottom: 20px;
            padding-left: 20px;
            padding-right: 20px;
            border-radius: 15px;
            border-color:#d2d2d2;
            border-width: 5px;
            color:white;
            box-shadow:0 1px 0 #cfcfcf;
        }

        .form-control{
            background:transparent!important;
            color:white!important;
            font-size: 18px!important;
        }
        h1{
            color:white!important;
        }
        h4 { 
        border:0 solid #fff; 
        border-bottom-width:1px;
        padding-bottom:10px;
        text-align: center;
        }

        .form-control {
            border-radius: 10px;
        }
        .text-white{
            color: white!important;
        }
        .wrapper {
            text-align: center;
        }
        .footer p{
            font-size: 18px;
        }
    </style>
</head>

<body>

<!-- Login Page Content -->
<div class="container">
    <div class="row">
        <div class="col-md-offset-5 col-md-5 text-center" style="margin-left: 30%;">
            <h1 class="text-white">Login</h1>    
            <form method="POST" action="{{  route('auth.user') }}" >
                @csrf
                <div class="form-login"><br/>
                    <h4>Login</h4>
                    <br/>
                        <input type="text" name="email" class="form-control input-sm chat-input" placeholder="Username" value="" />
                    <br/><br/>
                        <input type="password" name="password" class="form-control input-sm chat-input" value="" placeholder="Password" />
                    <br/><br/>   
                    <div class="wrapper">
                        <span class="group-btn">
                            <button type="submit" class="btn btn-md text-white">Login</button>    
                        </span>    
                    </div> 
                    <a href="/register">Register Here</a>                                      
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif                  
            </form>                       
        </div> 
    </div> 
</div>  
 

<!-- 
    Inspired on Unique Login Form
    Design by https://freecss.tech
-->

</body>
</html>
