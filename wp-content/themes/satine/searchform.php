<form role="search" method="get" class="searchform" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
    <span class="screen-reader-text"><?php esc_html_e('Search for:', 'satine'); ?></span>
    <div class="input-holder clearfix">
        <input type="search" class="search-field" placeholder="<?php esc_html_e('Enter your keyword...', 'satine'); ?>" value="" name="s" title="<?php esc_html_e('Search for:', 'satine'); ?>"/>
        <button type="submit" id="searchsubmit"><span class="icon_search"></span></button>
    </div>
</form>