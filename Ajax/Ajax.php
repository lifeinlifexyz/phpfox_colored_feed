<?php
namespace Apps\CM_ColoredFeed\Ajax;

use Phpfox;
use Phpfox_Ajax;

class Ajax extends Phpfox_Ajax
{
    public function getBgs()
    {
        if (\Phpfox::isUser()) {
            ob_start();
            Phpfox::getBlock('cmcoloredfeed.bgs');
            $content = ob_get_contents();
            ob_end_clean();
            $this->call("if (!$('#js_activity_feed_form .activity_feed_form_button_position').hasClass('bg-loaded')) {");
            $this->prepend('#js_activity_feed_form .activity_feed_form_button_position', '<div id="feed-bg-control" data-cmd="coloredfeed.toggle_bgs"><span></span></div>');
            $this->prepend('#js_activity_feed_form .activity_feed_form_button_position', $content);
            $this->addClass('#js_activity_feed_form .activity_feed_form_button_position', 'bg-loaded');
            $this->call('}');

            $this->call("if (!$('#js_activity_feed_edit_form .activity_feed_form_button_position').hasClass('bg-loaded')) {");
            $this->prepend('#js_activity_feed_edit_form .activity_feed_form_button_position', '<div id="feed-bg-control" data-cmd="coloredfeed.toggle_bgs"><span></span></div>');
            $this->prepend('#js_activity_feed_edit_form .activity_feed_form_button_position', $content);
            $this->addClass('#js_activity_feed_edit_form .activity_feed_form_button_position', 'bg-loaded');
            $this->call('}');
        }
    }

}