<?php


namespace App\controllers;


use App\core\Application;
use App\core\Controller;
use App\models\EntryModel;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function actionIndex()
    {
        /* @var $request Request */
        $request = Application::$container->get('request');
        $entruModel = new EntryModel();
        $items = $entruModel->getList(
            $request->get('page', 1),
            $request->get('sort'),
            $request->get('sortBy')
        );
        $count = $entruModel->getCount();

        return $this->view->render(APP_DIR . '/views/task/index.php', [
            'items' => $items,
            'currentPage' => $request->get('page'),
            'totalPages' => ceil($count / 3),
        ]);
    }

    public function actionCreate()
    {
        /* @var $request Request */
        $request = Application::$container->get('request');

        if ($request->method() === "POST") {
            (new EntryModel())->create(
                $request->post('name'),
                $request->post('email'),
                $request->post('task')
            );
        }

        return $this->view->render(APP_DIR . '/views/task/create.php');
    }

    public function actionEdit()
    {
        $user = Application::$container->get('user');

        if (!$user->getId()) {
            header("Location: http://" . $_SERVER['HTTP_HOST'] . '/auth/login');
            return false;
        }

        /* @var $request Request */
        $request = Application::$container->get('request');
        $entryModel = new EntryModel();
        if ($request->method() === "POST") {
            $entryModel->updateItem(
                $request->get('id'),
                $request->post('task'),
                $request->post('status')
            );
        }

        $item = $entryModel->getItem($request->get('id'));

        return $this->view->render(APP_DIR . '/views/task/edit.php', ['item' => $item]);
    }
}
