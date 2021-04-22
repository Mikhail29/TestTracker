<h2>Создание задачи</h2>
<form method="post">
  <div class="form-group">
    <label for="username">Имя пользователя</label>
    <input type="text" required  class="form-control" name="username" id="username">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" required class="form-control" name = "email" id="email">
  </div>
  <div class="form-group">
    <label for="content">Текст задачи</label>
    <textarea class="form-control" required name="content" id="content" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Создать</button>
</form>