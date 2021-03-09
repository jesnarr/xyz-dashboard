<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Barangay San Ignacio</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />

        <link href="/css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Masthead-->
        <header class="login">
            <div class="test"></div>
            <div class="rightSide m-5 p-5">
                <h5 class="m-5">Barangay San Ignacio</h5>
                <h1 class="m-5">SIGN IN</h1>
                <form class="m-5" action="/login" method="post">
                    @csrf
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Email address</label>
                      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>
            
                      <a href="#" class="mb-5"><label class="form-check-label" for="exampleCheck1">Don't have an account?</label></a>
                    
                    <button type="submit" class="btn btn-success form-control mt-5 mb-2">Submit</button>
                    <a href="#" ><label class="form-check-label" for="exampleCheck1">Forgot password?</label></a>
                  </form>
            </div>
        </header>
        <!-- About-->
        <script src="js/scripts.js"></script>
    </body>
</html>
