@section('content')
<form method="POST">
    <fieldset>
        <legend>{{ f('controller.name') }}</legend>
            <input type="hidden" name="confirm" value="1">

            <strong>Are you sure, you are about to delete {{ count($ids).' entries' }}?</strong>

            <div>
                <a href="{{ dirname(URL::current()) }}" class="button">Cancel</a>
                <input class="button" type="submit" value="Delete forever">
            </div>
    </fieldset>
</form>
@endsection
