<?php
if (!empty($aVals['feed_bg'])) {
    Phpfox::getService('cmcoloredfeed.feedbg')->create($iReturnId, $aVals['feed_bg']);
}
