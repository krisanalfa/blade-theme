@section('content')
<?php

use KrisanAlfa\Theme\BladeTheme\Helper\Form;

$form = Form::create()->of($entry);

?>

<h2 class="title-content">{{ f('controller.name') }}</h2>

<form method="POST">
    <div class="nav-form">
        <div class="row">
            <div class="span-12">
                <ul class="flat pull-left">
                    <li>
                        <a href="{{ f('controller.url', '/') }}" class="button">Back</a>
                    </li>
                    <li>
                        <a href="{{ f('controller.url', '/'.$entry['$id'].'/update') }}" class="button">Update</a>
                    </li>
                </ul>
                <ul class="flat pull-right">
                    <li>
                        <a href="{{ f('controller.url', '/'.$entry['$id'].'/delete') }}" class="button delete">Delete</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <fieldset class="register">
        {{ $form->show() }}
    </fieldset>
</form>

@endsection
