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
    <?php
      $kalimatDekripsiOTP = "";
      for($i = 0; $i < sizeof($_POST['hasilenkripsiRSAOTP']) ; $i++){
          if(($_POST['hasilenkripsiRSAOTP'][$i] - ord($_POST['passwordOTP'][$i])) > 0){
            $dekripsiOTP[$i] = (($_POST['hasilenkripsiRSAOTP'][$i] - ord($_POST['passwordOTP'][$i]))) % 256;
          }else{
            $dekripsiOTP[$i] = (($_POST['hasilenkripsiRSAOTP'][$i] - ord($_POST['passwordOTP'][$i]))) + 256;
          }
          $kalimatDekripsiOTP .= chr($dekripsiOTP[$i]);
      }
    ?>
    <div class="container-fluid-mt-2">
     <h4>Kalimat Setelah Didekripsi Menggunakan Algoritma OTP</h4>
     <p><b><center><?php echo $kalimatDekripsiOTP ?></center></b></p>
     <h4>Kalimat Setelah Didekripsi Menggunakan Algoritma OTP dalam ASCII</h4>
     <table class="table" align="center">
        <tr>
          <th>Karakter</th>
          <th>Dalam ASCII</th>
        </tr>
        <?php
          for($i = 0; $i<strlen($kalimatDekripsiOTP); $i++){ ?>
          <tr>
            <td><?php echo chr($dekripsiOTP[$i]) ?></td>
            <td><?php echo $dekripsiOTP[$i] ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
    <?php
    $kalimatDekripsiRSA = "";
      for($i = 0; $i< sizeof($dekripsiOTP); $i++){
        $dekripsiRSA[$i] = fastModularExpo($dekripsiOTP[$i], 23, 187);
        $kalimatDekripsiRSA .= chr($dekripsiRSA[$i]);
      }
    ?>
    <div class="container-fluid-mt-2">
     <h4>Kalimat Setelah Didekripsi Menggunakan Algoritma OTP + RSA</h4>
     <p><b><center><?php echo $kalimatDekripsiRSA ?></center></b></p>
     <h4>Kalimat Setelah Didekripsi Menggunakan Algoritma OTP + RSA dalam ASCII</h4>
     <table class="table" align="center">
        <tr>
          <th>Karakter</th>
          <th>Dalam ASCII</th>
        </tr>
        <?php
          for($i = 0; $i<strlen($kalimatDekripsiRSA); $i++){ ?>
          <tr>
            <td><?php echo chr($dekripsiRSA[$i]) ?></td>
            <td><?php echo $dekripsiRSA[$i] ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
    <a href="index.php" class="btn btn-info mb-4">Uji Coba Lagi</a>
    <?php
      $time_end = microtime(true);
      $execution_time = ($time_end - $time_start);
      echo '<b>Total Execution Time:</b> '.(double) $execution_time.' Second';
    ?>
</body>
</html>