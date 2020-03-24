<?php
    $page = "answer";
    $title = "TIPJOB | Answer";
    include '../include/_header.php';
?>
<div class="container cont-wrap">

    <h1 class="text-center my-5">ប្រធានសំណួរ</h1>
    <div class="question-detail">
        <div class="text-center question-description">
            <?php 
                $db = new mysqli('localhost','root','','interview','3306') or die(mysqli_error($mysqli));
                if (isset($_GET['question_id'])){
                    $question_id = $_GET['question_id'];
                    $find_question = "SELECT * From question WHERE question_id = $question_id";
                    $result_q= $db->query($find_question);
                }
            ?>
            <?php
             while ($row= $result_q->fetch_assoc()): ?>
                <h3><strong>សំណួរ : </strong> <?php echo $row['question_detail'] ?></h3>
                <span style="visibility:hidden" id="question-id"><?php echo $row['question_id']?></span>
            <?php endwhile ?>
            <button class="btn btn-rounded unique-color text-white insert-answer" data-toggle="modal" data-target="#modalCreateAnswer">
      បង្កើតចម្លើយ</button>
        </div>
    </div>
    <table class="table table-striped table-responsive-md btn-table">
    <thead class="unique-color text-white">
      <tr>
        <th class="font-weight-bold">#</th>
        <th style="width: 40%" class="font-weight-bold">ចម្លើយ</th>
        <th style="width: 30%" class="font-weight-bold">កាលបរិច្ឆេទ</th>
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
          if (isset($_GET['limit'],$_GET['offset'])){
            $limit = $_GET['limit'];
            $offset = $_GET['offset'];
            $next = $offset+$limit;
            $current_page = floor(($offset/$limit) + 1);
            $result = $db->query("SELECT * FROM answer where question_id = $question_id LIMIT $limit OFFSET $offset");
          } 

          $result_all = $db->query("SELECT * FROM answer where question_id = $question_id");
          $total_record = mysqli_num_rows($result_all); //count row
          $total_page = 0;
          if (($total_record%$limit) == 0) {
              $total_page = $total_record / $limit;
          }else{
              $total_page = floor(($total_record / $limit) + 1);  //use floor to round down number
          }
      //print_r($result->fetch_assoc());
      ?>
      <?php 
      if ($total_record==0){
      ?>  
         <tr>
            <td colspan="4" style="text-align: center">មិនទាន់មានចម្លើយ</td>
        </tr>
      <?php }else{
          $i = $offset;
          while ($row = $result->fetch_assoc()) :
      $i++; ?>
        <tr>
          <th scope="row"><?php echo $i ?>
          <span class="id" style="display: none"><?php echo $row['answer_id']; ?></span>
          <span class="qid" style="display: none"><?php echo $row['question_id']; ?>
        </th>
          <td  class="answer"><?php echo $row['answer_detail'] ?></td>
          <td><?php echo $row['create_date'] ?></td>
          <td class="text-center">
            <button class="btn btn-sm m-0 edit-answer pink darken-4 text-white" data-toggle="modal" data-target="#modalUpdateAnswer"><i class="fas fa-edit"></i>&nbsp;កែប្រែ</button>
            <a class="btn btn-sm m-0 red darken-4 text-white" href="process.php?question_id=<?php echo $row['question_id'] ?>&&delete_answer=<?php echo $row['answer_id']; ?>"><i class="fas fa-trash-alt"></i> &nbsp;លុប</a>

          </td>
        </tr>
      <?php endwhile;
      } ?>

    </tbody>


  </table>
  <?php 
    if ($total_record!=0) {
  ?>
  <nav aria-label="Page navigation" class="my-5"> 
      <ul class="pagination pg-blue justify-content-center">
        <li class="page-item <?php echo ($current_page == 1) ? 'disabled' : ''?>">
          <a class="page-link" href="answer.php?<?php ($current_page==1) ? $offset = 0 : $offset=$offset-$limit ; echo"question_id=$question_id&&limit=$limit&&offset=$offset" ?>" tabindex="-1">Previous</a>
        </li>
        <?php 
          for ($i = 1; $i <= $total_page; $i++) {
            if ($i == $current_page){
              echo '<li class="page-item active">
              <a class="page-link">'. $i . '</span></a>
            </li>';
            }else{
              echo '<li class="page-item">
              <a class="page-link"  href="answer.php?question_id='.$question_id.'&&limit='.$limit.'&&'.'offset='.(($i-1)*$limit).'">'. $i . '</span></a>
            </li>';
            }
          
          }
        ?>    
        <li class="page-item <?php echo ($current_page == $total_page) ? 'disabled' : ''?>">
          <a class="page-link" href="answer.php?<?php echo"question_id=$question_id&&limit=$limit&&offset=$next"?>">Next</a>
        </li>
      </ul>
  </nav>
       <?php }?>
  <!--Modal: create answer-->
<div class="modal fade" id="modalCreateAnswer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
            <h5 class="mt-1 mb-2">ឆ្លើយសំណួរ​</h5>
            <div class="md-form ml-0 mr-0">
            <input type="hidden" id="qid" name="question_id" value="<?php echo $question_id ?>">
            <input type="hidden" name="create-date" class="form-control form-control-sm validate ml-0 create-date" name="create-date">
            <input type="text" placeholder="ចម្លើយរបស់អ្នក" name="answer_detail" id="form29" class="form-control form-control-sm validate ml-0">
          </div>
          <div class="text-center mt-4">
            <button type="submit" class="btn btn-rounded unique-color text-white" name="answer">ឆ្លើយ<i class="fas fa-sign-in ml-1"></i></button>
          </div>
        </div>

      </div>
      <!--/.Content-->
    </form>
  </div>
</div>
<!--Modal: create answer-->

 <!--Modal: Update Answer-->
 <div class="modal fade" id="modalUpdateAnswer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
            <h5 class="mt-1 mb-2">កែប្រែចម្លើយ</h5>
            <div class="md-form ml-0 mr-0">
            <input type="hidden" id="update-qid" name="question_id">
            <input type="hidden" id="update-id" name="answer_id">
            <input type="hidden" name="create-date" class="form-control form-control-sm validate ml-0 create-date" name="create-date">
            <input type="text"​​​​ placeholder="ចម្លើយរបស់អ្នក" name="answer_detail" id="update-answer" class="form-control form-control-sm validate ml-0">
          </div>
          <div class="text-center mt-4">
            <button type="submit" class="btn btn-rounded unique-color text-white" name="update_answer">កែប្រែ<i class="fas fa-sign-in ml-1"></i></button>
          </div>
        </div>

      </div>
      <!--/.Content-->
    </form>
  </div>
</div>
<!--Modal: Update Answer-->

</div>
  

<?php
    include '../include/_footer.php';
?>
