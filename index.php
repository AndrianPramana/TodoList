<?php
    // Proses insert data ke database
    include "koneksi.php";
    if(isset($_POST['add'])){
        $query = "insert into tugas(task_label,task_status) value ( '".$_POST['task']."','open')";
        $run_query = mysqli_query($conn, $query);

        if($run_query){
            header('Refresh:0; url=index.php');
        }
    }

    // proses show data
    $q_select = "select * from tugas order by task_id desc";
    $run_q_select = mysqli_query($conn, $q_select);

    // proses delete data
    if(isset($_GET['delete'])){
        $q_delete = "delete from tugas where task_id ='".$_GET['delete']."' ";
        $run_q_delete = mysqli_query($conn, $q_delete);
        header('Refresh:0; url=index.php');
    }

    // proses update data (close or open)
    if(isset($_GET['done'])){
        $status = 'close';

        if($_GET['status'] == 'open'){
            $status = 'close';
        }else{
            $status = 'open';
        }
        
        $q_update = "update tugas set task_status = '".$status."' where task_id = '". $_GET['done']."'";
        $run_q_update = mysqli_query($conn, $q_update);
        header('Refresh:0; url=index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TodoList</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style/style.css" type="text/css">
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="title">
                <i class='bx bx-sun'></i>
                <span>TO DO LIST</span>
            </div>
            <div class="description">
                <?= date("l, d M Y") ?>
            </div>
        </div>


        <div class="content">
            <div class="card">
                <form action="" method="POST">
                    <input type="text" name="task" class="input-control" placeholder="Tambah Tugas">
                    <div class="button-right">
                        <button type="submit" name="add">Tambah</button>
                    </div>
                </form>
            </div>

            <?php
                if(mysqli_num_rows($run_q_select) > 0){
                    while($r = mysqli_fetch_array($run_q_select)){
            ?>
            <div class="card">
                <div class="task-item <?= $r['task_status'] == 'close' ? 'done':''?>">
                    <div>
                        <input type="checkbox" onclick="window.location.href = '?done=<?=$r['task_id'] ?>&status=<?= $r['task_status'] ?>'" <?= $r['task_status'] == 'close' ? 'checked': '' ?>>
                        <span><?= $r['task_label']?></span>
                    </div>
                    <div>
                        <a href="edit.php?id=<?= $r['task_id'] ?>" class="text-edit" title="Sunting"><i class="bx bx-edit"></i></a>
                        <a href="?delete=<?= $r['task_id']?>" class="text-delete" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus?')"><i class="bx bx-trash"></i></a>
                    </div>
                </div>
            </div>
            <?php }} else { ?>
                <div>Belum ada task</div>
            <?php } ?>

        </div>

    </div>
</body>

</html>