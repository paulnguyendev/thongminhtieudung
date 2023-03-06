<div class="navbar-header">
    <a class="navbar-brand" href="{{route('home/index')}}" target="_blank"><img
            src="{{ asset('obn-dashboard/img/logo.png') }}" alt=""></a>
    <ul class="nav navbar-nav pull-right visible-xs-block">
        <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
    </ul>
</div>
<div class="navbar-collapse collapse" id="navbar-mobile">
    <ul class="nav navbar-nav navbar-right">
        <li>
            <a href="{{ route('home/index') }}">
                <i class="icon-display4"></i> <span class="visible-xs-inline-block position-right">
                    Website</span>
            </a>
        </li>
    </ul>
</div>
