<?php 
namespace SilverStripe\Lessons;

use SilverStripe\ORM\DataObject;

class ArticleComment extends DataObject
{
    //field model
    private static $db = [
        'Name' => 'Varchar',
        'Email' => 'Varchar',
        'Comment' => 'Text'
    ];

    // relasi ke article page, satu komen punya satu artikel
    private static $has_one = [
        'ArticlePage' => ArticlePage::class,
    ];
}
?>