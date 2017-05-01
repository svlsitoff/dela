<?php
require_once 'data_base.php';
$dbase = new data_base;
$list = $dbase->show("SELECT * FROM `tasks`");

if(isset($_POST['description']))
	 {
	 $_POST['description'] = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
	 }else
	 {
	 $_POST['description'] = '';
	 }
$values = ['description' => $_POST['description'], 'button' => 'Добавить'];
if(isset($_GET['id'])&&is_numeric($_GET['id']))
	{ 
	 $id =$_GET['id'];
	}
if(isset($_GET['action'])&&$_GET['action'] === 'edit')
    {
        $sql = $dbase->show("SELECT `description` FROM `tasks` WHERE `id` = " . $id);
        $values = ['description' => $sql[0]['description'], 'button' => 'Изменить'];
    }
if (!empty($_POST['save'])) 
	{  
        if(!empty($_POST['description']))
        {   
            if(isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id']))
            {
             $sqlupdate = "UPDATE `tasks` SET `description` = '" . $_POST['description'] . "' WHERE `id` = " . $id;
            $dbase->exec($sqlupdate);
            header('Location:index.php');
            }else{
        	$time = date('Y-m-d H:i:s');
            $value_for_save = "('" . $_POST['description'] . "',0,'" . $time . "')";
            $save = "INSERT INTO `tasks` (`description`,`is_done`,`date_added`) VALUES ".$value_for_save;
            $dbase->exec($save);
            header('Location:index.php');
            }
        }
    }


if(isset($_POST['sort_by']))
	{
		if($_POST['sort_by']==='date_added'||
		   $_POST['sort_by']==='is_done'||
		   $_POST['sort_by']==='description')
			{
			$list = $dbase->show("SELECT * FROM `tasks` ORDER BY" . "`" . $_POST['sort_by'] . "`");	
			}else{
			$list = $dbase->show("SELECT * FROM `tasks`");
			}
	}
if (isset($_GET['action']) && isset($_GET['id']))
 {
    if ($_GET['action'] === 'done') 
    {
        $dbase->exec( "UPDATE `tasks` SET `is_done` = 1 WHERE `id` = " . $id);
        header('Location:index.php');
    }
    if ($_GET['action'] === 'delete') 
    {
        $dbase->exec("DELETE FROM `tasks` WHERE `id` =" . $id);
        header('Location:index.php');
    }
   
}