<h2>Редактирование задачи</h2>
<form method="post">
  <div class="form-group">
    <label for="username">Имя пользователя</label>
    <input type="text" required  class="form-control" name="username" id="username" value="<?php echo $this->template->task["username"] ?>" autocomplete="off">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" autocomplete="off" required class="form-control" name = "email" id="email" value="<?php echo $this->template->task["email"] ?>">
  </div>
  <div class="form-group">
    <label for="content">Текст задачи</label>
    <textarea class="form-control" autocomplete="off" required name="content" id="content" rows="3"><?php echo $this->template->task["content"] ?></textarea>
  </div>
  <div class="form-check">
    <input type="checkbox" name="status"<?php echo $this->template->task["status"] == 1 ? " checked" : "" ?> class="form-check-input" id="status">
    <label class="form-check-label" for="status">Выполнена</label>
  </div>
  <button type="submit" class="btn btn-primary">Сохранить</button>
</form>