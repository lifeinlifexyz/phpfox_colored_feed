<?php

namespace Apps\CM_ColoredFeed\Service;

use Phpfox;
use Phpfox_Error;

class Bgs extends \Phpfox_Service
{

    protected $_sTable = ':cm_feed_bgs';

    public function all()
    {
        return $this->database()
            ->select("*")
            ->from($this->_sTable)
            ->order('ordering')
            ->execute('getslaverows');
    }

    public function get($id)
    {
        return $this->database()->select('*')->from($this->_sTable)->where('id='.$id)->executeRow();
    }

    public function getActive()
    {
        return $this->database()
            ->select('*')
            ->from($this->_sTable)
            ->where('is_active=1')
            ->order('ordering')
            ->executeRows();
    }

    public function create($aVals)
    {
        $aInsert = [];
        $aInsert['is_active'] = $aVals['is_active'] ?: 1;
        $aInsert['text_color'] = $aVals['text_color'] ?: '#fff';
        $aInsert['bg_color'] = $aVals['bg_color'] ?: '#c600ff';
        if (!empty($aVals['temp_file'])) {
            //Get detail of this file
            $aFile = Phpfox::getService('core.temp-file')->get($aVals['temp_file']);
            if (!empty($aFile)) {
                //Set value for `image_path` and `server_id` column based on data of temp file
                $aInsert['image_path'] = $aFile['path'];
                $aInsert['server_id'] = $aFile['server_id'];
                Phpfox::getService('core.temp-file')->delete($aVals['temp_file']);
            }
        }
        $this->database()->insert($this->_sTable, $aInsert);
    }

    public function update($id, $aVals)
    {
        $aInsert = [];
        $aInsert['is_active'] = $aVals['is_active'] ?: 1;
        $aInsert['text_color'] = $aVals['text_color'] ?: '#fff';
        $aInsert['bg_color'] = $aVals['bg_color'] ?: '#c600ff';

        if (!empty($aVals['temp_file'])) {
            //Get detail of this file
            $aFile = Phpfox::getService('core.temp-file')->get($aVals['temp_file']);
            if (!empty($aFile)) {
                //Set value for `image_path` and `server_id` column based on data of temp file
                $aInsert['image_path'] = $aFile['path'];
                $aInsert['server_id'] = $aFile['server_id'];
                Phpfox::getService('core.temp-file')->delete($aVals['temp_file']);
            }
        }
        $this->database()->update($this->_sTable, $aInsert, 'id='.$id);
    }

    public function delete($names)
    {
        foreach ((array)$names as $name) {
            $this->database()->delete($this->_sTable, '`id`= ' . $name);
        }
        return $this;
    }

    public function updateOrder($aVals)
    {
        $iCnt = 0;
        foreach ($aVals as $iId) {
            $iCnt++;
            $this->database()->update($this->_sTable, ['ordering' => $iCnt], 'id = ' . (int)$iId);
        }
        return true;
    }

    public function setStatus($iId, $iStatus)
    {
        $iId = (int) $iId;
        return $this->database()->update($this->_sTable,
            ['`is_active`' => $iStatus], '`id` = ' . $iId);
    }
}