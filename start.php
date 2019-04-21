<?php
\Phpfox_Module::instance()
    ->addServiceNames([
        'cmcoloredfeed.bgs' => \Apps\CM_ColoredFeed\Service\Bgs::class,
        'cmcoloredfeed.feedbg' => \Apps\CM_ColoredFeed\Service\FeedBg::class,
        'cmcoloredfeed.callback' => \Apps\CM_ColoredFeed\Service\Callback::class,
    ])
    ->addComponentNames('controller', [
        'cmcoloredfeed.admincp.add-bg' => \Apps\CM_ColoredFeed\Controller\Admin\AddBg::class,
        'cmcoloredfeed.admincp.bgs' => \Apps\CM_ColoredFeed\Controller\Admin\Bgs::class,
    ])
    ->addComponentNames('ajax', [
        'cmcoloredfeed.ajax' => \Apps\CM_ColoredFeed\Ajax\Ajax::class,
    ])
    ->addComponentNames('block', [
        'cmcoloredfeed.bgs' => \Apps\CM_ColoredFeed\Block\Bgs::class,
    ])
    ->addAliasNames('cmcoloredfeed', 'CM_ColoredFeed')
    ->addTemplateDirs([
        'cmcoloredfeed' => PHPFOX_DIR_SITE_APPS . 'CM_ColoredFeed' . PHPFOX_DS . 'views',
    ]);

group('/admincp/cmcoloredfeed/', function () {

    route('bgs/add', 'cmcoloredfeed.admincp.add-bg');
    route('bgs', 'cmcoloredfeed.admincp.bgs');
    route('bgs/order', function () {
        \Phpfox::isAdmin(true);
        $aOrder = explode(',', request()->get('ids'));
        Phpfox::getService('cmcoloredfeed.bgs')->updateOrder($aOrder);
    });
});

group('/coloredfeed/', function () {
    route('bgs', function () {
        echo json_encode(Phpfox::getService('cmcoloredfeed.bgs')->getActive());
        exit();
    });
});