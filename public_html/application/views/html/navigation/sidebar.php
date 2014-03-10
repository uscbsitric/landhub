<ul class="nav nav-stacked">
    <li><a href="/"><i class="icon-dashboard"></i><span> Dashboard</span></a></li>
    <?php if($user->has('roles', ORM::factory('Role', array('name' => 'admin')))): ?>
        <li>
            <a class="dropdown-collapse adjust" href="#"><i class="icon-certificate"></i>
                <span>Admin</span>
                <i class="icon-angle-down angle-down"></i>
            </a>
            <ul class="nav nav-stacked">
                <?php /*
                <li class="">
                    <a href="/admin/fields">
                        <i class="icon-caret-right"></i>
                        <span>Custom Fields</span>
                    </a>
                </li>
                */ ?>
            </ul>
        </li>
    <?php endif; ?>
    <li><a href="/properties"><i class="icon-home"></i><span> Properties</span></a></li>
    <li>
        <a class="dropdown-collapse adjust" href="#"><i class="icon-list"></i>
            <span>Listings</span>
            <i class="icon-angle-down angle-down"></i>
        </a>
        <ul class="nav nav-stacked">
            <li class="">
                <a href="/listings/craigslist">
                    <i class="icon-caret-right"></i>
                    <span>Craigslist</span>
                </a>
            </li>
            <li class="">
                <a href="/listings/youtube">
                    <i class="icon-caret-right"></i>
                    <span>YouTube</span>
                </a>
            </li>
            <li class="">
                <a href="/listings/ebay">
                    <i class="icon-caret-right"></i>
                    <span>eBay</span>
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a class="dropdown-collapse adjust" href="#"><i class="icon-book"></i>
            <span>Templates</span>
            <i class="icon-angle-down angle-down"></i>
        </a>
        <ul class="nav nav-stacked">
            <li class="">
                <a href="/listings/craigslist">
                    <i class="icon-caret-right"></i>
                    <span>Craigslist</span>
                </a>
            </li>
            <li class="">
                <a href="/listings/youtube">
                    <i class="icon-caret-right"></i>
                    <span>YouTube</span>
                </a>
            </li>
            <li class="">
                <a href="/listings/ebay">
                    <i class="icon-caret-right"></i>
                    <span>eBay</span>
                </a>
            </li>
        </ul>
    </li>
    <li><a href="/properties"><i class="icon-share-alt"></i><span> Syndicate</span></a></li>
</ul>