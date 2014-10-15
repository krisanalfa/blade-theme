@section('content')
<form method="POST">
    <fieldset>
        <legend>{{ f('controller.name') }}</legend>
        @foreach (Norm::factory(f('controller.name'))->schema() as $name => $field)
            @unless($field['generated'])
                <div>
                    <div>
                        {{ $field->label() }}
                    </div>
                    <div>
                        {{ $field->formatInput(@$entry[$name], $entry) }}
                    </div>
                </div>
            @endunless
        @endforeach

        <div>
            <a href="{{ f('controller.url') }}" class="button">Cancel</a>
            <button type="submit" class="button">Create</button>
        </div>
    </fieldset>
</form>
@endsection
