<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SignUp</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <style>
    html,
    body {
      height: 100%;
    }

    body {
      display: flex;
      align-items: center;
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: black;
    }


    input[type=text],
    select {
      width: 25%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 100px;
      box-sizing: border-box;
    }

    input[type=email],
    select {
      width: 25%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 100px;
      box-sizing: border-box;
    }

    input[type=number],
    select {
      width: 25%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 100px;
      box-sizing: border-box;
    }

    input[type=password],
    select {
      width: 25%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 100px;
      box-sizing: border-box;
    }

  
  </style>
</head>

<body>

<?php
if(isset($_GET['errorMessage'])){
 echo"<script>alert('your email and password is repeated')</script>";

}


?>


  <main class="form-signup w-100 m-auto" style="text-align:center ;">

    <form method="POST" action="<?= ("signup_submit") ?>"> 
    <section></section>

      <h1 class="h3 mb-3 fw-normal" style="color: white">Registration Form</h1>

      <div class="form-floating">
        <input type="text" id="member_name" placeholder="name" name="member_name">
        <label for="floatingInput"></label>
      </div>
      <div class="form-floating">
        <input type="email" id="member_email" placeholder="name@example.com" name="member_email">
        <label for="floatingInput"></label>
      </div>

      <div class="form-floating">
        <input type="number" id="member_mobile" placeholder="mobile" name="member_mobile">
        <label for="floatingInput"></label>
      </div>


      <div class="form-floating">
        <input type="password" id="member_password" placeholder="Password" name="member_password">
        <label for="floatingPassword"></label>
      </div>


      <div>
        <button class=" btn btn-lg btn-primary" type="submit">Sign Up</button> <br />

        <a href="<?= base_url('login') ?>" style="color: red">Already have an account? Login</a>
      </div>





      <p class="mt-5 mb-3 text-muted" >&copy; 2017–2022</p>
    </form>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>