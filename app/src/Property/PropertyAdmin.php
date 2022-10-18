<?php 
namespace SilverStripe\Lessons;

use SilverStripe\Admin\ModelAdmin;

class PropertyAdmin extends ModelAdmin
{

    // judul yang akan muncul di sidebar CMS
    private static $menu_title = 'Properties';

    // url ketika menu tsb diakses --> admin/properties
    private static $url_segment = 'properties';

    // nama kelas yang dikelola
    private static $managed_models = [
        Property::class,
    ];

    private static $menu_icon = 'icons/property.png'; 
}
?>