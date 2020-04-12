<!DOCTYPE html>
<html>
<?php
include('header.php');
require_once('./dao/mailingListDAO.php')
?>

<div id="wrapper">
  <div id="content" class="clearfix">
    <aside>
      <h2>Mailing Address</h2>
      <h3>1385 Woodroffe Ave<br>
        Ottawa, ON K4C1A4</h3>
        <h2>Phone Number</h2>
        <h3>(613)727-4723</h3>
        <h2>Fax Number</h2>
        <h3>(613)555-1212</h3>
        <h2>Email Address</h2>
        <h3>info@wpeatery.com</h3>
      </aside>
      <div class="main">
        <form name="frmDelete" id="frmDelete" method="post" enctype="multipart/form-data">
          <table>
            <tr>
              <th>Name:</th>
              <th>Phone Number:</th>
              <th>Email Address:</th>
              </tr>
              <?php
              $mailingListDao = new mailingListDao;
              $mailingList=$mailingListDao->getMailingList();

              if ($mailingList){
                foreach($mailingList as $entry){
                  if(!empty($entry->getDeleted())){
                    $pieces = explode(",", $entry->getDeleted());
                    echo '<tr>';
                    echo '<td>' . $pieces[0] . '</td>';
                    echo '<td>' . $pieces[1] . '</td>';
                    echo '<td>' . $pieces[2] . '</td>';
                    echo '</tr>';
                  }
                }
              }
              ?>
            </table>
          </form>
        </div><!-- End Main -->
      </div><!-- End Content -->
    </div><!-- End Wrapper -->
  </body>

  <?php include './footer.php' ?>

  </html>
