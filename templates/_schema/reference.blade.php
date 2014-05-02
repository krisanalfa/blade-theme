<?php use Norm\Norm;
$entries = Norm::factory(ucfirst($self->get('foreign')))->find();
?>

<select name="{{ $self->get('foreign') }}">
    <option>Select one</option>
    @foreach ($entries as $entry)
        <option value="{{ ($entry->get($self->get('foreignKey'))) ?: $entry->getId() }}"
            {{ (($entry->get($self->get('foreignKey'))) ?: $entry->getId() === $value ? 'selected' : '') }} >
            {{ $entry->get('name') }}
        </option>
    @endforeach
</select>
