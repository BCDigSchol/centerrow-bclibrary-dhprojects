<?php

namespace OmekaTheme\Helper;

use Omeka\Api\Representation\ItemRepresentation;

class DHSelectShowPage extends \Laminas\View\Helper\AbstractHelper
{
    /**
     * Choose item page based on metadata
     *
     * Replace show.phtml with this page to choose the item page based on metadata.
     *
     * Create a custom item templates based on the metadata you are interested in. The
     * different item templates are stored in the theme view directory:
     *
     *       /view/common/show-selector
     *
     * Metadata fields you can use include:
     *
     *     * Does the item have media?
     *     * Resource class (e.g. 'bibo:Book', 'bibo:Map')
     *     * The item's site (taken from URL, e.g. 'test-site')
     *     * Item sets the item belongs to (e.g. 'Historical Maps')
     *
     * See the example code below.
     *
     */
    public function __invoke(ItemRepresentation $item)
    {
        $partial = $this->getView()->plugin('partial');

        // Get the current item's resource class.
        $show_selector_class = $item->resourceClass()->term();

        // Does it have media associated with it?
        $show_selector_has_no_media = sizeof($item->media()) === 0;

        // Determine show page based on whether item has media and what its resource class is.
        if ($show_selector_has_no_media) {
            $return_partial = $partial('common/show-selector/show-no-media');
        } elseif ($show_selector_class === 'bibo:Map') {
            $return_partial = $partial('common/show-selector/show-map');
        } elseif ($show_selector_class === 'bibo:Book') {
            $return_partial = $partial('common/show-selector/show-book');
        } else {
            $return_partial = $partial('common/show-selector/show-default');
        }

        return $return_partial;

        /* Other possibilities to determine selected show page.

        // Site name (e.g. 'test-site')
        $show_selector_site = $this->plugin('Laminas\View\Helper\ViewModel')->getRoot()->getVariable('site')->slug();

        // First item set (we could get all sets if we needed to)
        $show_selector_all_sets = $item->itemSets();
        $show_selector_item_set = array_shift($show_selector_all_sets);

        */
    }

}