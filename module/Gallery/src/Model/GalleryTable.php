<?php

namespace Gallery\Model;

use RuntimeException;
use Laminas\Db\TableGateway\TableGatewayInterface;

class GalleryTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getGallery($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function Gallery(Gallery $gallery)
    {
        $data = [
            'name' => $gallery->name,
            'type'  => $gallery->type,
            'size'  => $gallery->size,
            'width'  => $gallery->width,
            'height'  => $gallery->height,
            'uploadtime'  => $gallery->uploadtime,
        ];

        $id = (int) $gallery->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        try {
            $this->getGallery($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Cannot update gallery with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteGallery($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}
