<?php
$tab_title = 'add work ';
require_once('./includes/header.php');
?>
<div class="row justify-content-center">
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Add Service</h5>
            </div>
            <?php
            if (isset($_SESSION['success'])) : ?>
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading"><?= $_SESSION['success'] ?></h4>
                </div>
            <?php
            endif;
            unset($_SESSION['success']);
            ?>
            <div class="card-body">
                <form action="./work_data.php" method="post" enctype="multipart/form-data">
                    <div class="example-container">
                        <div class="example-content">
                            <label for=""> work title</label>
                            <input type="text" class="form-control form-control-rounded m-b-sm" placeholder="service title" name="work_title">
                        </div>
                        <div class="example-content">
                            <label for=""> work heading</label>
                            <input type="text" class="form-control form-control-rounded m-b-sm" placeholder="service title" name="work_heading">
                        </div>
                        <div class="example-content">
                            <label for=""> work description</label>
                            <textarea cols="30" rows="5" class="form-control form-control-rounded m-b-sm" name="work_description"></textarea>
                        </div>
                        <div class="example-content">
                            <label for=""> work image</label>
                            <input type="file" class="form-control form-control-rounded m-b-sm" placeholder="service title" name="work_image">
                        </div>
                        <div class="example-content">
                            <label for=""> work status</label>
                            <select name="work_status" >
                                <option value="active">active</option>
                                <option value="inactive">inactive</option>
                            </select>
                        </div>
                        <div class="example-content d-block">
                            <button class="btn btn-primary " name="add_work">add Work</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
require_once('./includes/footer.php');
?>