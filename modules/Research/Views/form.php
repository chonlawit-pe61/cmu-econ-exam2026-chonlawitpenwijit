<?php $this->extend('template/layout') ?>



<?php $this->section('content') ?>
<div class="container mt-5">
    <div>
        <h2>เพิ่มงานวิจัย</h2>
    </div>
    <form action="<?= base_url('research/saveResearch') ?>" method="post">
        <input type="hidden" name="id" id="id" value="<?= $research['id'] ?? '' ?>">
        <div class="row">
            <div class="col-lg-4">
                <div class="mb-3">
                    <label for="title" class="form-label">ชื่องานวิจัย</label>
                    <input type="text" class="form-control" id="title" placeholder="ชื่องานวิจัย" name="title" required value="<?= $research['title'] ?? '' ?>">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mb-3">
                    <label for="researcher_name" class="form-label">ชื่อผู้วิจัย</label>
                    <input type="text" class="form-control" id="researcher_name" placeholder="ชื่อผู้วิจัย" name="researcher_name" required value="<?= @$research['researcher_name'] ?>">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="mb-3">
                    <label for="researcher_name" class="form-label">ปีที่เผยแพร่</label>
                    <select onchange="checkTitle()" class="form-select" name="publication_year" aria-label="Default select example" id="publication_year">
                        <option value="">เลือกปีที่เผยแพร่</option>
                        <?php
                        $year = date('Y');
                        for ($retire_year = 2020; $retire_year <= $year; $retire_year++) {
                        ?>
                            <option value="<?php echo $retire_year; ?>" <?php if (@$research['publication_year'] == $retire_year) echo 'selected'; ?>><?php echo ($retire_year + 543); ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="mb-3">
                    <label for="status" class="form-label">สถานนะ</label>
                    <select class="form-select" name="status" aria-label="Default select example">
                        <option value="">เลือกสถานนะ</option>
                        <option value="0" <?= @$research['status'] == 0 ? 'selected' : '' ?>>draft </option>
                        <option value="1" <?= @$research['status'] == 1 ? 'selected' : '' ?>>published</option>
                    </select>
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
            <div class="col-lg-12">
                <div class="mb-3">
                    <label for="abstract" class="form-label">บทคัดย่อ</label>
                    <textarea class="form-control" name="abstract" id="abstract" required><?= @$research['abstract'] ?></textarea>
                </div>
            </div>
            <div class="col-lg-12 text-center">
                <button type="submit" class="btn btn-primary">บันทึก</button>
                <a href="<?= base_url('research') ?>" class="btn btn-secondary">ย้อนกลับ</a>
            </div>

        </div>
    </form>
</div>
<?php $this->endSection() ?>
<?php $this->section('scripts'); ?>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });

    const checkTitle = () => {
        const title = $('#title').val();
        const publication_year = $('#publication_year').val();
        $.ajax({
            url: '<?= base_url('research/checkTitle') ?>',
            type: 'POST',
            data: {
                title: title,
                publication_year: publication_year
            },
            success: function(response) {
                const res = JSON.parse(response);
                if (res.status == 'error') {
                    Swal.fire({
                        icon: "error",
                        title: "ชื่องานวิจัยนี้มีอยู่แล้ว",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        $('#title').val('');
                    })
                }
            }
        });
    }
</script>
<?php $this->endSection() ?>