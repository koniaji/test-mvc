<?php

use App\core\Application;

function createPageUrl($pageNumber)
{
    $request = Application::$container->get('request');
    $url = '/?';
    $items = $request->query();
    $items['page'] = $pageNumber;
    foreach ($items as $key => $item) {
        $url .= $key . '=' . $item . '&';
    }

    return trim($url, '&');
}

function createSortUrl($sort)
{
    $request = Application::$container->get('request');
    $url = '/?';
    $items = $request->query();
    $items['sortBy'] = $sort;
    $items['sort'] = $items['sort'] === 'asc' ? 'desc' : 'asc';
    foreach ($items as $key => $item) {
        $url .= $key . '=' . $item . '&';
    }

    return trim($url, '&');
}

$user = Application::$container->get('user');
?>
<div class="row">
    <div class="container">
        <div class="col-md-12">
            <p></p>
            <a href="/index/create">
                <button class="btn btn-info">Create</button>
            </a>
            <p></p>
            <div style="min-height: 230px">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><a href="<?= createSortUrl('name') ?>">Name</a></th>
                        <th scope="col"><a href="<?= createSortUrl('email') ?>">Email</a></th>
                        <th scope="col">Task</th>
                        <th scope="col"><a href="<?= createSortUrl('status') ?>">Status</a></th>
                        <?php if ($user->getId()): ?>
                            <th scope="col">Control</th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <th scope="row"><?= $item['id'] ?></th>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td><?= htmlspecialchars($item['email']) ?></td>
                            <td><?= htmlspecialchars($item['task']) ?></td>
                            <td>
                                <?= $item['is_edit'] ? '<div class="btn btn-info btn-sm">Edited</div>' : null ?>
                                <?= $item['status'] ? '<div class="btn btn-success btn-sm">Completed</div>' :
                                    '<div class="btn btn-warning btn-sm">Not completed</div>' ?>
                            </td>
                            <?php if ($user->getId()): ?>
                                <td><a href="<?= "/index/edit?id=" . $item['id'] ?>">Edit</a></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php if ($totalPages > 1): ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php if ($currentPage > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= createPageUrl($currentPage - 1) ?>"
                                   aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php for ($i = $currentPage - 2; $i < ($currentPage + 3); $i++): ?>
                            <?php if ($i <= $totalPages && $i > 0): ?>
                                <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= createPageUrl($i) ?>"><?= $i ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endfor; ?>
                        <?php if ($currentPage != $totalPages): ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= createPageUrl($currentPage + 1) ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>
</div>
