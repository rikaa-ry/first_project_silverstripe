<?php 
namespace SilverStripe\Lessons;

use PageController;
use SilverStripe\ORM\PaginatedList;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\ORM\FieldType\DBField;

class ArticleHolderController extends PageController
{
    // daftar tindakan yang diizinkan
    private static $allowed_actions = [
        'category',
        'region',
        'date'
    ];

    protected $articleList;

    protected function init ()
    {
        parent::init();

        $this->articleList = ArticlePage::get()->filter([
            'ParentID' => $this->ID
        ])->sort('Date DESC');
    }

    // memberikan paginatedList
    public function PaginatedArticles ($num = 4)
    {       
        return PaginatedList::create(
            $this->articleList,
            $this->getRequest()
        )->setPageLength($num);
    }

    // filter untuk kategori (menampilkan banyaknya artikel yang sesuai dgn kategori tsb)
    public function category (HTTPRequest $r)
    {
        $category = ArticleCategory::get()->byID(
            $r->param('ID')
        );

        if(!$category) {
            return $this->httpError(404,'That category was not found');
        }

        // menampilkan artikel yang kategoriID nya sama
        $this->articleList = $this->articleList->filter([
            'Categories.ID' => $category->ID
        ]);

        return [
            'SelectedCategory' => $category
        ];
    }

    // filter untuk region (menampilkan banyaknya artikel yang sesuai dgn region tsb)
    public function region (HTTPRequest $r)
    {
        $region = Region::get()->byID(
            $r->param('ID')
        );

        if(!$region) {
            return $this->httpError(404,'That region was not found');
        }

        // menampilkan artikel yang regionID nya sama
        $this->articleList = $this->articleList->filter([
            'RegionID' => $region->ID
        ]);

        return [
            'SelectedRegion' => $region
        ];
    }

    // filter untuk tanggal
    public function date(HTTPRequest $r)
    {
        $year = $r->param('ID');
        $month = $r->param('OtherID');

        if (!$year) return $this->httpError(404);

        $startDate = $month ? "{$year}-{$month}-01" : "{$year}-01-01";

        if (strtotime($startDate) === false) {
            return $this->httpError(404, 'Invalid date');
        }

        $adder = $month ? '+1 month' : '+1 year';
        $endDate = date('Y-m-d', strtotime(
            $adder, 
                strtotime($startDate)
        ));

        $this->articleList = $this->articleList->filter([
            'Date:GreaterThanOrEqual' => $startDate,
            'Date:LessThan' => $endDate 
        ]);

        return [
            'StartDate' => DBField::create_field('Datetime', $startDate),
            'EndDate' => DBField::create_field('Datetime', $endDate)
        ];
    }
}
?>