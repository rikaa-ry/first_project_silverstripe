<?php 
namespace SilverStripe\Lessons;

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\CurrencyField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DateField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\ORM\ArrayLib;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TabSet;
use SilverStripe\Versioned\Versioned;

class Property extends DataObject
{

    // field model
    private static $db = [
        'Title' => 'Varchar',
        'PricePerNight' => 'Currency',
        'Bedrooms' => 'Int',
        'Bathrooms' => 'Int',
        'FeaturedOnHomepage' => 'Boolean',
        'Description' => 'Text',
        'AvailableStart' => 'Date',
        'AvailableEnd'=> 'Date'
    ];

    // properti mempunyai satu region dan foto
    private static $has_one = [
        'Region' => Region::class, // relasi -> id
        'PrimaryPhoto' => Image::class,
    ];

    // menampilkan field apa saja yang ditampilkan di CMS 
    private static $summary_fields = [
        'Title' => 'Title',
        'Region.Title' => 'Region',
        'PricePerNight.Nice' => 'Price',
        'FeaturedOnHomepage.Nice' => 'Featured?'
    ];

    private static $owns = [
        'PrimaryPhoto',
    ];

    private static $extensions = [
        Versioned::class,
    ];

    private static $versioned_gridfield_extensions = true;

    // menampilkan field apa saja yang ditampilkan di pencarian CMS
    // tidak digunakan karena saat mencari region tidak dropdown
    // private static $searchable_fields = [
    //     'Title',
    //     'Region.Title',
    //     'FeaturedOnHomepage'
    // ];  

    // menampilkan field apa saja yang ditampilkan di pencarian CMS
    // field region ditampilkan dropdown
    public function searchableFields()
    {
        return [
            'Title' => [
                // di filter menggunakan Partial (sebagian saja kecocokannya)
                'filter' => 'PartialMatchFilter',
                'title' => 'Title', // label
                'field' => TextField::class,
            ],
            'RegionID' => [
                // di filter Exact --> lebih akurat, harus sama persis
                'filter' => 'ExactMatchFilter',
                'title' => 'Region', // label
                'field' => DropdownField::create('RegionID')
                    ->setSource(
                        Region::get()->map('ID','Title')
                    )
                    ->setEmptyString('-- Any region --')                
            ],
            'FeaturedOnHomepage' => [
                'filter' => 'ExactMatchFilter',
                'title' => 'Only featured' // label         
            ]
        ];
    }

    public function getCMSfields()
    {
        $fields = FieldList::create(TabSet::create('Root'));
        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Title'),
            TextareaField::create('Description'),
            CurrencyField::create('PricePerNight','Price (per night)'),
            DropdownField::create('Bedrooms')
                ->setSource(ArrayLib::valuekey(range(1,10))),
            DropdownField::create('Bathrooms')
                ->setSource(ArrayLib::valuekey(range(1,10))),
            DropdownField::create('RegionID','Region')
                ->setSource(Region::get()->map('ID','Title')),
            CheckboxField::create('FeaturedOnHomepage','Feature on homepage'),
            DateField::create('AvailableStart', 'Date available (start)'),
            DateField::create('AvailableEnd', 'Date available (end)'),
        ]);
        $fields->addFieldToTab('Root.Photos', $upload = UploadField::create(
            'PrimaryPhoto',
            'Primary photo'
        ));

        // ekstensi file yang diizinkan untuk diupload
        $upload->getValidator()->setAllowedExtensions(array(
            'png','jpeg','jpg','gif'
        ));
        // lokasi upload foto
        $upload->setFolderName('property-photos');

        return $fields;
    }
}
?>