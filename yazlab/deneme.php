<?php
error_reporting(0);
require "simple_html_dom.php";



?>



<?php


echo '
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
                        <span class="sr-only"></span>
                    </a>
                </li>
                <li class="nav-item px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" href="about.php">Arama 2</a>
                </li>
                <li class="nav-item px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" href="blog.php">Arama 3</a>
                </li>
                <li class="nav-item active px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" href="contact.php">Arama 4</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">

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


</div>
<!-- /.container -->



<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>


</html>';


if (isset($_POST['yusuf'])) {

    $kelimeler = array();


    $urls = array();

    $derinlinkler = array();

    $urlInput = $_POST['url_input'];
    $kelimeInput = $_POST['kelime_input'];



    $kelimeler=explode(" ",$kelimeInput);



    $urls=explode(" ",$urlInput);

    print_r($kelimeler);
    print_r($urls);

    /* $kelimeler = array();
     array_push($kelimeler, "metin");
     array_push($kelimeler, "bilgisayar");
     array_push($kelimeler, "sayar");

     $urls = array();
     array_push($urls, "http://bilgisayar.kocaeli.edu.tr/");
     array_push($urls, "http://fourplusone41.com/");
 */







    foreach ($urls as $urlInput) {


        array_push($derinlinkler, linksay($urlInput));

        // KelimeSay($kelimeler, $urlInput);

    }
    $myCount=0;
    $i=0;
    $siralamaDizisiSkor=array();
    $siralamaDizisiLink=array();
    $siralamaDizisi=array();
    $myCount=0;
    foreach ($derinlinkler as $urlInput) {

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
// ekrana 125 sayısı 3 basamaklıdır yazar


}
function puanla($sayiDizisi){

    $elemanSayisi=count($sayiDizisi);
    //echo $elemanSayisi;
    $toplamPuan=0;
    for($i=0;$i<$elemanSayisi;$i++){
        for ($j=$i;$j<$elemanSayisi;$j++){
            if($i!=$j){
                $hamPuan=abs($sayiDizisi[$i]-$sayiDizisi[$j]);
                $üsSAyim=basamakSayisiBul($hamPuan);
                // echo $üsSAyim."\n";
                $toplamPuan+=$sayiDizisi[$i]/pow(2,$üsSAyim);
                $toplamPuan+=$sayiDizisi[$j]/pow(2,$üsSAyim);
                //echo $toplamPuan." ";
                //  echo $sayiDizisi[$i]." ".$sayiDizisi[$j]."\n";
            }
        }
    }
    return $toplamPuan;
}



function KelimeSay($kelimeler, $Url)
{


    try {
        $db = new PDO("mysql:host=94.73.150.57;dbname=yusufsatilmis;charset=utf8", "yusufsatilmis", "?-Twh%-SQ-Nf");
        echo "BAŞARILI BAĞLANTI";
    } catch ( PDOException $e ){
        print $e->getMessage();
        echo "BAŞARISIZ BAĞLANTI";
    }
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

        $query = $db->query("SELECT * FROM kelime WHERE kelime='{$kelime1}'", PDO::FETCH_ASSOC);
        if ( $query->rowCount() ){
            foreach( $query as $row ){
                array_push($klmTemp, $row['anlam']);
                print $row['anlam']."<br />";
            }
        }


        if (!in_array(strtolower(replace_tr($kelime1)), $klmTemp)) {
            array_push($klmTemp, strtolower(replace_tr($kelime1)));
        }


        array_push($kelimedizi, $klmTemp);

    }


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

    $tmp="";
    foreach ($kelimedizi as $sss)
    {
        $tmp= $tmp.$sss[1] . "***" . $sss[0] . "###";


    }

    $tmp=$tmp."url-".$Url;
    echo $tmp;
    return $tmp;

}

function replace_tr($text)
{

    $search = array('Ç', 'ç', 'Ğ', 'ğ', 'ı', 'İ', 'Ö', 'ö', 'Ş', 'ş', 'Ü', 'ü');
    $replace = array('c', 'c', 'g', 'g', 'i', 'i', 'o', 'o', 's', 's', 'u', 'u');
    $new_text = str_replace($search, $replace, $text);
    return $new_text;
}



