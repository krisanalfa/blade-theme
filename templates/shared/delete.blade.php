@section('content')
<h2>
    {{ 'Delete '.f('controller.name').' ('.count($ids).' entries)' }}
</h2>

<form action="" method="POST">
    <input type="hidden" name="confirm" value="1">
    <p>
        Are you sure want to delete {{ count($ids).' entries' }}?
    </p>

    <div>
        <input type="submit" value="OK">
        <a href="{{ f('controller.url') }}" class="button">Cancel</a>
    </div>
</form>
@endsection
