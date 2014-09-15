@extends('layouts/default')

{{-- Page title --}}
@section('title')
	@parent
	: Complete
@stop

{{-- Inline scripts --}}
@section('scripts')
@parent
@stop

{{-- Inline styles --}}
@section('styles')
@parent
@stop

{{-- Page content --}}
@section('content')

{{-- Page header --}}
<div class="page-header">

	<h1>Hold Up Sailor!</h1>

</div>

<p>
	 Visit your extension in the <kbd>workbench</kbd> folder in the command line and run <kbd>composer install</kbd>.
</p>

<p>
	Alternatively, we provide a template for your <kbd>composer.json</kbd> autoload.
</p>

<p>
	Visit the <kbd>root.workbench.composer.json</kbd> to find out more.
</p>

<div class="form-actions">
	<a href="{{ URL::toAdmin('operations/workshop') }}" class="btn btn-large @if($zipHash) btn-primary @endif">Back to Workshop</a>

	<a href="{{ URL::toAdmin("operations/extensions") }}" class="btn btn-large btn-primary">Continue to Install</a>

</div>

@stop
