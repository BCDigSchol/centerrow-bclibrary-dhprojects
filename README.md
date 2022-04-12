# Center Row

## BC customizations

Customizations are not active by default. Activate them in the site's theme settings under **Use BCDH customizations**.

Whenever possible we've minimized the amount of PHP in views and moved it to custom helper functions instead. This makes
it easier to understand the HTML layout of pages and easier to understand the logic of view functions.

### Styles

Custom styles can be added in one of two ways:

* Directly add custom CSS to *asset/css/local-no-sass.css*.
* If you are set up to write SASS, edit or add *asset/sass/\*.local.scss* files.

### Views

We've added custom views:

#### *common/show-selector*

The *omeka/item/show.phtml* view now selects an appropriate item view to show from the *common/show-selector* directory
based on item metadata (type, collection, etc.).

| View | Description |
| ---  | ---         |
| *show-default.phtml* | default item page |
| *show-book.phtml* | item page for books |
| *show-map.phtml* | item page for maps |
| *show-no-media.phtml* | item page for items with no media |
| *single-metadata-field.phtml* | partial for a single metadata field |

### Helper functions

We've added new helper functions to make it easier to write and read partials:

| Helper | Description |
| ---    | ---         |
| `DHGetLabel()` | returns the appropriate label for a value |
| `DHSingleMetadataField()` | returns HTML to display a single metadata field |
| `DHAddStylesheets()` | adds a list of stylesheets to the current render |
| `DHAddScripts()` | adds a lis of scripts to the current page |
| `DHSelectShowPage()` | selects a show item page based on page metadata |

## Copyright

Center Row is Copyright © 2016-present Corporation for Digital Scholarship, Vienna, Virginia,
USA http://digitalscholar.org

The Corporation for Digital Scholarship distributes the Omeka source code under the GNU General Public License, version
3 (GPLv3). The full text of this license is given in the license file.

The Omeka name is a registered trademark of the Corporation for Digital Scholarship.

Third-party copyright in this distribution is noted where applicable.

All rights not expressly granted are reserved.
