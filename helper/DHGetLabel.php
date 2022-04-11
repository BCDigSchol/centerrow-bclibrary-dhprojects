<?php

namespace OmekaTheme\Helper;

use Laminas\View\Helper\AbstractHelper;
use Omeka\Api\Representation\ValueRepresentation;

/**
 * Helper for simplifying label display
 *
 * Labels require translating and cleaning before they can be displayed, and
 * we need to generate class names in order to identify the different metadata
 * fields for CSS or Javascript. This function simplifies that process rather
 * than doing it all in a view.
 *
 * Usage:
 *
 * This function expects a ValueRepresentation as an input.
 *
 *    * From a view: $label = $this->DHGetLabel($value);
 *    * From another helper: $label = $this->getView()->DHGetLabel($value);
 */
class DHGetLabel extends AbstractHelper
{
    private $translate;
    private $escape;

    public function __invoke(ValueRepresentation $value): DisplayLabel
    {
        // Helper plugins for translating and cleaning the label.
        $this->translate = $this->getView()->plugin('translate');
        $this->escape = $this->getView()->plugin('escapeHtml');

        // Get the original label string.
        $label = $value->property('label')->label();

        // Return a DisplayLabel.
        return new DisplayLabel($this->buildHTML($label), $this->buildClassName($label));
    }

    private function buildClassName(string $original_label): string
    {
        // Remove any HTML.
        $class = call_user_func_array($this->escape, [$original_label]);

        // Lowercase all alpha characters.
        $class = strtolower($class);

        // Remove leading and trailing spaces.
        $class = trim($class);

        // Convert any non-alphanumerics to hyphens and return.
        return preg_replace('/[^a-z0-9-]+/', '-', $class);
    }

    private function buildHTML(string $original_label): string
    {
        // Translate the label into the display language.
        $html = call_user_func_array($this->translate, [$original_label]);

        // Clean any HTML and return it.
        return call_user_func_array($this->escape, [$html]);
    }
}

/**
 * A convenience class for labels
 *
 * Each DisplayLabel has two parameters:
 *
 *      * $label->html - the HTML of the label
 *      * $label->class - a string that can be used as a class name to identify the field
 */
class DisplayLabel
{
    /** @var string the HTML for the label, cleaned and translated */
    public string $html;

    /** @var string a version of the label that  can be used as a class name */
    public string $class;

    public function __construct(string $html, string $class)
    {
        $this->html = $html;
        $this->class = $class;
    }
}