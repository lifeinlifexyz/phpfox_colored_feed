<?php

$aFeed = Phpfox_Template::instance()->getVar('aFeed');
if (!empty($aFeed['bg'])) {
    echo '<div class="feed-bg" data-text-color="' . $aFeed['text_color'] . '" data-bg-class="' . $aFeed['bg_class'] . '" data-bg="' .  $aFeed['bg'] . '">';
}
