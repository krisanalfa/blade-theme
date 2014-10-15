@section('content')
<?php $schema = Norm::factory(f('controller.name'))->schema(); ?>
<form method="POST">
    <fieldset>
        <legend>{{ f('controller.name') }}</legend>
        @foreach ($schema as $name => $field)
            <div>
                <div>
                    {{ $field->label() }}
                </div>
                <div>
                    {{ $field->formatInput($entry[$name], $entry) }}
                </div>
            </div>
        @endforeach

        <div>
            <a href="{{ f('controller.url', '/'.$entry['$id']) }}" class="button">Cancel</a>
            <button type="submit" class="button">Submit</button>
            <a href="{{ f('controller.url', '/'.$entry['$id'].'/delete') }}" class="button">Delete</a>
        </div>
    </fieldset>
</form>
@endsection
