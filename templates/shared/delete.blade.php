@section('content')
<h2 class="">
    {{ 'Delete '.f('controller.name').' ('.count($ids).' entries)' }}
</h2>

<form action="" method="POST">

    <fieldset class="register">
        <input type="hidden" name="confirm" value="1">
        <p>
            Are you sure want to delete {{ count($ids).' entries' }}?
        </p>
        <div class="row">
            <div class="span-12">
                <ul class="flat">
                    <li>
                        <input type="submit" value="OK">
                    </li>
                    <li>
                        <a href="{{ f('controller.url') }}" class="button">Cancel</a>
                    </li>
                </ul>
            </div>
        </div>
    </fieldset>
</form>
@endsection
