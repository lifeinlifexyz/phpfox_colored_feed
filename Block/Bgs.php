<?php

namespace Apps\CM_ColoredFeed\Block;

use Phpfox;
use Phpfox_Component;

class Bgs extends Phpfox_Component
{
    public function process()
    {
        Phpfox::isUser(true);
        $model = Phpfox::getService('cmcoloredfeed.bgs');
        $this->template()
            ->assign('colors', $model->getActive());
        return 'block';
    }

}