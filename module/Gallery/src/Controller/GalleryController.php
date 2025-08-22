<?php

namespace Gallery\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Gallery\Model\GalleryTable;

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
        $request = $this->getRequest();
        if ($request->isPost()) {
            $files = $this->params()->fromFiles();
            $photo = $files['photo'] ?? null;
            if ($photo && $photo['error'] === UPLOAD_ERR_OK) {
                $allowedTypes = [
                    'image/jpeg',
                    'image/png',
                    'image/gif',
                    'image/webp',
                    'image/avif',
                    'image/bmp',
                    'image/vnd.microsoft.icon'
                ];
                $tmpName = $photo['tmp_name'];
                $mimeType = mime_content_type($tmpName);
                if (! in_array($mimeType, $allowedTypes)) {
                    return $this->redirect()->toRoute('gallery');
                }

                $originalName = $photo['name'];
                $name = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $originalName);

                $imageInfo = getimagesize($tmpName);
                list($width, $height, $type) = $imageInfo;
                $size = filesize($tmpName);
                $mime = image_type_to_mime_type($type);

                $uploadDir = './public/uploads/';
                if (! is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $targetPath = $uploadDir . $name;
                move_uploaded_file($tmpName, $targetPath);

                $gallery = new \Gallery\Model\Gallery();
                $gallery->exchangeArray([
                    'id' => 0,
                    'name' => $originalName,
                    'path' => '/uploads/' . $name,
                    'type' => $mime,
                    'size' => $size,
                    'width' => $width,
                    'height' => $height,
                ]);

                $this->table->saveGallery($gallery);

                return $this->redirect()->toRoute('gallery');
            } else {
                return $this->redirect()->toRoute('gallery');
            }
        }


        return [];
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
        $id = (int) $this->params()->fromRoute('id', 0);

        if (! $id) {
            return $this->redirect()->toRoute('gallery');
        }

        try {
            $gallery = $this->table->getGallery($id);
        } catch (\RuntimeException $e) {
            return $this->redirect()->toRoute('gallery');
        }

        return ['gallery' => $gallery];
    }
}
