<!DOCTYPE html>
<html>

<head>
      <title>HTML Login Form</title>
      <link rel="stylesheet" href="style.css">
      <link href="assets/css/customize.css" rel="stylesheet">
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .main {
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 300px;
    }

    h1 {
        color: #4CAF50;
        font-size: 24px;
        margin-bottom: 10px;
    }

    h3 {
        font-size: 16px;
        margin-bottom: 20px;
        color: #555;
    }

    label {
        display: block;
        text-align: left;
        margin: 10px 0 5px;
        font-size: 14px;
        color: #333;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px;
        width: 100%;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #45a049;
    }

    p {
        margin-top: 20px;
        font-size: 14px;
    }

    a {
        color: #4CAF50;
    }
    
    .wrap {
        text-align: center;
    }

</style>
<body>
      <div class="main">
            <h1>GeeksforGeeks</h1>
            <h3>Enter your login credentials</h3>
            @if ($errors->any())
                 <div class="alert alert-danger">
                     <ul>
                           @foreach ($errors->all() as $error)
                                 <li>{{ $error }}</li>
                           @endforeach
                     </ul>
                 </div>
            @endif
            <form method="POST" action="{{ route('auth.login') }}">
                @csrf
                <label for="email">
                        Email:
                  </label>
                  <input type="text" 
                         id="email" 
                         name="email" 
                         placeholder="Enter your Email"  
                  >
                  @if ($errors->has('email'))
                        <span class="error-message">
                           * {{$errors->first('email')}}
                        </span>
                  @endif
                  <label for="password">
                        Password:
                  </label>
                  <input type="password"
                         id="password" 
                         name="password"
                         placeholder="Enter your Password"  
                  >
                  @if ($errors->has('password'))
                  <span class="error-message">
                     * {{$errors->first('password')}}
                  </span>
                  @endif

                  <div class="wrap">
                        <button type="submit">
                              Đăng nhập
                        </button>
                  </div>
            </form>
            <p>Not registered?
                  <a href="#"
                     style="text-decoration: none;">
                        Create an account
                  </a>
            </p>
      </div>
</body>

</html>
