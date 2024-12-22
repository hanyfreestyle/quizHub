<div class="container-fluid">
    <div class="page-title page_title_div">
        <div class="row">
            <div class="col-xl-4 col-sm-7 box-col-3 d-none d-xl-block">
                <h3 class="title">{{ IsArr($page,'title','') }}</h3>
            </div>
            <div class="col-5 d-none d-xl-block"></div>
            <div class="col-xl-3 col-sm-5 box-col-4">
                {{ Breadcrumbs::render('One',['name'=> IsArr($page,'title','') ]) }}
            </div>
        </div>
    </div>
</div>

