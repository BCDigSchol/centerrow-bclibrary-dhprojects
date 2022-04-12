## Show item customization notes

Item records are stored in the $item objects.

Use the `$item->value($field_name, [$options])` function to get field values. For example:

```php
// Get the first date value.
$first_date = $item->value('dcterms:date');

// Get all subject values.
$all_subjects = $item->value('dcterms:subject', ['all' => true]);
```

Use `$item->link($link_text, [$link_type, $options])` to create a link:

```php
// Build a link to an item.
$item->link('View the map');

// Build a link to the item with <a class="viewit-link"/>
$item->link('', null, ['class' => 'viewit-link'])
```

More info at https://omeka.org/s/docs/developer/api/representations/