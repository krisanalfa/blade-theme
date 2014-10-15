@section('content')
<?php $schema = Norm::factory(f('controller.name'))->schema(); ?>
<form>
    <fieldset>
        <legend>{{ f('controller.name') }}</legend>
        @foreach ($schema as $name => $field)
            @unless($field['hidden'])
                <div>
                    <div>
                        {{ $field->label() }}
                    </div>
                    <div>
                        {{ $field->formatReadonly($entry[$name], $entry) }}
                    </div>
                </div>
            @endunless
        @endforeach

        <div>
            <a href="{{ f('controller.url', '/'.$entry['$id'].'/update') }}" class="button">Update</a>
            <a href="{{ f('controller.url', '/'.$entry['$id'].'/delete') }}" class="button">Delete</a>
        </div>
    </fieldset>
</form>
@endsection
