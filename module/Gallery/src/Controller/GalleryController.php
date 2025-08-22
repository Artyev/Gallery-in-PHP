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

        $gallery = new Gallery();
        $form->setInputFilter($gallery->getInputFilter());
        $form->setData($request->getPost());
        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $gallery->exchangeArray($form->getData());
        $this->table->saveGallery($gallery);
        return $this->redirect()->toRoute('gallery');
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (! $id) {
            return $this->redirect()->toRoute('gallery');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->table->deleteGallery($id);
            }
            return $this->redirect()->toRoute('gallery');
        }
        return [
            'id'    => $id,
            'gallery' => $this->table->getGallery($id),
        ];
    }

    public function viewAction()
    {
    }
}
