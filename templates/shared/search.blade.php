@section('content')
<a href="{{ f('controller.url', '/null/create') }}" class="button"> <i class="fa fa-plus"></i> Create</a>

<ul class="listview">
    <ul class="listview">
        <li class="list-group-container">
            <h2>{{ f('controller.name') }}</h2>
            <ul class="list-group">
                @foreach ($entries as $entry)
                    <li class="plain">
                        <a href="{{ f('controller.url', '/'.$entry['$id']) }}">
                            {{ $entry[key($entry->collection->schema())] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>
</ul>

@endsection
