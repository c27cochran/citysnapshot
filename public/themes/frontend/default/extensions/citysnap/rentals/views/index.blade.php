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

    </div>

</div>


@stop
