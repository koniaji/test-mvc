<div class="row">
    <div class="container">
        <div class="col-md-12">
            <form method="post">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Task</label>
                    <textarea name="task"
                              class=" form-control"
                              id="exampleFormControlTextarea1"
                              rows="3"><?= $item['task'] ?></textarea>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="status" class="form-check-input" id="status"
                        <?= $item['status'] ? 'checked' : null ?>>
                    <label class="form-check-label" for="status">Status</label>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
