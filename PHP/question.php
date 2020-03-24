<?php
$page = "question";
$title = "TIPJOB | Question";
include '../include/_header.php';
?>

<div class="container cont-wrap">
  <h1 class="text-center my-5">សំណួរដែលត្រូវត្រៀម</h1>
  <div class="text-center">
    <p>ទាំងនេះគឺជាសំណួរល្អៗដែលអ្នកត្រូវត្រៀមក្នុងកិច្ចសម្ភាស</p> <br>
    <button class="btn btn-rounded unique-color text-white" data-toggle="modal" data-target="#modalCreateQuestion">
    <i class="fas fa-plus"></i> &nbsp; បង្កើតសំណួរ</button>
  </div>
  <table class="table table-striped table-responsive-md btn-table">
    <thead class="unique-color text-white">
      <tr>
        <th class="font-weight-bold">#</th>
        <th style="width: 40%" class="font-weight-bold">សំណួរ</th>
        <th style="width: 20%" class="font-weight-bold">កាលបរិច្ឆេទ</th>
        <th class="font-weight-bold text-center">សកម្មភាព</th>
      </tr>
    </thead>
    <tbody>
      <?php require_once 'process.php' ?>
      <?php
      if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['msg_type'] ?>" role="alert">
          <?php
          echo $_SESSION["message"];
          unset($_SESSION["message"]);
          ?>
        </div>
      <?php endif ?>

      <?php
      $db = new mysqli('localhost', 'root', '', 'interview', '3306') or die(mysqli_error($mysqli));

      if (isset($_GET['limit'],$_GET['offset'])){
         $limit = $_GET['limit'];
         $offset = $_GET['offset'];
         $next = $offset+$limit;
         $current_page = floor(($offset/$limit) + 1);
         $result = $db->query("SELECT * FROM question LIMIT $limit OFFSET $offset");
      } 

      $result_all = $db->query("SELECT * FROM question");
      $total_record = mysqli_num_rows($result_all);
      $total_page = 0;
      if (($total_record%$limit) == 0) {
          $total_page = $total_record / $limit;
      }else{
          $total_page = floor(($total_record / $limit) + 1);  //use floor to round down number
      }
      //print_r($result->fetch_assoc());
      ?>
      <?php 
      $i = $offset;
      while ($row = $result->fetch_assoc()) : 
      $i++;
      ?>
        <tr>
          <th scope="row"><?php echo $i ?><span class="id" style="display: none"><?php echo $row['question_id'];?></span></th>
          <td class="question"><?php echo $row['question_detail'] ?></td>
          <td ><?php echo $row['create_date'] ?></td>
          <td class="text-center">
            <a class="btn btn-indigo btn-sm m-0" href="answer.php?question_id=<?php echo $row['question_id']; ?>&&limit=5&&offset=0"><i class="fas fa-eye"></i> &nbsp; ចម្លើយ</a>
            <button class="btn btn-sm m-0 edit-question pink darken-4 text-white" data-toggle="modal" data-target="#modalEditQusetion"><i class="fas fa-edit"></i>&nbsp;កែប្រែ</button>
            <a class="btn btn-sm m-0 red darken-4 text-white" href="process.php?delete=<?php echo $row['question_id']; ?>"><i class="fas fa-trash-alt"></i> &nbsp;លុប</a>
          </td>
        </tr>
      <?php endwhile; ?>

    </tbody>
  </table>
  <nav aria-label="Page navigation" class="my-5"> 
  <ul class="pagination pg-blue justify-content-center">
    <li class="page-item <?php echo ($current_page == 1) ? 'disabled' : ''?>">
      <a class="page-link" href="question.php?<?php ($current_page==1) ? $offset = 0 : $offset=$offset-$limit ; echo"limit=$limit&&offset=$offset" ?>" tabindex="-1">Previous</a>
    </li>
    <?php 
      for ($i = 1; $i <= $total_page; $i++) {
        if ($i == $current_page){
          echo '<li class="page-item active">
          <a class="page-link">'. $i . '</span></a>
        </li>';
        }else{
          echo '<li class="page-item">
          <a class="page-link"  href="question.php?limit='.$limit.'&&'.'offset='.(($i-1)*$limit).'">'. $i . '</span></a>
        </li>';
        }
       
      }
    ?>    
    <li class="page-item <?php echo ($current_page == $total_page) ? 'disabled' : ''?>">
      <a class="page-link" href="question.php?<?php echo"limit=$limit&&offset=$next"?>">Next</a>
    </li>
  </ul>
  </nav>

</div>

<!--Modal: Create Question-->
<div class="modal fade" id="modalCreateQuestion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog cascading-modal modal-avatar modal-lg" role="document">
    <form action="process.php" method="POST">
      <!--Content-->
      <div class="modal-content">

        <!--Header-->
        <div class="modal-header">
          <img src="../www/img/mavin.jpg" alt="avatar" class="rounded-circle img-responsive">
        </div>
        <!--Body-->
        <div class="modal-body text-center mb-1">

          <h5 class="mt-1 mb-2">បញ្ចូលសំណួរកិច្ចសម្ភាស</h5>

          <div class="md-form ml-0 mr-0">
            <input type="text" placeholder="ឧទាហរណ៍ និយាយពីចំណុចខ្សោយនិងខ្លាំងរបស់អ្នក" name="question" id="form29" class="form-control form-control-sm validate ml-0">
            <input type="hidden" name="create-date" class="form-control form-control-sm validate ml-0 create-date" name="create-date">
          </div>

          <div class="text-center mt-4">
            <button type="submit" class="btn btn-rounded unique-color text-white" name="save">បញ្ចូល<i class="fas fa-sign-in ml-1"></i></button>
          </div>
        </div>

      </div>
      <!--/.Content-->
    </form>
  </div>
</div>
<!--Modal: Create Question-->

<!--Modal: Edit Question-->
<div class="modal fade" id="modalEditQusetion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog cascading-modal modal-avatar modal-lg" role="document">
    <?php require_once 'process.php' ?>
    <form action="process.php" method="POST">
      <!--Content-->
      <div class="modal-content">

        <!--Header-->
        <div class="modal-header">
          <img src="../www/img/mavin.jpg" alt="avatar" class="rounded-circle img-responsive">
        </div>
        <!--Body-->
        <div class="modal-body text-center mb-1">
          <h5 class="mt-1 mb-2">កែប្រែសំណួរកិច្ចសម្ភាស</h5>
          <div class="md-form ml-0 mr-0">
            <input type="hidden" name="id" id="update-id" class="form-control form-control-sm validate ml-0" name="id">
            <input type="hidden" name="create-date" class="form-control form-control-sm validate ml-0 create-date" name="create-date">
            <input type="text" id="update-question" placeholder="ឧទាហរណ៍ និយាយពីចំណុចខ្សោយនិងខ្លាំងរបស់អ្នក" name="question" id="form29" class="form-control form-control-sm validate ml-0">
          </div>
          <div class="text-center mt-4">
            <button type="submit" class="btn btn-rounded unique-color text-white" name="update">កែប្រែ<i class="fas fa-sign-in ml-1"></i></button>
          </div>
        </div>

      </div>
      <!--/.Content-->
    </form>
  </div>
</div>
<!--Modal: Edit Question-->


<?php
include '../include/_footer.php';
?>