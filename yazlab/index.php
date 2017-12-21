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

<div class="tagline-upper text-center text-heading text-shadow text-white mt-5 d-none d-lg-block" > YAMYAM</div>
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
                <li class="nav-item active px-lg-4">
                    <a class="nav-link text-uppercase text-expanded" href="index.php">Arama 1
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item px-lg-4">
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

<br>
<br>

<div class="container">

    <body>
    <form method="post">
    
    
    <div class="input-group">
   
    <input type="text" class="form-control" placeholder="KELİME" name="kelime_input">
    <input type="text" class="form-control" placeholder="URL" name="url_input">
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

    $kelimeInput = $_POST['kelime_input'];
    $urlInput = $_POST['url_input'];

    $kelimeler = array();
    array_push($kelimeler, $kelimeInput);
 //   print_r($kelimeler);



    KelimeSay($kelimeler, $urlInput);

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




   //print_r($klmTemp);
        if (!in_array(strtolower($kelime1), $klmTemp,true)) {
            array_push($klmTemp, strtolower($kelime1));
        }

        if (!in_array(strtolower(replace_tr($kelime1)), $klmTemp,true)) {
            array_push($klmTemp, strtolower(replace_tr($kelime1)));
        }

        print_r($klmTemp);
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
        $tmp= $tmp.$sss[1] . ":" . $sss[0] . ":";


    }

    $tmp=$tmp."url:".$Url;
    echo '<div class="alert alert-success">
  <strong> '.$tmp.' </strong>
</div>';

}

function replace_tr($text)
{

    $search = array('Ç', 'ç', 'Ğ', 'ğ', 'ı', 'İ', 'Ö', 'ö', 'Ş', 'ş', 'Ü', 'ü');
    $replace = array('c', 'c', 'g', 'g', 'i', 'i', 'o', 'o', 's', 's', 'u', 'u');
    $new_text = str_replace($search, $replace, $text);
    return $new_text;
}


?>




