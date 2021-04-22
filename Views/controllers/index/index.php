<h2>
  Задачи
  <a href="<?php echo $this->request->buildLink("tasks/create") ?>" class="btn btn-primary float-right">Создать задачу</a>
</h2>
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
          <td><?php echo $status ?></td>
          <td><?php echo $admin_status ?></td>
          <?php if($this->userLogged): ?>
          <td>
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