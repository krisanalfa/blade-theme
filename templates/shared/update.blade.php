@section('content')
<?php

use KrisanAlfa\Theme\BladeTheme\Helper\Form;

$form = Form::create()->of($entry);

?>
<h2 class="title-content">{{ f('controller.name') }}: Update</h2>

<form method="POST">
    <div class="nav-form">
        <div class="row">
            <div class="span-12">
                <ul class="flat pull-left">
                    <li>
                        <a href="{{ f('controller.url', '/') }}" class="button">Back</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <fieldset class="register">
        {{ $form->show() }}
    </fieldset>
    <div class="nav-form">
        <div class="row">
            <div class="span-12">
                <ul class="flat pull-right">
                    <li>
                        <input type="submit" value="Save">
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
