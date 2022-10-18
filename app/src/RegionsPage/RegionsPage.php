<?php  
namespace SilverStripe\Lessons;

use Page;

use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

class RegionsPage extends Page
{
    // halaman region memiliki banyak wilayah/regions
    private static $has_many = [
        // Regions (nama field) = terserah
        'Regions' => Region::class,
    ];

    // tidak perlu mendeklarasikan regions class karena sudah ada melalui relasi has-many
    private static $owns = [
        'Regions'
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Regions', GridField::create(
            'Regions',
            'Regions on this page',
            $this->Regions(),
            // GridField adalah bidang formulir yang dapat dikonfigurasi yang memungkinkan 
            // mengelola tabel data arbitrer(manasuka) --> seperti tabel tampilan index?
            GridFieldConfig_RecordEditor::create()
        ));

        return $fields;
    }
}
?>