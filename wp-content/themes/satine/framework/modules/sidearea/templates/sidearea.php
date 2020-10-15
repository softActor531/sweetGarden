<section class="eltdf-side-menu">
    <div class="eltdf-side-area-inner">
        <div class="eltdf-close-side-menu-holder">
            <a class="eltdf-close-side-menu" href="#" target="_self">
                <span class="icon-arrows-remove"></span>
            </a>
        </div>
        <?php if(is_active_sidebar('sidearea')) {
            dynamic_sidebar('sidearea');
        } ?>
    </div>
    <div class="eltdf-side-area-bottom">
        <?php if(is_active_sidebar('sideareabottom')) {
            dynamic_sidebar('sideareabottom');
        } ?>
    </div>
</section>