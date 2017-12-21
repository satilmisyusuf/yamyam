<?php

require "simple_html_dom.php";
error_reporting(0);

?>



<?php

echo '<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>YAMYAM</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/business-casual.css" rel="stylesheet">

  </head>

  <body>


  <div class="tagline-upper text-center text-heading text-shadow text-white mt-5 d-none d-lg-block">YAMYAM</div>
  <div class="tagline-lower text-center text-expanded text-shadow text-uppercase text-white mb-5 d-none d-lg-block">Münir KARSLI Yusuf SATILMIŞ</div>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-faded py-lg-4">
      <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">YAMYAM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="index.php">Arama 1
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item active px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="about.php">Arama 2</a>

            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="blog.php">Arama 3</a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="contact.php">Arama 4</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
    <br>
    <br>

<html>
    <body>
    <form method="post">
      <div class="input-group">
      
 
    
    <input type="text" class="form-control" placeholder="URL" name="url_input">
    <div class="input-group-btn">
      
      
    </div>
  </div>
  
   <div class="input-group">    
    <div class="input-group-btn">
    <input type="text" class="form-control" placeholder="KELİME" name="kelime_input">
    </div>
  </div>
  
   <div class="input-group">
    <div class="input-group-btn">
      <button class="btn btn-default" type="submit" name="yusuf" value="Submit">
       ARA
      </button>
      
    </div>
  </div>



  </form>
     
   
    
 

    </body>
    </html>


    </div>
    <!-- /.container -->



    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
';
/*
$urls= array();
$kelimeler= array();

if (isset($_POST['urlGeldi'])){

    echo "URL GELDİ";
    global $urls;
    $urlInput = $_POST['url_input'];
   // echo $urlInput;

    //echo "URL'İMİZ: ".$urlInput;
    print_r($urls);


}

if (isset($_POST['kelimeGeldi'])){

    echo "KELİME GELDİ";
    global $kelimeler;
    $kelimeInput = $_POST['kelime_input'];
   // echo $kelimeInput;
    //array_push($kelimeler,$kelimeInput);
    $kelimeler[]=$kelimeInput;
   // echo "KELİME'İMİZ: ".$kelimeInput;
    print_r($kelimeler);


}

*/


if (isset($_POST['yusuf'])) {


     $urls;
     $kelimeler;
    $urlInput = $_POST['url_input'];
    $kelimeInput = $_POST['kelime_input'];



    $kelimeler=explode(" ",$kelimeInput);


    $urls=explode(" ",$urlInput);

   // print_r($urls);
  //  print_r($kelimeler);
    $i=0;

    echo "<br>";
    $siralamaDizisiSkor=array();
    $siralamaDizisiLink=array();
    $siralamaDizisi=array();
    $myCount=0;
    foreach ($urls as $urlInput )
    {
        if($urlInput!="") {
            $birlesikUrl = KelimeSay($kelimeler, $urlInput);

            // echo "<br><br>";
            $dizi = explode("###", $birlesikUrl);

            // $dizi2=explode("-",$dizi);

            // print_r($dizi);

            // echo "*************".$i."***************<br>";
            $i++;

            $elemanSayim = count($dizi);
            for ($j = 0; $j < $elemanSayim - 1; $j++) {
                $myword = explode("***", $dizi[$j]);
                $myScoreArray[$j] = $myword[1];
                //echo $myScoreArray[$j]." ";
            }
            $myScore = puanla($myScoreArray);
            //echo $dizi[$elemanSayim-1]."Kelimeye Göre Skoru: ".$myScore."<br>";

            array_push($siralamaDizisiSkor,$myScore);
            array_push($siralamaDizisiLink,$dizi[$elemanSayim-1]);
           // array_push($siralamaDizisi[$i])

   /*         echo '<div class="alert alert-success">
  <strong> ' . $dizi[$elemanSayim - 1] . "  Kelimeye Göre Skoru: " . $myScore . "<br>" . ' </strong>
</div>';
   */
            $myCount++;
        }





    }
for ($j=0;$j<$myCount-1;$j++) {

    for ($i = 0; $i < $myCount-1; $i++) {
        if ($siralamaDizisiSkor[$i] < $siralamaDizisiSkor[$i + 1]) {
            $tmp = $siralamaDizisiSkor[$i];
            $siralamaDizisiSkor[$i] = $siralamaDizisiSkor[$i + 1];
            $siralamaDizisiSkor[$i + 1] = $tmp;

            $tmp = $siralamaDizisiLink[$i];
            $siralamaDizisiLink[$i] = $siralamaDizisiLink[$i + 1];
            $siralamaDizisiLink[$i + 1] = $tmp;
        }
    }
}



    echo '<i style="color:blue;font-size:30px;font-family:calibri ;"><br> Skorlar:<br></i> ';
    for ($i=0;$i<$myCount;$i++) {
        echo  $siralamaDizisiLink[$i] . "  Kelimeye Göre Skoru: " . $siralamaDizisiSkor[$i] . "<br>" ;
    }




}








