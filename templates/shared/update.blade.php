@section('content')
<?php
use \KrisanAlfa\Theme\BladeTheme\Helper\Form;

?>

<h2>{{ f('controller.name') }}: Update</h2>

<form method="POST">
    {{ Form::create()->of($entry)->show() }}

    <div>
        <a href="{{ f('controller.url', '/') }}" class="button">Back</a>
        <input type="submit" value="Save">
    </div>
</form>
@endsection
