<?php

require_once('../model/Publisher.php');
require_once('../service/PublisherService.php');
require_once('../phpconnectmongodb.php');

class PublisherController
{
    private $publisherService;

    public function __construct()
    {
        $this->publisherService = new publisherService();
    }

    public function getAllPublisher()
    {
        return $this->publisherService->getAll();
    }

    public function getPublisherById($id)
    {
        return $this->publisherService->findOneByID($id);
    }

    public function deletePublisherById($id)
    {
        header('Location:../view/list-publisher.php');
        return $this->publisherService->delete($id);
    }

    public function updatePublisherById($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array(
                'publisherName' => ($_POST['publisherName']),
            );
            header('Location:../view/list-publisher.php');

            return  $this->publisherService->update($id, $data);
        }
    }

    public function createPublisher()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array(
                'publisherName' => ($_POST['publisherName']),

            );
            header('Location:../view/list-publisher.php');
            return  $this->publisherService->create($data);
        }
    }
}
