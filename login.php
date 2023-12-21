<?php
session_start();
$pesan = "";

if(isset($_POST['tombol'])){
    //1. koneksi dulu ke database
    include_once("koneksi.php");

    //2. mengambil nilai dari input
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    //3. menulis query
    $qry = "SELECT * FROM users WHERE email='$email' 
    AND password='$password'";

    //4. jalankan query
    $result = mysqli_query($con,$qry);

    //5. menghitung jumlah hasil query
    $hitung = mysqli_num_rows($result);

    if($hitung > 0){
        //proses login

        //1. mengambil seluruh data login
        $data = mysqli_fetch_array($result);
        $id = $data['id'];
        $nama = $data['nama'];

        //pembuatan session
        $_SESSION['sid'] = $id;
        $_SESSION['snama'] = $nama;
        $_SESSION['semail'] = $email;

        //update last log
        $qry_update = "UPDATE users SET last_log='now()' 
        WHERE id='$id'";
        $res_update = mysqli_query($con, $qry_update);

        //pengalihan ke halaman index
        ?>
        <script>
            document.location="index.php";
        </script>
        <?php
    }else{
        $pesan = '<div class="alert alert-danger" role="alert">
        Login Tidak Valid!.
        </div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <?php
    echo $pesan;
  ?>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="login.php" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="tombol" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