function basamakSayisiBul($sayi){

    $sayac=1;
    for($x=10;true;$x*=10)//koşulu true yaparak  sonsuz döngü kurduk
    {
        if($sayi<$x)//sayının 10un katları ile karşılaştırılması
            break;//break komutu dögüyü kırar ve komuttan sonraki satırlar çalıştırılmaz.
        else
            $sayac++;
    }
    return $sayac;



}
function puanla($sayiDizisi){

    $elemanSayisi=count($sayiDizisi);
    //echo $elemanSayisi;
    $toplamPuan=0;


    $ortalama = aritmetikOrtalama($sayiDizisi);
    echo 'Aritmetik Ortalama : '.$ortalama.'<br />';

    $toplam = toplamBul($sayiDizisi, $ortalama);

    $standartSapma = standartSapma($toplam, count($sayiDizisi));
    echo 'Standart Sapma : '.$standartSapma.'<br />';

    for($i=0;$i<$elemanSayisi;$i++){
        //$toplamPuan+=$sayiDizisi[$i]/$standartSapma;
    }


    for($i=0;$i<$elemanSayisi;$i++){

        if($sayiDizisi[$i]!=0){
            $toplamPuan+=10;
        }

        for ($j=$i;$j<$elemanSayisi;$j++){
            if($i!=$j){
                $hamPuan=abs($sayiDizisi[$i]-$sayiDizisi[$j]);
                $üsSAyim=basamakSayisiBul($hamPuan);
                $toplamPuan+=$sayiDizisi[$i]/$standartSapma;
                $toplamPuan+=$sayiDizisi[$j]/$standartSapma;

             if($standartSapma<$ortalama){
                    $toplamPuan+=$sayiDizisi[$i]/pow(2,$üsSAyim);
                    $toplamPuan+=$sayiDizisi[$j]/pow(2,$üsSAyim);
                }else{
                 $toplamPuan+=$sayiDizisi[$i]/pow(5,$üsSAyim);
                 $toplamPuan+=$sayiDizisi[$j]/pow(5,$üsSAyim);
             }



            }
        }
    }


    return $toplamPuan;
}

function aritmetikOrtalama($dizi) {
    $toplam = 0;
    for ($i = 0; $i < count($dizi); $i++) {
        $toplam += $dizi[$i];
    }
    return $toplam / count($dizi);
}

function toplamBul($dizi, $ortalama) {

    $toplam = 0;
    for ($i = 0; $i < count($dizi); $i++) {
        $toplam += pow(($dizi[$i] - $ortalama), 2);
    }
    return $toplam;
}

function standartSapma($toplam, $elemanSayisi) {
    return sqrt($toplam / $elemanSayisi);
}

function KelimeSay($kelimeler, $Url)
{

    $html = file_get_html($Url);
    $myText = (string)$html;

    $myText = strtolower($myText);


    $kelimedizi = array();

    foreach ($kelimeler as $kelime) {
        $klmTemp = array();
        $kelime1 = $kelime;

        $count = 0;

        array_push($klmTemp, $count);
        array_push($klmTemp, $kelime1);


        if (!in_array(strtolower(replace_tr($kelime1)), $klmTemp,true)) {
            array_push($klmTemp, strtolower($kelime1));
        }

        if (!in_array(strtolower($kelime1), $klmTemp,true)) {
            array_push($klmTemp, strtolower(replace_tr($kelime1)));
        }


        array_push($kelimedizi, $klmTemp);

    }

    echo '<i style="color:blue;font-size:30px;font-family:calibri ;"><br> Kelime Dizisi:<br></i> ';
    echo "<pre>".print_r($kelimedizi,true)."</pre>";

    $i=0;
    foreach ($kelimedizi as $abc) {
        $count = 0;

        foreach ($abc as $klm) {
            $text = $myText;

            if (strcmp(gettype($klm), "string") == 0) {

                //  echo "-" . $klm . "-<br>";

                while (strpos($text, $klm)) {


                    $tpm1=substr($text,strpos($text,$klm)-1,1);
                    $tpm2=substr($text,strpos($text,$klm)+strlen($klm),1);

                    //   echo "-".$tpm1."---".$tpm2."-<br>";



                    $search=array( 'q','w','e','r','t',
                        'y','u','ı','o','p',
                        'ğ','ü','a','s','d',
                        'f','g','h','j','k',
                        'l','ş','i','z','x',
                        'c','v','b','n','m','ö','ç');




                    if (in_array($tpm1,$search)||in_array($tpm2,$search))
                    {
                        //arananın başında veya sonunda harf var
                    }
                    else
                        $count++;
                    $konum = (int)strpos($text, $klm) + strlen($klm);
                    $text = substr($text, $konum);


                }
            }
        }


        $kelimedizi[$i][0]=$count;
        $i++;

    }



    echo '<i style="color:blue;font-size:30px;font-family:calibri ;"><br> Kelime Sayısı:<br></i> ';
    $tmp="";
    $tmp2="-----> ";
    foreach ($kelimedizi as $sss)
    {
        $tmp= $tmp.$sss[1] . "***" . $sss[0] . "###";
        $tmp2= $tmp2.$sss[1] . "=" . $sss[0] . "    ";


    }

    $tmp=$tmp."-----> ".$Url;
    $tmp2=$tmp2."url-".$Url;

        echo  $tmp2 . "<br>";

  //  echo $tmp;

    return $tmp;

}

function replace_tr($text)
{

    $search = array('Ç', 'ç', 'Ğ', 'ğ', 'ı', 'İ', 'Ö', 'ö', 'Ş', 'ş', 'Ü', 'ü');
    $replace = array('c', 'c', 'g', 'g', 'i', 'i', 'o', 'o', 's', 's', 'u', 'u');
    $new_text = str_replace($search, $replace, $text);
    return $new_text;
}


?>