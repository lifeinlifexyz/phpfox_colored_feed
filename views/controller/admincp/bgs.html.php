<?php

defined('PHPFOX') or exit('NO DICE!');

?>
<div class="table_header">
    {_p('Feed backgrounds')}
    <ul class="list-inline pull-right">
        <li>
            <a href="{url link='admincp.cmcoloredfeed.bgs.add'}" class="btn btn-primary popup">{_p('Add feed
                background')}</a>
        </li>
    </ul>
</div>
{if count($colors)}
<div class="panel panel-default">
    <form method="post" action="{url link='current'}">
        <div class="panel-group" id="accordion">
            <table class="table table-admin js_drag_drop" id="_sort"
                   data-sort-url="{url link='admincp.cmcoloredfeed.bgs.order'}">
                <tr>
                    <th style="width:10px;">
                        <input type="checkbox" name="delete[]" value="" id="js_check_box_all"
                               class="main_checkbox"/>
                    </th>
                    <th style="width:20px;"></th>
                    <th style="width:20px;"></th>
                    <th style="width: 120px">{_p('Feed background')}</th>
                    <th>{_p('Text color')}</th>
                </tr>
                {foreach from=$colors key=iKey item=aItem}
                <tr class="checkRow{if is_int($iKey/2)} tr{else}{/if}" data-sort-id="{$aItem.id}">
                    <td><input type="checkbox" name="delete[]" class="checkbox" value="{$aItem.id}"
                               id="js_id_row{$aItem.id}"/></td>
                    <td class="t_center">
                        <i class="fa fa-sort"></i>
                    </td>
                    <td class="t_center">
                        <a href="#" class="js_drop_down_link" title="Manage">{img
                            theme='misc/bullet_arrow_down.png'
                            alt=''}</a>

                        <div class="link_menu">
                            <ul>
                                <li><a class="popup"
                                       href="{url link='admincp.cmcoloredfeed.bgs.add' id=$aItem.id}">{_p('Edit')}</a>
                                </li>
                                <li><a href="{url link='current' delete[]=$aItem.id}"
                                       onclick="return confirm('{phrase var='core.are_you_sure'}');">{_p('Delete')}</a>
                                </li>
                            </ul>
                        </div>
                    </td>

                    <td>
                        <div class="feed-example">
                            {if !empty($aItem.image_path)}
                                {img path='core.url_pic' file='colored_feed/'.$aItem.image_path suffix='_50'
                                max_width=40 server_id=$aItem.server_id}
                            {else}
                                <span style="background: {$aItem.bg_color}"></span>
                            {/if}
                        </div>
                    </td>
                    <td style="background: #dadada">
                        <span style="color: {$aItem.text_color}">{$aItem.text_color}</span>
                    </td>

                </tr>
                {/foreach}
            </table>

        </div>
        <div class="table_bottom">
            <input type="submit" value="{_p('Delete selected')}"
                   class="sJsConfirm delete button sJsCheckBoxButton disabled" disabled="true"/>
        </div>
    </form>
</div>
{/if}