<?php

namespace Apps\CM_ColoredFeed\Service;

use Phpfox;

class Callback extends \Phpfox_Service
{
    public function getUploadParams()
    {
        return [
            'max_size' => null,
            'type_list' => ['jpg', 'jpeg', 'gif', 'png'],
            'upload_dir' => Phpfox::getParam('core.dir_pic') . 'colored_feed' . PHPFOX_DS,
            'upload_path' => Phpfox::getParam('core.url_pic') . 'colored_feed/' ,
            'thumbnail_sizes' => [120, 240, 624],
            'label' => _p('Feed background'),
        ];
    }
}