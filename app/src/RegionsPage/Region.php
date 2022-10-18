<?php 
namespace SilverStripe\Lessons;

// tipe konten generik non-halaman harus disubkelaskan
use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Versioned\Versioned;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Control\Controller;

// objek mandiri
class Region extends DataObject
{

    // field model
    private static $db = [
        'Title' => 'Varchar',
        'Description' => 'HTMLText',
    ];

    // foreign key ke model photo dan regions page
    private static $has_one = [
        'Photo' => Image::class,
        // regions memiliki satu halaman wilayah, wilayah tidak boleh dimiliki lebih dari 
        // satu halaman wilayah
        'RegionsPage' => RegionsPage::class, 
    ];

    // Region memiliki banyak ArticlePage
    private static $has_many = [
        'Articles' => ArticlePage::class,
    ];

    // publikasi photo agar dapat diakses selain admin di website
    // untuk memastikan bahwa saat region disimpan, gambar terkaitnya juga akan dipublikasikan
    private static $owns = [
        'Photo',
    ];

    // extensions ini menggabungkan fungsionalitas ke dalam class untuk membuatnya mendukung 
    // pembuatan versi.
    private static $extensions = [
        Versioned::class,
    ]; 

    private static $versioned_gridfield_extensions = true;

    // field yang ditampilkan di cms admin
    private static $summary_fields = [
        'Photo.Filename' => 'Photo file name', 
        'Title' => 'Title',
        'Description' => 'Description'
    ];

    // menampilkan lokasi saat ini
    public function LinkingMode()
    {
        return Controller::curr()->getRequest()->param('ID') == $this->ID ? 'current' : 'link';
    }

    // fungsi untuk mengubah ukuran gambar di cms
    public function getGridThumbnail()
    {
        if($this->Photo()->exists()) {
            return $this->Photo()->ScaleWidth(100);
        }

        return "(no image)";
    }

    // link menuju halaman detail dari region
    public function Link()
    {
        return $this->RegionsPage()->Link('show/'.$this->ID);
    }

    // untuk mendapatkan link region
    public function ArticlesLink()
    {
        $page = ArticleHolder::get()->first();

        if($page) {
            return $page->Link('region/'.$this->ID);
        }
    }

    public function getCMSFields()
    {
        $fields = FieldList::create(
            TextField::create('Title'),
            HtmlEditorField::create('Description'),
            $uploader = UploadField::create('Photo')
        );

        // lokasi upload photo
        $uploader->setFolderName('region-photos');
        // cek ekstensi file photo yang diupload
        $uploader->getValidator()->setAllowedExtensions(['png','gif','jpeg','jpg']);

        return $fields;
    }
}
?>