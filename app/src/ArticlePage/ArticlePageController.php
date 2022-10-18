<?php
namespace SilverStripe\Lessons;

use PageController;

use SilverStripe\Forms\Form;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Control\Email\Email;
use SilverStripe\Security\Security;

class ArticlePageController extends PageController
{
    // whitelist fungsi komen agar bisa create data
    private static $allowed_actions = [
        'CommentForm',
    ];

    public function CommentForm()
    {
        $form = Form::create(
            $this, // Formulir harus dibuat oleh, dan ditangani oleh controller, controller ini yg dimaksud
            __FUNCTION__,
            // field yang menerima semua input user
            // FieldList::create(
            //     TextField::create('Name','')
            //         ->setAttribute('placeholder','Name*'),
            //     EmailField::create('Email','')
            //         ->setAttribute('placeholder','Email*'),
            //     TextareaField::create('Comment','')
            //         ->setAttribute('placeholder','Comment*')
            //     ),
            // field untuk tindakan form/action sebuah form (argumen pertama memanggil fungsi action untuk
            // submitnya), argumen dua untuk label button submitnya
            FieldList::create(
                FormAction::create('handleComment','Post Comment')
                    ->setUseButtonTag(true)
                    ->addExtraClass('btn btn-default-color btn-lg')
            ),
            // field yang wajib diisi
            RequiredFields::create('Name','Email','Comment')
        )->addExtraClass('form-style');

        foreach($form->Fields() as $field) {
            $field->addExtraClass('form-control')
                   ->setAttribute('placeholder', $field->getName().'*');
        }

        // mendapatkan data yang diinputkan user di form
        $data = $this->getRequest()->getSession()->get("FormData.{$form->getName()}.data");

        return $data ? $form->loadDataFrom($data) : $form;
    }

    // fungsi yang digunakan di function CommentForm() untuk create data di form
    public function handleComment($data, $form)
    {
        die();
        // mendapatkan data yang diinputkan user di form
        $session = $this->getRequest()->getSession();
        $session->set("FormData.{$form->getName()}.data", $data);

        // untuk mengidentifikasi apabila ada komen yang sama, maka akan dianggap sebagai spam
        $existing = $this->Comments()->filter([
            'Comment' => $data['Comment']
        ]);
        if($existing->exists() && strlen($data['Comment']) > 20) {
            $form->sessionMessage('That comment already exists! Spammer!','bad');

            return $this->redirectBack();
        }

        $comment = ArticleComment::create();
        $comment->ArticlePageID = $this->ID;
        $form->saveInto($comment);
        $comment->write();

        $session->clear("FormData.{$form->getName()}.data");
        $form->sessionMessage('Thanks for your comment!','good');

        // Testing Email send to papercut
        $link = "https://crosstechno.com/";
        $from = "rika@coba.com";
        $to = "Papercut@user.com";
        $subject = "Email from SilverStripe";
        $email = Email::create()
            ->setHTMLTemplate('Email\\MyCustomEmail')
            ->setData([
                'Member' => Security::getCurrentUser(),
                'Link'=> $link,
                'From' => $data['Name'],
                'EmailUser' => $data['Email'],
                'CommentUser' => $data['Comment']
            ])
            ->setFrom($from)
            ->setTo($to)
            ->setSubject($subject);

        if ($email->send()) {
            echo "Success";
        } else {
            echo "Error";
        }



        return $this->redirectBack();
    }
}
?>
