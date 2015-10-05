<!--tiles start-->
<div class="row">
    <a ui-sref="base.hospital" href="">
        <div class="col-md-4 col-sm-6">
            <div class="dashboard-tile detail tile-red">
                <div class="content">
                    <h1 class="text-left timer" data-from="0" data-to="180" data-speed="2500"></h1>
                    <p>医院浏览</p>
                </div>
                <div class="icon"><i class="fa fa-users"></i>
                </div>
            </div>
        </div>
    </a>
    <a ui-sref="base.hospital({with_search: 1})" href="">
        <div class="col-md-4 col-sm-6">
            <div class="dashboard-tile detail tile-turquoise">
                <div class="content">
                    <h1 class="text-left timer" data-from="0" data-to="56" data-speed="2500"></h1>
                    <p>医院查询</p>
                </div>
                <div class="icon"><i class="fa fa-comments"></i>
                </div>
            </div>
        </div>
    </a>
</div>
<!--tiles end-->