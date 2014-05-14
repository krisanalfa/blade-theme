<?php

use Norm\Norm;

$name = $self->get('name') ?: $self->get('foreign');

if (! isset($entries)) {
    $entries = Norm::factory(ucfirst($self->get('foreign')))->find();
}

?>
<select name="{{ lcfirst($name) }}">
    <option>&mdash;</option>
    @foreach ($entries as $entry)
        <?php
            if ($entry instanceof \Norm\Cursor) $entry = $entry->toArray();

            $v = ($entry[$self->get('foreignKey')]) ?: $entry['$id'];
        ?>
        <option value="{{ $v }}" {{ ($v == $value) ? 'selected' : '' }} >
            {{ $entry[$self->get('foreignLabel')] }}
        </option>
    @endforeach
</select>
