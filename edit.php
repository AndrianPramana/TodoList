<?php
    // Proses insert data ke database
    include "koneksi.php";

   // select data yang akan diedit
	$q_select = "select * from tugas where task_id = '".$_GET['id']."' ";
	$run_q_select = mysqli_query($conn, $q_select);
	$d = mysqli_fetch_object($run_q_select);

	// proses edit data
	if(isset($_POST['edit'])){

		$q_update = "update tugas set task_label = '".$_POST['task']."' where task_id = '".$_GET['id']."' ";
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
                <a href="index.php"><i class='bx bx-chevron-left'></i></a>
                <span>Kembali</span>
            </div>
            <div class="description">
                <?= date("l, d M Y") ?>
            </div>
        </div>


        <div class="content">
            <div class="card">
                <form action="" method="POST">
                    <input type="text" name="task" class="input-control" placeholder="Sunting tugas" value="<?= $d->task_label ?>">
                    <div class="button-right">
                        <button type="submit" name="edit">Sunting</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</body>

</html>