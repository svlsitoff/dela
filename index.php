<?php
error_reporting(-1);
require_once'connect.php';


?>
<!DOCTYPE html>
<html>
<head>
	<title>Список дел</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="add1">
    <form method="POST">
        <input type="text" name="description" placeholder="Описание задачи" value="<?=$values['description']?>" />
        <input type="submit" name="save" value="<?=$values['button']?>" />
    </form>
</div>
<div class="add2">
    <form method="POST">
        <label for="sort">Сортировать по:</label>
        <select name="sort_by">
            <option value="date_created">Дате добавления</option>
            <option value="is_done">Статусу</option>
            <option value="description">Описанию</option>
        </select>
        <input type="submit" name="sort" value="Отсортировать" />
    </form>
</div>
<div class="table">
<table>
    <tr>
        <th>Описание задачи</th>
        <th>Дата добавления</th>
        <th>Статус</th>
        <th></th>
    </tr>
 <?php foreach ($list as $key => $value):?>
<tr>
  <td><?= $value['description']?></td>
  <td><?= $value['date_added']?></td>
  <?php if ($value['is_done'] == true): ?>
        <td><span style='color: green;'>Выполнено</span></td>
        <?php else: ?>
         <td><span style='color: orange;'>В процессе</span></td>
         <?php endif; ?>
        <td>
          <a href='?id=<?php echo $value['id']; ?>&action=edit'>Изменить</a>
          <a href='?id=<?php echo $value['id']; ?>&action=done'>Выполнить</a>
          <a href='?id=<?php echo $value['id']; ?>&action=delete'>Удалить</a>
        </td>
    </tr>
 <?php endforeach; ?>
</table>
</div>
</body>
</html>