function linksay($link)
{
    $html = file_get_html($link);
    $myText = (string)$html;

    $text = $myText;

    $linkDerinlik1 = array();

    $harf=substr($link , -1);

    if (strcmp($harf,chr(47))==0)
        $link=substr($link,0,strlen($link)-1);

    echo "<br> <br> <br>" . "$link" . "<br>";
    array_push($linkDerinlik1, $link);

    $new_link = "";

    $link_lenght7 = substr($link, 0, 7);

    $tmp_link = $link . "/";

    if (strcmp("http://", $link_lenght7) == 0) {
        $new_link = substr($tmp_link, 0, strpos($tmp_link, "/", 9));
    } else if (strcmp("https:/", $link_lenght7) == 0) {
        $new_link = substr($tmp_link, 0, strpos($tmp_link, "/", 9));
    }


    echo "<br> <br> <br>" . "2. derinlik--" . "<br>";

    while (strpos($text, $new_link)) {

        $tpm1 = strpos($text, $new_link);
        $text = substr($text, $tpm1);

        $tpm2_1 = strpos($text, chr(32));
        $tpm2_2 = strpos($text, chr(34));

        if ($tpm2_1 < $tpm2_2)
            $tpm2 = $tpm2_1;
        else
            $tpm2 = $tpm2_2;

        $linkTmp = (string)substr($text, 0, $tpm2);

        $text = substr($text, $tpm2);


        //echo $tpm1."--".$tpm2;

        $harf=substr($linkTmp , -1);

        if (strcmp($harf,chr(47))==0)
            $linkTmp=substr($linkTmp,0,strlen($linkTmp)-1);


        $endPoint = strrpos($linkTmp, chr(46));


        $uzanti = substr($linkTmp, $endPoint + 1);


        if (strcmp($uzanti, "png") == 0 || strcmp($uzanti, "jpg") == 0 || strcmp($uzanti, "pdf") == 0 ||
            strcmp($uzanti, "gif") == 0 || strcmp($uzanti, "jpeg") == 0 || strcmp($uzanti, "doc") == 0 ||
            strcmp($uzanti, "rar") == 0 || strcmp($uzanti, "zip") == 0 || strcmp($uzanti, "gz") == 0) {


        } else {
            if (!in_array($linkTmp, $linkDerinlik1)) {
                array_push($linkDerinlik1, $linkTmp);
                echo $linkTmp . "---------------------------eklendi" . " <br>";
            } else {
                echo $linkTmp . "------------------------------------------------Daha önceden eklenmiş" . " <br>";
            }
        }


    }


    echo "<br> <br> <br>" . "3. derinlik--" . "<br>";


    foreach ($linkDerinlik1 as $linkTmp) {


        $html = file_get_html($linkTmp);
        $myText = (string)$html;

        $text = $myText;


        while (strpos($text, $new_link)) {

            $tpm1 = strpos($text, $new_link);
            $text = substr($text, $tpm1);

            $tpm2_1 = strpos($text, chr(32));
            $tpm2_2 = strpos($text, chr(34));

            if ($tpm2_1 < $tpm2_2)
                $tpm2 = $tpm2_1;
            else
                $tpm2 = $tpm2_2;

            $linkTmp = (string)substr($text, 0, $tpm2);

            $text = substr($text, $tpm2);


            //echo $tpm1."--".$tpm2;
            $harf=substr($linkTmp , -1);

            if (strcmp($harf,chr(47))==0)
                $linkTmp=substr($linkTmp,0,strlen($linkTmp)-1);


            $endPoint = strrpos($linkTmp, chr(46));


            $uzanti = substr($linkTmp, $endPoint + 1);


            if (strcmp($uzanti, "png") == 0 || strcmp($uzanti, "jpg") == 0 || strcmp($uzanti, "pdf") == 0 ||
                strcmp($uzanti, "gif") == 0 || strcmp($uzanti, "jpeg") == 0 || strcmp($uzanti, "doc") == 0 ||
                strcmp($uzanti, "rar") == 0 || strcmp($uzanti, "zip") == 0 || strcmp($uzanti, "gz") == 0) {


            } else {
                if (!in_array($linkTmp, $linkDerinlik1)) {
                    array_push($linkDerinlik1, $linkTmp);
                    echo $linkTmp . "---------------------------eklendi" . " <br>";
                } else {
                    echo $linkTmp . "------------------------------------------------Daha önceden eklenmiş" . " <br>";
                }
            }


        }


    }


    print_r($linkDerinlik1);

    echo "<br> <br> <br>";

    return $linkDerinlik1;


}



?>




