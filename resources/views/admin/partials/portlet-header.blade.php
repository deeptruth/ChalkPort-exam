
<div class="portlet-title">
    <div class="caption">
        {{ $title }} <small>{{ isset($titleDescription) ? $titleDescription : ''}}</small>
    </div>
    <div class="pull-right" style="padding-top: 7px">

    	@yield('portlet-button')
    	
    </div>
</div>