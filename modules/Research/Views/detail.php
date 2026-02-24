<?php $this->extend('template/layout') ?>



<?php $this->section('content') ?>
<div class="container">

    <div class="text-center mt-5">
        <h1>งานวิจัย</h1>
    </div>
    <?php
    if (empty($research['deleted_at']) && $research['status'] != 0) {
    ?>
        <div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">ชื่องานวิจัย</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= @$research['title'] ?>" readonly>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="researcher_name" class="form-label">ชื่อผู้วิจัย</label>
                        <input type="text" class="form-control" id="researcher_name" name="researcher_name" value="<?= @$research['researcher_name'] ?>" readonly>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="researcher_name" class="form-label">ประเภทงานวิจัย</label>
                        <input type="text" class="form-control" id="researcher_name" name="researcher_name" value="<?= @$research['research_type_name'] ?>" readonly>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="researcher_name" class="form-label">ปีที่เผยแพร่</label>
                        <input type="text" class="form-control" id="researcher_name" name="researcher_name" value="<?= @$research['publication_year'] + 543 ?>" readonly>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-3">
                        <label for="researcher_name" class="form-label">บทคัดย่อ</label>
                        <textarea class="form-control" id="researcher_name" name="researcher_name" readonly><?= @$research['abstract'] ?></textarea>
                    </div>
                </div>
                <div class="col-lg-12 text-center">
                    <a href="<?= base_url('research') ?>" class="btn btn-secondary">ย้อนกลับ</a>
                </div>

            </div>
        </div>
    <?php
    } else {
    ?>
        <div>
            <div class="text-center mt-5">
                <h1>ไม่พบข้อมูล</h1>
            </div>
            <div class="col-lg-12 text-center">
                <a href="<?= base_url('research') ?>" class="btn btn-secondary">ย้อนกลับ</a>
            </div>
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