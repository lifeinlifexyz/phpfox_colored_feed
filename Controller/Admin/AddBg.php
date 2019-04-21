<?php

namespace Apps\CM_ColoredFeed\Controller\Admin;

use Phpfox;
use Phpfox_Component;
use Phpfox_Validator;

class AddBg extends Phpfox_Component
{
    public function process()
    {
        Phpfox::isAdmin();
        $bIsEdit = false;
        $model = Phpfox::getService('cmcoloredfeed.bgs');
        if ($iEditId = $this->request()->getInt('id')) {
            $bIsEdit = true;
            $aItem = $model->get($iEditId);
            $this->template()->assign('aForms', $aItem);
        }

        $aValidation = [
            'is_active' => [
                'def' => 'required',
                'title' => _p('Status is required'),
            ],
        ];


        $oValid = Phpfox_Validator::instance()->set([
            'sFormName' => 'cmcfeed_js_bg_form',
            'aParams' => $aValidation,
        ]);

        if ($aInput = $this->request()->getArray('val')) {

            if ($oValid->isValid($aInput)) {
                if ($bIsEdit) {
                    $model->update($iEditId, $aInput);
                } else {
                    $model->create($aInput);
                }
                $this->url()->send('admincp.app', ['id' => 'CM_ColoredFeed'],
                    _p('Successfully saved'));
            }
        }
        $title = !empty($iEditId) ? _p('Edit background') : _p('Add background');
        $this->template()
            ->setTitle($title)
            ->setBreadCrumb($title)
            ->assign([
                'sCreateJs' => $oValid->createJS(),
                'sGetJsForm' => $oValid->getJsForm(),
            ]);
    }
}