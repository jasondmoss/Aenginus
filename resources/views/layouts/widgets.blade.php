@include('widget.user')
@if(AenginusConfig::getValue('enable_hot_posts') == 'true')
    @include('widget.hot_posts')
@endif
@include('widget.categories')
@include('widget.tags')
