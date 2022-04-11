<?php

namespace OmekaTheme\Helper;

use Laminas\View\Helper\AbstractHelper;
use Omeka\Api\Representation\AbstractResourceEntityRepresentation;

/**
 * Display a single metadata field
 *
 * There's a lot of boilerplate code required to show a field. This helper
 * function encapsulates most of that so that fields can be displayed in
 * a single line.
 */
class DHSingleMetadataField extends AbstractHelper
{
    public function __invoke(string $field, AbstractResourceEntityRepresentation $item)
    {
        // Load the values for the field. If there aren't any, return an empty string.
        $values = $item->value($field, ['all' => true]);
        if (empty($values)) {
            return '';
        }

        // If we've made it here we need to display the field. First load the partial
        // plugin.
        $partial = $this->getView()->plugin('partial');

        // Now set the options for the partial.
        /** @var DisplayLabel $label */
        $label = $this->getView()->DHGetLabel($values[0]);
        $options = [
            'values' => $values,
            'label' => $label->html,
            'class' => $label->class
        ];

        // Finally, render the partial.
        return $partial('common/show-selector/single-metadata-field.phtml', $options);
    }
}