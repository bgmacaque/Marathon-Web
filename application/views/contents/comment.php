<?php

foreach($comments as $comment){
    echo '<p>Note : ' . $comment->getAttr('valeur_note') . '<br /> ' . $comment->getAttr('content_comment') . '</p>';
}