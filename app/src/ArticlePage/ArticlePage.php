<?php
namespace SilverStripe\Lessons;

use Page;
// import jenis field
use SilverStripe\Forms\DateField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\AssetAdmin\Forms\UploadField;
// import sistem file(tabel yang mengatur mengenai file dari SS)
use SilverStripe\Assets\Image;
use SilverStripe\Assets\File;
use SilverStripe\Forms\CheckboxSetField;

class ArticlePage extends Page
{
    // tidak bisa dipilih pada halaman top level
    private static $can_be_root = false;

    // field model
    private static $db = [
        'Date' => 'Date',
        'Teaser' => 'Text',
        'AuthorArticle' => 'Varchar',
    ];

    // sama seperti $db hanya saja tidak memetakan nama field dan jenis fieldnya, tetapi memanggil
    // nama class atau nama tabel(foreign key)
    private static $has_one = [
        'Photo' => Image::class,
        'Brochure' => File::class,
        'Region' => Region::class,
    ];

    private static $owns = [
        'Photo',
        'Brochure',
    ];

    // artikel memiliki banyak kategori, dan kategori memiliki banyak artikel.
    private static $many_many = [
        'Categories' => ArticleCategory::class,
    ];

    // timbal balik dari has_one, satu artikel punya banyak komen
    private static $has_many = [
        'Comments' => ArticleComment::class,
    ];

    // form
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        // Argumen pertama(Date, Teaser, Author) harus sesuai dengan nama field di variabel db($db)
        // Argumen kedua(Date of article, Author of article) adalah label jika dikosongi seperti Tease
        // maka nama label akan default seperti nama field.

        // method atau fungsi addFieldtoTab menerima argumen tambahan, di bawah ini ada argumen baru 'Content'
        // yang berarti field date, teaser dan author diletakkan sebelum content.
        $fields->addFieldToTab('Root.Main', DateField::create('Date','Date of article'), 'Content');
        $fields->addFieldToTab('Root.Main', TextareaField::create('Teaser')
        ->setDescription('This is the summary that appears on the article list page.'),
            'Content'
        );
        $fields->addFieldToTab('Root.Main', TextField::create('AuthorArticle','Author of article'),'Content');
        $fields->addFieldToTab('Root.Attachments', $photo = UploadField::create('Photo'));
        $fields->addFieldToTab('Root.Attachments', $brochure = UploadField::create(
          'Brochure',
          'Travel brochure, optional (PDF only)'
        ));
        $fields->addFieldToTab('Root.Categories', CheckboxSetField::create(
            'Categories', // nama relasi many_many (private static many_many di atas)
            'Selected categories', // label
            // $this->Parent()->Categories() : Kategori disimpan di ArticleHolderhalaman induk,
            // jadi kita perlu memanggil Parent()terlebih dahulu.

            // ->map('ID','Title') = yang akan ditampilkan di checkbox (relasi yang disimpan pada argumen
            // pertama pasti ID, yang ditampilkan di user atau labelnya adalah judul)
            $this->Parent()->Categories()->map('ID','Title')
        ));
        $fields->addFieldToTab('Root.Main', DropdownField::create(
            'RegionID',
            'Region',
            Region::get()->map('ID','Title')
        )->setEmptyString('-- None --'), 'Content');

        // lokasi upload file
        $photo->setFolderName('travel-photos');
        $brochure
            // lokasi upload file
            ->setFolderName('travel-brochures')
            // cek apakah file brosur yang diupload berekstensi pdf
            ->getValidator()->setAllowedExtensions(array('pdf'));



        return $fields;
    }

    // membuat koma untuk list kategori
    public function CategoriesList()
    {
        if($this->Categories()->exists()) {
            return implode(', ', $this->Categories()->column('Title'));
        }

        return null;
    }

}
?>
