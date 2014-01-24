<!--        DEBUT DU HEADER             -->
<?php
    $this->load->view('contents/left-menu');
?>
<header>
<div id="top-header">
    <a class="top" id="left-menu" href="#left-menu">Menu</a> 
        <h1 id="logo">EL MACAQUE</h1>
        <div id="rightBlock">
            <div id="themeSwitcher">
                <select>
                    <?php
                        //Changement du style
                        $styles = array(
                                'sehsyha.css' => 'Sehsyha',
                                'kaced.css' => 'Kaced'
                            );
                        $style = $this->session->userdata('style');
                        if(!empty($style)){
                            $compare = $style . '.css';
                            foreach ($styles as $key => $value) {
                                echo '<option value="' . $key . '"';
                                
                                if($key == $compare){
                                    echo ' selected="selected"';
                                }
                                echo '>';
                                echo $value . '</option>';
                            }
                        }else{
                            foreach ($styles as $key => $value) {
                                echo '<option value="' . $key . '">'.$value.'</option>';                    
                            }
                        }
                    ?>
                </select>
            </div><br />

            <?php
                echo '<div id="compte">';
                $this->load->view('contents/compte');
                echo '</div>';
            ?>
                    <?php  $this->load->view('contents/panier_header'); ?>

        </div>
</div>
        <div id="ariane">
            <?php $this->load->view('contents/ariane'); ?>
        </div>
</header>


<!--            FIN DU HEADER           -->