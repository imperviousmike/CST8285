<!DOCTYPE html>
<html>
<?php
include('header.php');
require_once('./dao/mailingListDAO.php')
?>

<?php
try{
  $mailingListDAO= new mailingListDao;
  $error = false;
  $errormessage = Array();

  if(isset($_POST['customerName'])||
  isset($_POST['phoneNumber'])||
  isset($_POST['emailAddress'])||
  isset($_POST['referral'])){

    if($_POST['customerName']==""){
      $errormessage[] = "Name cannot be empty.";
    }

    if (empty($_POST["phoneNumber"])){
      $errormessage[] = "Phone number cannot be empty.'";
    }

    if(!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $_POST ['phoneNumber']) ){
      $errormessage[] = "Please enter a phone number in the correct format. ex: 111-111-1111";
    }

    if (empty ( $_POST ['emailAddress'] ) || (! filter_var ( $_POST ['emailAddress'], FILTER_VALIDATE_EMAIL ))){
      $errormessage[] = "Enter a properly formatted email address. ex: name@email.com";
    }
    else {
      if($mailingListDAO->checkDuplicateEmail($_POST ['emailAddress'])){
        $errormessage[] = "Found duplicate email. Please enter another email.";
      }
    }

    if (empty($_POST["referral"])) {
      $errormessage[] = "Referral cannot be empty";
    }

    if(count($errormessage) > 0){
      $error = true;
    }

    if(!$error){
      $entry = new mailingList($_POST['customerName'],'',$_POST['phoneNumber'],$_POST ['emailAddress'],$_POST['referral']);
      $message = $mailingListDAO->addEntry($entry);
      echo '<h3>'. $message .'</h3>';


    }
  }


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
          <form name="frmNewsletter" id="frmNewsletter" method="post" action="contact.php" enctype="multipart/form-data">
            <table>
              <tr>
                <td>Name:</td>
                <td><input type="text" name="customerName" id="customerName" size='40'></td>
              </tr>
              <tr>
                <td>Phone Number:</td>
                <td><input type="text" name="phoneNumber" id="phoneNumber" size='40'></td>
              </tr>
              <tr>
                <td>Email Address:</td>
                <td><input type="text" name="emailAddress" id="emailAddress" size='40'>
                </tr>
                <tr>
                  <td>How did you hear<br> about us?</td>
                  <td>Newspaper<input type="radio" name="referral" id="referralNewspaper" value="newspaper">
                    Radio<input type="radio" name='referral' id='referralRadio' value='radio'>
                    TV<input type='radio' name='referral' id='referralTV' value='TV'>
                    Other<input type='radio' name='referral' id='referralOther' value='other'>
                  </tr>
                  <tr>
                    <?php
                    foreach($errormessage as $error){
                      echo '<span style=\'color:red\'>'.$error.'<br></span>';
                    }
                    ?>
                    <td colspan='2'><input type='submit' name='btnSubmit' id='btnSubmit' value='Sign up!'>&nbsp;&nbsp;<input type='reset' name="btnReset" id="btnReset" value="Reset Form"></td>
                  </tr>
                </table>
              </form>
            </div><!-- End Main -->
          </div><!-- End Content -->
        </div><!-- End Wrapper -->
      </body>
      <?php
    }catch(Exception $e){
      echo '<h3>Error</h3>';
      echo '<p>'.$e->getMessage().'</p>';
    }
    ?>
    <?php include './footer.php' ?>

    </html>
