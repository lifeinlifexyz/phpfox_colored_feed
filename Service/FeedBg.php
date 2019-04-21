<?php

namespace Apps\CM_ColoredFeed\Service;

use Phpfox;
use Phpfox_Error;

class FeedBg extends \Phpfox_Service
{

    protected $_sTable = ':cm_feed_bg';

    public function create($feedId, $bgId)
    {
        $this->database()->insert($this->_sTable, [
            'feed_id' => $feedId,
            'bg_id' => $bgId
        ]);
        return $this;
    }

    public function update($aVals)
    {
        if (isset($aVals['feed_bg'])) {
            if (empty($aVals['feed_bg'])) {
                $this->delete((int)$aVals['feed_id']);
            } else {
                $feedBg = $this->database()->select('*')->from($this->_sTable)->where('feed_id='.(int)$aVals['feed_id'])->executeRow();
                if (!empty($feedBg)) {
                    $this->database()->update($this->_sTable, ['bg_id' => $aVals['feed_bg']], 'feed_id='.(int)$aVals['feed_id']);
                } else {
                    $this->create((int)$aVals['feed_id'], $aVals['feed_bg']);
                }
            }
        }
        return $this;
    }

    public function delete($feedId)
    {
        $this->database()->delete($this->_sTable, '`feed_id`= ' . $feedId);
        return $this;
    }

    public function mapBgs($aFeed, &$aActions)
    {
        $bg = $this->database()
            ->select('bg.feed_id as feed_id, bgs.*')
            ->from($this->_sTable, 'bg')
            ->leftJoin(':cm_feed_bgs', 'bgs', 'bgs.id = bg.bg_id')
            ->where('bg.feed_id = ' . $aFeed['feed_id'])
            ->executeRow();
        if (empty($bg)) {
            return;
        }
        $aActions['bg'] = (!empty($bg['image_path']) ? 'url(' . Phpfox::getLib('image.helper')->display([
                'server_id' => $bg['server_id'],
                'path' => 'core.url_pic',
                'file' => 'colored_feed/' . $bg['image_path'],
                'suffix' => '_624',
                'max_width' => '700',
                'max_height' => '500',
                'return_url' => true
            ]) . ')' : $bg['bg_color']);
        $aActions['bg_class'] = !empty($bg['image_path']) ? 'feed-bg-image' : 'feed-bg-color';
        $aActions['text_color'] = !empty($bg['text_color']) ? $bg['text_color'] : '#fff';
    }
}