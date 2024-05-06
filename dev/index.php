<?php
    // PHP SETUP
    error_reporting(0);
    ini_set('display_errors', '0');

    // UTM VALUES
    $utm_source = isset($_GET['utm_source']) ? $_GET['utm_source'] : "";
    $utm_medium = isset($_GET['utm_medium']) ? $_GET['utm_medium'] : "";
    $utm_campaign = isset($_GET['utm_campaign']) ? $_GET['utm_campaign'] : "";
    $utm_content = isset($_GET['utm_content']) ? $_GET['utm_content'] : "";
    $utm_term = isset($_GET['utm_term']) ? $_GET['utm_term'] : "";
    $utm_id = isset($_GET['utm_id']) ? $_GET['utm_id'] : "";
    $src = isset($_GET['src']) ? $_GET['src'] : "";

    // META VALUES
    $metaTitle = "";
    $metaUrl = "";
    $metaOGImage = "";
    $metaDescription = "";

    // CHECKOUT VALUES
    $redirect_checkout = "";
    $redirect_checkout_yearly = "";
    $checkout_timer = false;
    $presell = '2000-01-01 08:00:00';
    $deadline = new DateTime('2001-01-01 19:00:00');

    // GOOGLE TAG MANAGER ID
    $gtmID = "";

    // CONFIGURE IF HAS GOOGLE FONTS AND PANDA VIDEO TO CALL PRELOADERS
    $hasWebFonts = true;
    $hasPandaVideo = true;

    // GET RULES
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    }

    // POST RULES
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // WEBHOOK URL FOR N8N, ACTIVE CAMPAIGN or MANYCHAT
        $url = "";

        // FORM INPUTS
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $utm_source = isset($_POST['utm_source']) ? $_POST['utm_source'] : '';
        $utm_campaign = isset($_POST['utm_campaign']) ? $_POST['utm_campaign'] : '';
        $utm_medium = isset($_POST['utm_medium']) ? $_POST['utm_medium'] : '';
        $utm_content = isset($_POST['utm_content']) ? $_POST['utm_content'] : '';
        $utm_term = isset($_POST['utm_term']) ? $_POST['utm_term'] : '';
        $utm_id = isset($_POST['utm_id']) ? $_POST['utm_id'] : '';
        $src = isset($_POST['src']) ? $_POST['src'] : "";


        // CRIA UM ARRAY COM DIFERENTES LINKS DE CHECKOUT PARA CONTROLE DE VENDAS
        $links_checkout = array(
            // DEFAULT: VALIDA SE O TIMER ESTÁ APONTANDO PARA O CHECKOUT DE PRE VENDAS, CHECKOUT VENDAS OU SE O CARRINHO ESTÁ FECHADO
            "default"         => ($checkout_timer && $now < $deadline) ? "" : "",
            "NOVA_ORIGEM"        => ""
        );

        $url_checkout = isset($links_checkout[$utm_source]) ? $links_checkout[$utm_source] : $links_checkout['default'];

        $contact = array(
            "email" => $email,
            "name" => $name,
            "phonenumber" => $phonenumber,
            "utm_source" => $utm_source,
            "utm_campaign" => $utm_campaign,
            "utm_medium" => $utm_medium,
            "utm_content" => $utm_content,
            "utm_term" => $utm_term,
            "utm_id" => $utm_id,
            "src" => $src
        );

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($contact));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) { echo 'Erro na requisição cURL: ' . curl_error($ch); }

        curl_close($ch);

        // ID PARA AFILIADOS RECUPERAÇÃO POR E-MAIL
        $extraQuery = ($utm_source == "email" || $utm_source == "ActiveCampaign") ? "pid=" : "";

        // CONTINGÊNCIA PARA PRODUTOS EM VENDA NA HOTMART
        $extraQuery2 = ($utm_source == "ht") ? "off=&checkoutMode=10" : "";

        // FORMATAÇÃO DA URL FINAL
        $redirect_checkout = "$url_checkout?$extraQuery$extraQuery2&utm_source=$utm_source&utm_medium=$utm_medium&utm_campaign=$utm_campaign&utm_content=$utm_content&utm_term=$utm_term&utm_id=$utm_id&src=$src&name=$name&email=$email&phonenumber=$phonenumber";

        header("Location: $redirect_checkout");
        exit;
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Primary Meta Tags -->
    <meta charset="UTF-8">
    <meta name="title" content="<?= $metaTitle ?>">
    <meta name="description" content="<?= $metaDescription ?>">
    <meta name="robots" content="index,follow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $metaTitle ?></title>
    <link rel="canonical" href="/">
    <!-- <meta http-equiv="Content-Security-Policy" content="script-src 'none'"> -->

    <!-- Favicon Meta Tags -->
    <link rel="apple-touch-icon" sizes="180x180" href="public/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="public/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="public/images/favicon-16x16.png">
    <link rel="manifest" href="public/images/site.webmanifest">
    <link rel="mask-icon" href="public/images/safari-pinned-tab.svg" color="#000000">
    <link rel="shortcut icon" href="public/images/favicon.ico">
    <meta name="msapplication-TileColor" content="#000000">
    <meta name="msapplication-config" content="public/images/browserconfig.xml">
    <meta name="theme-color" content="#000000">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $metaUrl ?>">
    <meta property="og:title" content="<?= $metaTitle ?>">
    <meta property="og:description" content="<?= $metaDescription ?>">
    <meta property="og:image" content="<?= $metaOGImage ?>">

    <!-- Open Graph / Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= $metaUrl ?>">
    <meta property="twitter:title" content="<?= $metaTitle ?>">
    <meta property="twitter:description" content="<?= $metaDescription ?>">
    <meta property="twitter:image" content="<?= $metaOGImage ?>">

    <? if($hasWebFonts) { ?>
    <!-- GOOGLE FONTS PRELOADER -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;700&display=swap">
    <? } ?>

    <? if($hasPandaVideo) { ?>
    <!-- PANDA VIDEO PRELOADER -->
    <link rel="preload" href="https://player-vz-2cdebb25-226.tv.pandavideo.com.br/embed/css/styles.css" as="style">
    <link rel="prerender" href="https://player-vz-2cdebb25-226.tv.pandavideo.com.br/embed/?v=0a05b15b-a227-4ca7-955f-6f68b87044a6">
    <link rel="preload" href="https://player-vz-2cdebb25-226.tv.pandavideo.com.br/embed/js/hls.js" as="script">
    <link rel="preload" href="https://player-vz-2cdebb25-226.tv.pandavideo.com.br/embed/js/plyr.polyfilled.min.js" as="script">
    <link rel="preload" href="https://config.tv.pandavideo.com.br/vz-2cdebb25-226/0a05b15b-a227-4ca7-955f-6f68b87044a6.json" as="fetch">
    <link rel="preload" href="https://config.tv.pandavideo.com.br/vz-2cdebb25-226/config.json" as="fetch">
    <link rel="preload" href="https://b-vz-2cdebb25-226.tv.pandavideo.com.br/0a05b15b-a227-4ca7-955f-6f68b87044a6/playlist.m3u8" as="fetch">
    <link rel="dns-prefetch" href="https://b-vz-2cdebb25-226.tv.pandavideo.com.br">
    <link rel="dns-prefetch" href="https://player-vz-2cdebb25-226.tv.pandavideo.com.br">
    <link rel="dns-prefetch" href="https://vz-2cdebb25-226.b-cdn.net">
    <? } ?>

    <!-- DEFAULT STYLES -->
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/pages/index.css">

    <? if(isset($gtmID)) { ?>
    <!-- GOOGLE TAG MANAGER -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','<?= $gtmID ?>');</script>
    <? } ?>
</head>
<body>
    <? if(isset($gtmID)) { ?>
    <!-- GOOGLE TAG MANAGER -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= $gtmID ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <? } ?>

    <!-- DEFAULT HTML CONTENT -->

    <!-- DEFAULT HTML CONTENT -->

    <!-- DEFAULT SCRIPTS -->
    <? if($hasPandaVideo) { ?><script> const pandaVideoID = '<?= $pandavideo_id ?>'; </script><? } ?>
    <script src="./intlTelInput.min.js"></script>
    <script src="./script.js"></script>
</body>
</html>
