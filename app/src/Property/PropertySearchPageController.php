<?php
namespace SilverStripe\Lessons;

use PageController;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FormAction;
use SilverStripe\ORM\ArrayLib;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\ORM\PaginatedList;
use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;
use SilverStripe\Control\HTTP;

class PropertySearchPageController extends PageController
{

    // fungsi untuk menampilkan model Property ke halaman index sejumlah 20 item saja
    public function index(HTTPRequest $request)
    {
        // mengembalikan DataList bukan PaginatedList
        // $properties = Property::get()->limit(20);

        $properties = Property::get();
        $activeFilters = ArrayList::create();

        // untuk emncocokkan Keywords dengan judul
        // PartialMatch hanya memeriksa urutan karakter di bidang (tidak peka huruf besar-kecil).
        // Itu tidak akan melakukan transformasi bahasa atau mengurai frase.
        if ($search = $request->getVar('Keywords')) {
            $activeFilters->push(ArrayData::create([
                'Label' => "Keywords: '$search'",
                'RemoveLink' => HTTP::setGetVar('Keywords', null, null, '&'),
            ]));

            $properties = $properties->filter([
                'Title:PartialMatch' => $search
            ]);
        }

        // membuat filter untuk AvailableStart dan AvailableEnd.
        if ($arrival = $request->getVar('ArrivalDate')) {
            $arrivalStamp = strtotime($arrival);
            $nightAdder = '+'.$request->getVar('Nights').' days';
            $startDate = date('Y-m-d', $arrivalStamp);
            $endDate = date('Y-m-d', strtotime($nightAdder, $arrivalStamp));

            $properties = $properties->filter([
                'AvailableStart:LessThanOrEqual' => $startDate,
                'AvailableEnd:GreaterThanOrEqual' => $endDate
            ]);

        }

        foreach($filters as $filterKeys) {
            list($getVar, $field, $filter, $labelTemplate) = $filterKeys;
            if ($value = $request->getVar($getVar)) {
                $activeFilters->push(ArrayData::create([
                    'Label' => sprintf($labelTemplate, $value),
                    'RemoveLink' => HTTP::setGetVar($getVar, null, null, '&'),
                ]));

                $properties = $properties->filter([
                    "{$field}:{$filter}" => $value
                ]);
            }
        }

        $filters = [
            ['Bedrooms', 'Bedrooms', 'GreaterThanOrEqual', '%s bedrooms'],
            ['Bathrooms', 'Bathrooms', 'GreaterThanOrEqual', '%s bathrooms'],
            ['MinPrice', 'PricePerNight', 'GreaterThanOrEqual', 'Min. $%s'],
            ['MaxPrice', 'PricePerNight', 'LessThanOrEqual', 'Max. $%s'],
        ];

        // mengembalikan PaginatedList bukan DataList(lihat komentar di atas)
        $paginatedProperties = PaginatedList::create(
            $properties,
            $request
        // untuk menampilkan berapa item yang akan ditampilkan ke halaman index
        )->setPageLength(4)
        // parameter yang ada di URL(s=4), 4 adalah jumlah item yang ditampilkan (->setPageLength(4))
        ->setPaginationGetVar('s');

        // array data
        $data = array (
            'Results' => $paginatedProperties,
            'ActiveFilters' => $activeFilters
        );

        // untuk mendeteksi Ajax(saat klik icon tanda panah pagination)
        if($request->isAjax()) {
            return $this->customise($data)
                        ->renderWith('Includes/PropertySearchResults');
        }

        return $data;
    }

    public function PropertySearchForm()
    {
        $nights = [];
        foreach(range(1,14) as $i) {
            $nights[$i] = "$i night" . (($i > 1) ? 's' : '');
        }
        $prices = [];
        // foreach(range(100, 1000, 50) as $i) {
        //     $prices[$i] = '$'.$i;
        // }

        $form = Form::create(
            $this, // Formulir harus dibuat oleh, dan ditangani oleh controller, controller ini yg dimaksud
            'PropertySearchForm',
            FieldList::create(
                // field yang menerima semua input user
                TextField::create('Keywords')
                    ->setAttribute('placeholder', 'City, State, Country, etc...')
                    ->addExtraClass('form-control'),
                TextField::create('ArrivalDate','Arrive on...')
                    ->setAttribute('data-datepicker', true)
                    ->setAttribute('data-date-format', 'DD-MM-YYYY')
                    ->addExtraClass('form-control'),
                DropdownField::create('Nights','Stay for...')
                    ->setSource($nights)
                    ->addExtraClass('form-control'),
                DropdownField::create('Bedrooms')
                    ->setSource(ArrayLib::valuekey(range(1,5)))
                    ->addExtraClass('form-control'),
                DropdownField::create('Bathrooms')
                    ->setSource(ArrayLib::valuekey(range(1,5)))
                    ->addExtraClass('form-control'),
                DropdownField::create('MinPrice','Min. price')
                    ->setEmptyString('-- any --')
                    ->setSource($prices)
                    ->addExtraClass('form-control'),
                DropdownField::create('MaxPrice','Max. price')
                    ->setEmptyString('-- any --')
                    ->setSource($prices)
                    ->addExtraClass('form-control')
            ),
            // field untuk tindakan form/action sebuah form (argumen pertama memanggil fungsi action untuk
            // submitnya), argumen dua untuk label button submitnya
            FieldList::create(
                FormAction::create('doPropertySearch','Search')
                    ->addExtraClass('btn-lg btn-fullcolor')
            )
        );

        // menggunakan method GET untuk mendapatkan hasil pencarian yang diinputkan user
        $form->setFormMethod('GET')
             // untuk memastikan formulir tidak mengirim request/datanya ke handler(doPropertySearch)
             // hanya mengarahkan ke tampilan default controller.
             ->setFormAction($this->Link())
             // untuk menghapus token keamanan di URL(SecurityID) yang berfungsi untuk menggagalkan
             // serangan CSRF (Cross-Site Request Forgery), tetapi karena ini adalah GET bentuk yang
             // sederhana, maka tidak memerlukannya
             ->disableSecurityToken()
             // agar data setelah disubmit untuk filter tidak hilang di formnya(session)
             ->loadDataFrom($this->request->getVars());

        return $form;
    }
}
?>
