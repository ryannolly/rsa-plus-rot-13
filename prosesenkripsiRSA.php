<?php
  header('Content-Type: text/html; charset=iso-8859-1');
  if(!isset($_POST['submit'])){
    header('Location: index.php?status=truee');
  }
?>

<?php

  $time_start = microtime(true);
  function fastModularExpo($a, $n, $modular){
    if($n == 0){
      return 1;
    }
    if($n % 2 == 0){
      return fastModularExpo($a * $a % $modular, $n/2, $modular);
    }else{
      return ($a * fastModularExpo($a, $n-1, $modular)) % $modular;
    }
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-16">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hasil Enkripsi</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   </head>
   <body>
    <div class="container-fluid-mt-2">
      <h4>Kalimat Awal</h4>
      <p><b><center><?php echo $_POST['kalimatEnkripsi'] ?></center></b></p>
      <h4>Kalimat Awal dalam ASCII</h4>
      <table class="table" align="center">
        <tr>
          <th>Karakter</th>
          <th>Dalam ASCII</th>
        </tr>
        <?php
          for($i = 0; $i<strlen($_POST['kalimatEnkripsi']); $i++){ ?>
          <tr>
            <td><?php echo $_POST['kalimatEnkripsi'][$i] ?></td>
            <td><?php echo ord($_POST['kalimatEnkripsi'][$i]) ?></td>
          </tr>

        <?php } ?>
      </table>
    </div>
    <?php
      //Proses Enkripsi Menggunakan Algoritma RSA
      $kalimatEnkripsiRSA = "";
      for($i = 0; $i < strlen($_POST['kalimatEnkripsi']) ; $i++){
          $enkripsiRSA[$i] = fastModularExpo(ord($_POST['kalimatEnkripsi'][$i]), 7, 187);
          $kalimatEnkripsiRSA .= chr($enkripsiRSA[$i]);
      }
    ?>
    <div class="container-fluid-mt-2">
      <h4>Kalimat Setelah Dienkripsi Menggunakan Algoritma RSA</h4>
      <p><b><center><?php echo $kalimatEnkripsiRSA ?></center></b></p>
      <h4>Kalimat Setelah Dienkripsi Menggunakan Algoritma RSA dalam ASCII</h4>
      <table class="table" align="center">
        <tr>
          <th>Karakter</th>
          <th>Dalam ASCII</th>
        </tr>
        <?php
          for($i = 0; $i<strlen($_POST['kalimatEnkripsi']); $i++){ ?>
          <tr>
            <td><?php echo chr($enkripsiRSA[$i]) ?></td>
            <td><?php echo $enkripsiRSA[$i] ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
    <form action="prosesenkripsiOTP.php" method="POST" accept-charset="iso-8859-1">
      <input type="hidden" name="hasilenkripsiRSA" value="<?php echo $kalimatEnkripsiRSA ?>">
      <input type="hidden" name="kalimatAwal" value="<?php echo $_POST['kalimatEnkripsi'] ?>">
      <div class="form-group">
        <label>Masukkan Password OTP</label>
        <input type="text" name="passwordOTP" placeholder="Masukkan .." class="form-control" required="">
      </div>
      <input type="submit" name="submit" value="Lanjutkan" class="btn btn-info">
    </form>
    <?php
      $time_end = microtime(true);
      $execution_time = ($time_end - $time_start);
      echo '<b>Total Execution Time:</b> '. (double) $execution_time.' Second';
    ?>
</body>
</html>