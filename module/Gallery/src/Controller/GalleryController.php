<?php

namespace Gallery\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Gallery\Model\GalleryTable;
use Gallery\Form\GalleryForm;
use Gallery\Model\Gallery;

class GalleryController extends AbstractActionController
{
    private $table;
    public function __construct(GalleryTable $table)
    {
        $this->table = $table;
    }


    public function indexAction()
    {
        return new ViewModel([
            'galleries' => $this->table->fetchAll(),
        ]);
    }

    public function addAction()
    {
        $form = new GalleryForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $album = new Gallery();
        $form->setInputFilter($album->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $album->exchangeArray($form->getData());
        $this->table->saveAlbum($album);
        return $this->redirect()->toRoute('gallery');
    }

    public function deleteAction()
    {
    }

    public function viewAction()
    {
    }
}
