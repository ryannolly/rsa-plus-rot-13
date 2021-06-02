<?php
  header('Content-Type: text/html; charset=iso-8859-1');
  if(!isset($_POST['submit'])){
    header('Location: index.php?status=truee');
  }

  $time_start = microtime(true);

  if(strlen($_POST['kalimatAwal']) > strlen($_POST['passwordOTP'])){
    $banyakPengulang = ceil(strlen($_POST['kalimatAwal'])/strlen($_POST['passwordOTP']));
    $kalimatAwal = $_POST['passwordOTP'];
    for($i = 0; $i<$banyakPengulang; $i++){
      $_POST['passwordOTP'] .= $kalimatAwal;
    }
  }
?>

<?php
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
      <h4>Password Algoritma OTP</h4>
      <p><b><center><?php echo $_POST['passwordOTP'] ?></center></b></p>
      <h4>Password Algoritma OTP dalam ASCII</h4>
      <table class="table" align="center">
        <tr>
          <th>Karakter</th>
          <th>Dalam ASCII</th>
        </tr>
        <?php
          for($i = 0; $i<strlen($_POST['passwordOTP']); $i++){ ?>
          <tr>
            <td><?php echo $_POST['passwordOTP'][$i] ?></td>
            <td><?php echo ord($_POST['passwordOTP'][$i]) ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
    <?php
      $kalimatEnkripsiOTP = "";
      for($i = 0; $i< strlen($_POST['hasilenkripsiRSA']); $i++){
        $enkripsiOTP[$i] = (ord($_POST['hasilenkripsiRSA'][$i]) + ord($_POST['passwordOTP'][$i])) % 256;
        $kalimatEnkripsiOTP .= chr($enkripsiOTP[$i]);
      }
    ?>
    <div class="container-fluid-mt-2">
     <h4>Kalimat Hasil Enkripsi Setelah menggunakan Algoritma RSA + OTP</h4>
     <p><b><center><?php echo $kalimatEnkripsiOTP ?></center></b></p>
     <h4>Kalimat Hasil Enkripsi Setelah Menggunakan Algoritma RSA + OTP dalam ASCII</h4>
     <table class="table" align="center">
        <tr>
          <th>Karakter</th>
          <th>Dalam ASCII</th>
        </tr>
        <?php
          for($i = 0; $i<strlen($kalimatEnkripsiOTP); $i++){ ?>
          <tr>
            <td><?php echo chr($enkripsiOTP[$i]) ?></td>
            <td><?php echo $enkripsiOTP[$i] ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
    <form action="prosesdekripsi.php" method="POST" accept-charset="iso-8859-1">
      <?php 
        for($i = 0; $i<strlen($kalimatEnkripsiOTP); $i++) : ?>
          <input type="hidden" name="hasilenkripsiRSAOTP[]" value="<?php echo $enkripsiOTP[$i] ?>">
      <?php endfor ?>
      <input type="hidden" name="passwordOTP" value="<?php echo $_POST['passwordOTP'] ?>">
      <input type="submit" value="Dekripsikan" name="submit" class="btn btn-info">
    </form>
    <?php
      $time_end = microtime(true);
      $execution_time = ($time_end - $time_start);
      echo '<b>Total Execution Time:</b> '.(double) $execution_time.' Second';
    ?>
</body>
</html>