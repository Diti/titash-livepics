<?php

// LPTemplate : système qui permet de stocker et récupérer des variables PHP facilement entre plusieurs fichiers.
require_once 'LPTemplate.class.php';
$t = new LPTemplate();
$t->LP_URL = 'http://www.titash.net/livepic';

// On récupère le contenu du fichier XML contenant les Livepics, et on le convertit en objet.
$lpFile = file_get_contents('xml/livepics.xml') or exit("Cannot read livepics.xml");
$t->lpXML = new SimpleXMLElement($lpFile);

// Plus loin dans la page, faire appel à $t->render($unFichier) permet de l’inclure et lui envoyer toutes les Livepics.
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
try {
    $t->render('header.phtml');
} catch (Exception $e) {
    trigger_error("Header: " . $e->getMessage(), E_USER_WARNING);
}
?>
</head>
<body>

<!-- Google Analytics Tracking -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-12285367-4', 'auto');
    ga('send', 'pageview');
</script>

<!-- TitashBar -->
<?php
try {
    $t->render('titashbar.phtml');
} catch (Exception $e) {
    trigger_error("TitashBar: " . $e->getMessage(), E_USER_WARNING);
}
?>

<!-- Gallery -->
<header>
  <div class="head-presentation">
    <div class="head-presentation_text">
      <div><h2 class="head-presentation_title">Titash Livepics</h2></div>
      The life of a drawn character is not always as flat as a sheet of paper. Follow Titash and his friends for a great adventure to explore the real world.<span class="tashbar-nav-content-menu_hidetext"> A new LivePic, every Friday on <a href="https://twitter.com/TitashMeerkat" title="Titash on Twitter @TitashMeerkat (EN)" target="_blank">Twitter</a>, <a href="http://titash.tumblr.com/" title="Titash on Tumblr" target="_blank">Tumblr</a> and <a href="https://plus.google.com/+TitashCreations" title="Titash on Google+" target="_blank">Google+</a>.</span>
    </div><!-- CSS/ head-presentation_text -->
  </div><!-- CSS/ head-presentation -->
</header>

<section>
  <div class="gallery">

    <?php
    try {
        $t->render('livepics.phtml');
    } catch (Exception $e) {
        trigger_error("Livepics: " . $e->getMessage(), E_USER_WARNING);
    }
    ?>

  </div>
</section>

<!-- Footer -->
<?php
try {
    $t->render('footer.phtml');
} catch (Exception $e) {
    trigger_error("Footer: " . $e->getMessage(), E_USER_WARNING);
}
?>
</body>
</html>
