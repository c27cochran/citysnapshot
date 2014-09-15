@extends('layouts/default')

{{-- Page title --}}
@section('title')
@parent
: {{{ trans('platform/admin::general.title') }}}
@stop

{{-- Queue assets: Asset::queue('name-your-asset', 'path-to-asset', array('dependency-name')) --}}

{{-- Inline scripts --}}
@section('scripts')
@parent
<script>
    $(document).ready(function() {


    });
</script>
@stop

{{-- Inline styles --}}
@section('styles')
@parent
@stop

{{-- Page content --}}
@section('content')

<div class="jumbotron">

    <div class="container">

        <h1>Rentals</h1>
        <img src="http://www.zillow.com/widgets/GetVersionedResource.htm?path=/static/logos/Zillowlogo_150x40_rounded.gif" width="150" height="40" alt="Zillow Real Estate Search" />

    </div>

</div>


@stop
