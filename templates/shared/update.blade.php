@section('content')
<?php use KrisanAlfa\Theme\BladeTheme\Helper\Form;
$form = Form::create()->of($entry);
?>

<h2>{{ f('controller.name') }}: Update</h2>

<form method="POST">
    {{ $form->show() }}

    <div>
        <a href="{{ f('controller.url', '/') }}" class="button">Back</a>
        <input type="submit" value="Save">
    </div>
</form>
@endsection
