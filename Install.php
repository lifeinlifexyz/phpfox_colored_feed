<?php
namespace Apps\CM_ColoredFeed;

use Core\App;

/**
 * Class Install
 * @author  Neil J. <neil@phpfox.com>
 * @version 4.6.0
 * @package Apps\CM_ColoredFeed
 */
class Install extends App\App
{
    private $_app_phrases = [

    ];

    protected function setId()
    {
        $this->id = 'CM_ColoredFeed';
    }

    protected function setAlias()
    {
        $this->alias = 'cmcoloredfeed';
    }

    protected function setName()
    {
        $this->name = 'Colored Feed';
    }

    protected function setVersion()
    {
        $this->version = '4.1.0';
    }

    protected function setSupportVersion()
    {
        $this->start_support_version = '4.6.1';
        $this->end_support_version = '4.6.1';
    }

    protected function setSettings()
    {
    }

    protected function setUserGroupSettings()
    {
    }

    protected function setComponent()
    {
    }

    protected function setComponentBlock()
    {
    }

    protected function setPhrase()
    {
        $this->phrase = $this->_app_phrases;
    }

    protected function setOthers()
    {
        $this->_writable_dirs = [
            'PF.Base/file/pic/colored_feed/'
        ];
        $this->_publisher = 'CodeMake It';
        $this->_publisher_url = 'http://codemake.org/';

        $this->admincp_route = 'admincp.cmcoloredfeed.bgs';

        $this->admincp_menu = [
            'Feed backgrounds' => 'cmcoloredfeed.bgs',
        ];

        $this->database = [
            'Bgs',
            'FeedBG',
        ];
    }
}