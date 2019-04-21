<?php
defined('PHPFOX') or exit('NO DICE!');
?>
{literal}
<style>
    .table_right {
        margin-left: 0 !important;
    }
</style>
{/literal}
{$sCreateJs}
<form id="cmlanding_js_slider_form" method="post" action="{url link='current'}" enctype="multipart/form-data"
      onsubmit="{$sGetJsForm}">
    <div class="panel panel-default">
        <div class="panel-body">

            <div class="table form-group">
                <div class="table_left">
                    {required}{phrase var='Text color'}:
                </div>
                <div class="table_right">
                    <input class="form-control" type="color" name="val[text_color]" value="{value id='text_color' type='input' default='#ffffff'}" size="30" maxlength="64" />
                </div>
                <div class="clear"></div>
            </div>

            <div class="table form-group">
                <div class="table_left">
                    {required}{phrase var='Background color'}:
                </div>
                <div class="table_right">
                    <input class="form-control" type="color" name="val[bg_color]" value="{value id='bg_color' type='input' default='#c600ff'}" size="30" maxlength="64" />
                </div>
                <div class="clear"></div>
            </div>

            {if !empty($aForms.image_path) && !empty($aForms.id)}
            {module name='core.upload-form' type='cmcoloredfeed' current_photo=$aForms.image_path id=$aForms.id}
            {else}
            {module name='core.upload-form' type='cmcoloredfeed'}
            {/if}


            <div class="form-group">
                <label>{_p var='is_active'}</label>
                <div class="item_is_active_holder">
                    <span class="js_item_active item_is_active">
                        <input type="radio" name="val[is_active]" value="1" {value type='radio' id='is_active'
                               default='1' selected='true' }/>
                    </span>
                    <span class="js_item_active item_is_not_active">
                        <input type="radio" name="val[is_active]" value="0" {value type='radio' id='is_active'
                               default='0' }/>
                    </span>
                </div>
            </div>

            <div class="table_clear">
                <input type="submit" value="{phrase var='Submit'}" class="button btn-primary"/>
            </div>
        </div>
    </div>
</form>