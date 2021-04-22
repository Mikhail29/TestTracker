<h2>
  Задачи
  <a href="<?php echo $this->request->buildLink("tasks/create") ?>" class="btn btn-primary float-right">Создать задачу</a>
</h2>
<div>
  <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownSortButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Сортировать
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownSortButton">
      <a class="dropdown-item" href="<?php echo $this->request->buildLink("?sort=username&order=asc") ?>">По имени пользователя(по возростанию)</a>
      <a class="dropdown-item" href="<?php echo $this->request->buildLink("?sort=username&order=desc") ?>">По имени пользователя(по убыванию)</a>
      <a class="dropdown-item" href="<?php echo $this->request->buildLink("?sort=username&order=asc") ?>">По email(по возростанию)</a>
      <a class="dropdown-item" href="<?php echo $this->request->buildLink("?sort=username&order=desc") ?>">По email(по убыванию)</a>
      <a class="dropdown-item" href="<?php echo $this->request->buildLink("?sort=status&order=asc") ?>">По статусу(по возростанию)</a>
      <a class="dropdown-item" href="<?php echo $this->request->buildLink("?sort=status&order=desc") ?>">По статусу(по убыванию)</a>
    </div>
  </div>
</div>
<div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Имя пользователя</th>
          <th scope="col">Email</th>
          <th scope="col">Текст задачи</th>
          <th scope="col">Отредактирована администратором?</th>
          <th scope="col">Выполнена?</th>
          <?php if($this->userLogged): ?>
          <th scope="col">Действия</th>
          <?php endif; ?>
        </tr>
      </thead>
      <tbody>
        <?php
        if(count($this->template->tasks) > 0)
        {
        foreach($this->template->tasks as $task)
        {
          $status = $task->status == 1 ? "Да" : "Нет";
          $admin_status = $task->admin_edit == 1 ? "Да" : "Нет";
          ?>
        <tr>
          <td><?php echo $task->username ?></td>
          <td><?php echo $task->email ?></td>
          <td><pre><?php echo $task->content ?></pre></td>
          <td><?php echo $admin_status ?></td>
          <td><?php echo $status ?></td>
          <?php if($this->userLogged): ?>
          <td>
            <a href="<?php echo $this->request->buildLink("tasks/edit/".$task->id) ?>">Редактировать</a>
            <a href="<?php echo $this->request->buildLink("tasks/delete/".$task->id) ?>">Удалить</a>
            </td>
          <?php endif; ?>
        </tr>
          <?php
        }
        }
        else 
        {
        ?>
        <tr>
          <td colspan="<?php echo $this->userLogged ? "6" : "5" ?>">Задач не найдено</td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
</div>
<?php echo $this->template->paginator ?>