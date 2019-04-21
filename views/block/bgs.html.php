<div id="feed-backgrounds" style="display: none">
    <input class="feed-bg-value" type="hidden" name="val[feed_bg]"/>
    <ul class="list-inline">
        <li class="feed-bg-item reset active" data-cmd="coloredfeed.reset_bg"><span></span></li>
        {foreach from=$colors item=aItem}
        <li class="feed-bg-item" data-bg="{$aItem.id}" data-cmd="coloredfeed.select_bg"
            data-img="{if !empty($aItem.image_path)}url({img path='core.url_pic' file='colored_feed/'.$aItem.image_path suffix='_624'
            max_width=300 server_id=$aItem.server_id return_url=true}){else}{$aItem.bg_color}{/if}"
            data-color="{if !empty($aItem.text_color)}{$aItem.text_color}{else}#fff{/if}"
            >
            <span style="background:{if !empty($aItem.image_path)}url({img path='core.url_pic' file='colored_feed/'.$aItem.image_path suffix='_50'
            max_width=20 server_id=$aItem.server_id return_url=true}){else}{$aItem.bg_color}{/if};"></span>
        </li>
        {/foreach}
    </ul>
    <div class="clearfix"></div>
</div>
