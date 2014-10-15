@section('content')
<?php $schema = Norm::factory(f('controller.name'))->schema();?>
<h1>{{ f('controller.name') }} List</h1>
<div>
    <a href="{{ f('controller.url', '/null/create') }}" class="button">Create New</a>
    <table>
        <thead>
            <tr>
                @foreach ($schema as $key => $field)
                    @if(! $field['hidden'])
                        <th>{{ $field['label'] }}</th>
                    @endif
                @endforeach
            </tr>
        </thead>
        <tbody>
            @if(! $entries->count(true))
                <tr>
                    <td colspan="{{ count($schema) }}" style="text-align: center">Empty</td>
                </tr>
            @else
                @foreach ($entries as $entry)
                    <tr>
                        @foreach ($schema as $name => $field)
                            @if($field['hidden'] !== true)
                                <td>
                                     @if(reset($schema) === $field)
                                         <a href="{{ f('controller.url', '/'.$entry['$id']) }}">
                                             {{ $field->format('plain', $entry[$name], $entry) }}
                                         </a>
                                     @else
                                         {{ $field->format('plain', $entry[$name], $entry) }}
                                     @endif
                                </td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection
