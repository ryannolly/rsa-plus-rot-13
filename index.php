<?php
    if(isset($_GET['status'])){
        if($_GET['status'] == "true"){
            echo "Pastikan Jumlah Karakter dari Kalimat Enkripsi Lebih kecil atau sama dengan dengan Password";
            echo "<br>";
        }else if($_GET['status'] == "truee"){
            echo "Harap memulai program dari sini!";
            echo "<br>";
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-16">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Kriptografi RNA + OTP</title>
  </head>
  <body>

    <div class="container-fluid mt-2">
        <form action="prosesenkripsiRSA.php" method="POST" accept-charset="iso-8859-1">
            <div class="form-group">
                <label for="exampleInputEmail1">Masukkan Kalimat yang Ingin Dienkripsi</label>
                <input type="text" class="form-control" placeholder="Masukkan Kalimat" name="kalimatEnkripsi" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Encrypt</button>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>