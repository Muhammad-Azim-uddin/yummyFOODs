<?php
include '../include/backendHeader.php';
include '../database/env.php';

$query = "SELECT * FROM categories";
$res = mysqli_query($conn, $query);
if ($res) {
    $categories = mysqli_fetch_all($res, 1);
}
?>
<div class="row">
    <div class="col-lg-11 m-auto">
        <h1>Food Section</h1>
        <div class="row">
            <div class="col-lg-7">
                <div class="card shadow">
                    <div class="card-body">
                        <table class="table text-center table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th style="width:150px;">Actions</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($categories as $index => $category) {
                                ?>
                                    <tr>
                                        <td><?= ++$index ?></td>
                                        <td><?= $category['title'] ?? '' ?></td>
                                        <td>Image</td>
                                        <td class="btn-group">
                                            <a href="./category.php?id=<?= $category['id'] ?>&title=<?= $category['title'] ?>" type="button" class="btn btn-primary btn-sm">Edit</a>
                                            <a href="../controller/deleteAbout.php?id=<?= $category['id'] ?? '' ?>" type="button" class="btn btn-warning btn-sm">Delete</a>
                                        </td> 
                                        <td>Price</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card shadow-sm">
                    <div class="card-header">Category info</div>
                    <div class="card-body">
                        <form action="../controller/categoryController.php" method="POST">
                            <input type="hidden" name="id" value="<?= $_REQUEST['id'] ?? '' ?>">
                            <div class="form-group my-3">
                                <label for="title">Food title:</label>
                                <input type="text" class="form-control" placeholder="Enter Food title" id="title" name="title" value="<?= $_REQUEST['title'] ?? '' ?>">
                            </div>
                            <div class="form-group my-3">
                                <label for="detail">Detail :</label>
                                <input type="text" class="form-control" placeholder="Enter Food detail" id="detail" name="detail" value="<?= $_REQUEST['detail'] ?? '' ?>">
                            </div>
                            <div class="form-group my-3">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" placeholder="Enter Food image" id="image" name="image">
                            </div>
                            <div class="form-group my-3">
                                <label for="Price">Price title</label>
                                <input type="text" class="form-control" placeholder="Enter Food Price" id="price" name="price" value="<?= $_REQUEST['price'] ?? '' ?>">
                            </div>
                            <div class="form-group my-3">
                                <label for="category"> Select Category</label>
                                <select name="category_id" class="form-control">
                                <?php
                                foreach ($categories as $index => $category) {
                                ?>
                                   <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                                <?php
                                }
                                ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary"><?= isset($_REQUEST['id']) ? 'Update' : 'Submit' ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>




<?php
include '../include/backendFooter.php';
unset($_SESSION['errors']);
?>