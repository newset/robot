@include('includes.head')

<body class="off-canvas" ng-app="base_app">
<div id="container">
    @include('seg.navbar')
    <!--main content start-->
    <section class="main-content-wrapper">
        <section id="main-content">
            <div ui-view="page"></div>
        </section>
    </section>
</div>
@include('includes.foot')
