@section('content')
<?php use KrisanAlfa\Theme\BladeTheme\Helper\Form;
$form = Form::create()->of($entry);
?>

<h2>{{ f('controller.name') }}</h2>

<form method="POST">

    {{ $form->show(array('readonly' => true)) }}

    <div>
        <a href="{{ f('controller.url', '/') }}" class="button">Back</a>
        <a href="{{ f('controller.url', '/'.$entry['$id'].'/update') }}" class="button">Update</a>
        <a href="{{ f('controller.url', '/'.$entry['$id'].'/delete') }}" class="button warning">Delete</a>
    </div>
</form>

@endsection
