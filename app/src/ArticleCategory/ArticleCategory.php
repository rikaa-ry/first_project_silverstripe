<?php 
namespace SilverStripe\Lessons;

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;

class ArticleCategory extends DataObject {

    // field model
    private static $db = [
        'Title' => 'Varchar',
    ];

    // satu kategori memiliki satu holder
    private static $has_one = [
        'ArticleHolder' => ArticleHolder::class,
    ];

    // timbal balik dari many_many
    private static $belongs_many_many = [
        'Articles' => ArticlePage::class,
    ];

    // untuk mendapatkan link article category
    public function Link()
    {
        return $this->ArticleHolder()->Link(
            'category/'.$this->ID
        );
    }

    public function getCMSFields()
    {
        return FieldList::create(
            TextField::create('Title')
        );
    }
}
?>