<?php


namespace App\models;

use App\core\Application;
use Krugozor\Database\Mysql\Mysql;

class EntryModel
{
    public function getList($page = 1, $sortDirection = 'asc', $sortBy)
    {
        $limit = 3;
        $offset = $limit * ($page - 1);
        /* @var $db Mysql */
        $db = Application::$container->get('db');
        $sorting = $sortBy ? "ORDER BY $sortBy $sortDirection" : null;
        $result = $db->query("SELECT * FROM `entries` $sorting LIMIT $limit OFFSET $offset");

        return $result->fetch_assoc_array();
    }

    public function getCount()
    {
        /* @var $db Mysql */
        $db = Application::$container->get('db');

        return $db->query("SELECT COUNT(id) FROM `entries`")->fetch_row()[0];
    }

    public function getItem($id)
    {
        /* @var $db Mysql */
        $db = Application::$container->get('db');
        $result = $db->query("SELECT * FROM `entries` WHERE id = $id");

        return $result->fetch_assoc();
    }

    public function create($name, $email, $task)
    {
        /* @var $db Mysql */
        $db = Application::$container->get('db');

        $entry = [
            'name' => $name,
            'email' => $email,
            'task' => $task
        ];

        $db->query('INSERT INTO `entries` SET ?As', $entry);

    }

    public function updateItem($id, $task, $status)
    {
        /* @var $db Mysql */
        $db = Application::$container->get('db');

        $entry = [
            'task' => $task,
            'status' => boolval($status),
        ];

        $item = $this->getItem($id);
        if (isset($item) && !$item['is_edit']) {
            if ($item['task'] !== $task) {
                $entry['is_edit'] = 1;
            }
        }

        $db->query("UPDATE `entries` SET ?As WHERE id = $id", $entry);
    }
}
