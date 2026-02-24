<?php $this->extend('template/layout') ?>



<?php $this->section('content') ?>
<div class="container">

    <div class="text-end">
        <a href="<?= base_url('research/create') ?>" class="btn btn-success">
            เพิ่มงานวิจัย
        </a>
    </div>
    <div class="text-center">
        <h1> ค้นหา</h1>
    </div>
    <div>
        <form action="" method="get">
            <div class="row justify-content-center">
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="researcher_name" class="form-label">ชื่อผู้วิจัย</label>
                        <input type="text" class="form-control" id="Title" placeholder="ชื่อผู้วิจัย" name="Title" value="">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="researcher_name" class="form-label">ประเภทงานวิจัย</label>
                        <select class="form-select" name="research_type" aria-label="Default select example">
                            <option value="">เลือกประเภทงานวิจัย</option>
                            <?php
                            if (!empty($getResearchType)) {
                                foreach ($getResearchType as $key => $value) {
                            ?>
                                    <option value="<?= $value['id'] ?>" <?= @$research['research_type'] == $value['id'] ? 'selected' : '' ?>><?= $value['name'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 text-center">
                    <button class="btn btn-success">ค้นหา</button>
                    <?php
                    if (!empty($_GET['Title']) || !empty($_GET['research_type'])) {
                    ?>
                        <a href="<?= base_url('research') ?>" class="btn btn-warning">ล้างค่า</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </form>
    </div>
    <?php
    if (!empty($research)) {
    ?>
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th class="text-center" style="width: 10%;">ลำดับ</th>
                    <th class="text-center">ชื่องานวิจัย</th>
                    <th class="text-center">ชื่อผู้วิจัย</th>
                    <th class="text-center">ปีที่เผยแพร่</th>
                    <th class="text-center">ประเภทงานวิจัย</th>
                    <th class="text-center" style="width: 15%;">เครื่องมือ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($research)) {
                    foreach ($research as $row) {
                ?>
                        <tr>
                            <td class="text-center"><?= $row['id'] ?></td>
                            <td><?= $row['title'] ?></td>
                            <td><?= $row['researcher_name'] ?></td>
                            <td class="text-center"><?= $row['publication_year'] + 543 ?></td>
                            <th class="text-center"><?= $row['research_type_name'] ?></th>
                            <td class="text-center">
                                <a href="<?= base_url('research/' . $row['id']) ?>" class="btn btn-info">ดู</a>
                                <a href="<?= base_url('research/edit/' . $row['id']) ?>" class="btn btn-warning">แก้ไข</a>
                                <button onclick="deleteResearch('<?= $row['id'] ?>')" class="btn btn-danger ">ลบ</button>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    <?php
    } else {
    ?>
        <div class="text-center mt-5">
            ไม่พบข้อมูล
        </div>
    <?php
    }
    ?>
</div>
<?php $this->endSection() ?>
<?php $this->section('scripts'); ?>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });

    const deleteResearch = (id) => {
        Swal.fire({
            title: "ยืนยันการลบข้อมูล?",
            text: "คุณต้องการลบข้อมูลนี้หรือไม่?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ยืนยันการลบ"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('research/deleteResearch') ?>",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: "success",
                            title: "ลบข้อมูลสำเร็จ",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload();
                        })
                    }
                });
            }
        });
    }
</script>
<?php $this->endSection() ?>