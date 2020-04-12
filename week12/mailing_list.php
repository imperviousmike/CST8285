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
        <h1>Sign up for our newsletter</h1>
        <p>Please fill out the following form to be kept up to date with news, specials, and promotions from the WP eatery!</p>
        <form name="frmNewsletter" id="frmNewsletter" method="post" action="customerlist.php">
          <table>
            <tr>
              <th>Name:</th>
              <th>Phone Number:</th>
              <th>Email Address:</th>
              <th>How did you hear about us?</th>
              <th>Delete?<th>
              </tr>
              <?php
              $mailingListDao = new mailingListDao;
              $mailingList=$mailingListDao->getMailingList();

              if ($mailingList){
                foreach($mailingList as $entry){
                  if(empty($entry->getDeleted())){
                    $id = $mailingListDao->getID($entry);
                    echo '<tr>';
                    echo '<td>' . $entry->getName() . '</td>';
                    echo '<td>' . $entry->getPhone() . '</td>';
                    echo '<td>' . $entry->getEmail() . '</td>';
                    echo '<td>' . $entry->getReferrer() . '</td>';
                    echo '<td> <input type="submit" name="'.$id.'" value="Delete" />';
                    echo '</tr>';
                  }
                }

                foreach($mailingList as $temp){
                  if(isset($_REQUEST[$mailingListDao->getID($temp)]))
                  {
                    $tempID = $mailingListDao->getID($temp);
                    $mailingListDao->deleteEntry($temp,$tempID);
                    header("Refresh:0");
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
