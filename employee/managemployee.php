<?php
session_start();
if (!$_SESSION['empid']) {
    header("Location: login.php");
}
include "./menu.php";
require('./config/config.php');
?>
<?php

$empid = $_SESSION['empid'];
$sqlEmp = "SELECT * FROM employee WHERE empid='$empid' ";
$resultsqlEmp = mysqli_query($conn, $sqlEmp);
$num_rows = mysqli_num_rows($resultsqlEmp);
$rowsqlEmp = mysqli_fetch_array($resultsqlEmp);
$empname = $rowsqlEmp["empname"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <title>ตารางจัดการข้อมูลประเภทสินค้า <?php echo $empname; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03typeR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1typeK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
</head>
<style>
    .card-body {
        flex: 1 1 auto;
        padding: 2rem 2rem;
    }

    ol,
    ul {
        padding-left: 0rem;
    }
</style>

<body>
    <?php if (isset($_SESSION["process_success"])) : ?>
        <div class="alert alert-success">
            <?php echo $_SESSION["process_success"];
            unset($_SESSION["process_success"]);
            ?>

        </div>
    <?php elseif (isset($_SESSION["process_error"])) : ?>
        <div class="alert alert-danger">
            <?php echo $_SESSION["process_error"];
            unset($_SESSION["process_error"]);
            ?>
        </div>
    <?php endif ?>
    <section class="home-section justify-center">
        <div class="card">
            <div class="card-body">
                <h3>จัดการข้อมูลพนักงาน
                    <button type="button" class="btn btn-success" data-bs-toggle='modal' data-bs-target="#insertModal">
                        เพิ่มข้อมูลพนักงาน
                    </button>
                </h3>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>รหัสพนักงาน</th>
                                <th>ชื่อพนักงาน</th>
                                <th>อีเมล</th>
                                <th>เบอร์โทร</th>
                                <th>ที่อยู่</th>
                                <th>แก้ไข</th>
                                <th>ลบ</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                                <td>
                                    <a href='./edit-furtypes.php?furtype_id=<?php echo $row['furtype_id']; ?>'>
                                        <button type='button' class='btn btn-warning edit_btn' style='margin-right: 5px;'>
                                            <i class='bx bx-edit'></i>
                                        </button>
                                    </a>
                                </td>
                                <td>
                                    <a href='?action=delete&furtype_id=<?php echo $row['furtype_id']; ?>'>
                                        <button type='button' class='btn btn-danger'>
                                            <i class='bx bx-eraser'></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'delete') {
        $furtype_id = $_GET['furtype_id'];
        echo "<script>";
        echo "
        Swal.fire({
            title: 'คุณต้องการลบ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#138D75 ',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'furtypes.php?action=confirm&furtype_id=" . $furtype_id . "'
            }else{
                window.location.href = 'furtypes.php'
            }
        })
        ";
        echo "</script>";
    }
    if (isset($_GET['action']) && $_GET['action'] == 'confirm') {
        $furtype_id = $_GET['furtype_id'];
        $sql = "DELETE FROM `furnituretype` WHERE `furtype_id`='$furtype_id'";
        $rs = mysqli_query($conn, $sql);
        if ($rs) {
            echo "<script>
                Swal.fire({
                    title: 'ลบสำเร็จ',
                    icon: 'success',
                    confirmButtonColor: '#138D75 ',    
                    confirmButtonText: 'ตกลง',
                }).then(function() {
                    window.location = 'furtypes.php';
                });
                </script>";
        }
    }
    ?>
</body>
<script>
    $(document).ready(function() {
        $("#myTable").DataTable({
            "language": {
                "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด",
                "search": " ค้นหา : ",
                "zeroRecords": "ไม่พบข้อมูลที่ค้นหา",
                "info": "แสดงผลลัพธ์ _PAGE_ จาก _PAGES_ หน้า",
                "infoEmpty": "ไม่พบตารางที่ค้นหา",
                "infoFiltered": "(ค้นหาจากทั้งหมด_MAX_ตาราง)",
                "searchPlaceholder": "",
                "paginate": {
                    "previous": "ก่อนหน้า",
                    "next": "หน้าถัดไป",

                }
            }
        });
    });
</script>

</html>