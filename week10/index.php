<!DOCTYPE html>
<html>
<!--header.php starts here-->
<?php
include('header.php');
include('menuitem.php');
?>
<body>
  <div id="wrapper">
    <div id="content" class="clearfix">
      <aside>
        <h2><?php echo date("l"); ?>'s Specials</h2>
        <hr>
        <img src="images/burger_small.jpg" alt="Burger" title="Monday's Special - Burger">
        <h3>The WP Burger</h3>
        <p>Freshly made all-beef patty served up with homefries - $14</p>
        <hr>
        <img src="images/kebobs.jpg" alt="Kebobs" title="WP Kebobs">
        <h3>WP Kebobs</h3>
        <p>Tender cuts of beef and chicken, served with your choice of side - $17</p>
        <hr>
        <?php
        $i = 0;
        $star = '*';
        $menuItems = array();
        while ($i < 6){
          if($i % 2 == 0){
            $menuItems[$i] = new menuItem("The WP Burger $star".($i+1),"Freshly made all-beef patty served up with homefries", "14");
          }else {
            $menuItems[$i] = new menuItem("WP Kebabs $star".($i+1),"Tender cuts of beef and chicken, served with your choice of side", "17");
          }
          $star .= '*';
          $i++;
        }
        foreach($menuItems as $item ){
          $name = $item->getItemName();
          if (strpos($name, 'Burger')) {
            echo '<img src="images/burger_small.jpg" alt="Burger" title="Monday\'s Special - Burger">';
            echo "<h3>".$name."</h3><p>".$item->getDescription()." - $".$item->getPrice()."</p><hr>";
          }else{
            echo '<img src="images/kebobs.jpg" alt="Kebobs" title="WP Kebobs">';
            echo "<h3>".$name."</h3><p>".$item->getDescription()." - $".$item->getPrice()."</p><hr>";
          }
        }

        ?>
      </aside>
      <div class="main">
        <h1>Welcome</h1>
        <img src="images/dining_room.jpg" alt="Dining Room" title="The WP Eatery Dining Room" class="content_pic">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
        <h2>Book your Christmas Party!</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
      </div><!-- End Main -->
    </div><!-- End Content -->
    <?php
    include('footer.php');
    ?>
  </div><!-- End Wrapper  this dv is included in footer.php-->
</body>

</html>
