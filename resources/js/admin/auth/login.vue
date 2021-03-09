<template>
    <div>
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
    </div>
</template>