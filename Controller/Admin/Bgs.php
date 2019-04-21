<?php

namespace Apps\CM_ColoredFeed\Controller\Admin;

use Phpfox;
use Phpfox_Component;

class Bgs extends Phpfox_Component
{
    public function process()
    {
        Phpfox::isAdmin();
        $model = Phpfox::getService('cmcoloredfeed.bgs');

        if (($names = $this->request()->getArray('delete', []))) {
            $model->delete($names);
            $this->url()->send('admincp.app', ['id' => 'CM_ColoredFeed'],
                _p('Successfully deleted'));
        }
        $this->template()
            ->setTitle(_p('Feed backgrounds'))
            ->setBreadCrumb(_p('Feed backgrounds'))
            ->setHeader('cache',[
                'drag.js' => 'static_script',
                'jquery/plugin/jquery.scrollTo.js' => 'static_script',
            ])
            ->assign('colors', $model->all());
    }

}