<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="Sehsyha" />
        <title>EL MACAQUE</title>
        
        <!-- jQuery --> 
        <?php echo js('jQuery'); ?>
        <script type="text/javascript" src="<?php echo js_url('jQueryUI'); ?>"></script>
        
        <!-- JS principal -->
        <script type="text/javascript" src="<?php echo js_url('master'); ?> "></script>
        <script type="text/javascript" src="<?php echo js_url('jquery.sidr.min'); ?>"></script>
        <script type="text/javascript" src="<?php echo js_url('panier')?>"></script>

        <!-- CSS principal -->
        <link rel="stylesheet" type="text/css" href="<?php echo css_url('master'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo css_url('jquery.sidr.dark'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo css_url('menu'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo css_url('panier'); ?>" />


        <!-- CSS changeant choisi par l'utilisateur -->
        <?php
            $style = $this->session->userdata('style');
            if(isset($style) && !empty($style) && !is_null($style) && strlen($style) > 0){
                echo '<link rel="stylesheet" type="text/css" href="' . theme_url($style) . '" id="theme" />';
            }else{
                echo '<link rel="stylesheet" type="text/css" href="' . theme_url('sehsyha') . '" id="theme" />';
            }

            //On écrit les css venant du controller 
            if(isset($css)){ echo_css($css); }
        
            //On écrit les js
            if(isset($js)){ echo_js($js); }
        ?>    
    </head>
    <body>  
        <?php if(!isset($header) || $header){ $this->load->view('header.php'); }?>

        <div id="ajaxResults"></div>

        <!-- Début du contenu de la page -->
        <div id="content" class="container">
            <?php if(isset($content)){ echo_content($content); }?>
        </div>
        <!-- Fin du contenu de la page -->
        
        <?php
            //Ajout des formulaires d'inscription et de connexion, cachés
            if(!isset($header) || $header){ 
                $this->load->view('contents/connect');
            }
        ?>
        <script type="text/javascript" src="<?php echo js_url('sidr'); ?> "></script>

    
    </body>
    <?php $this->load->view('contents/footer'); ?>
</html>