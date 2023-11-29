<?php

include "Functions.php";
check_login($db)

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Q Motors</title>
    <?php include "head.php"; ?>
  </head>
  <body>
    <?php include "navbar.php"; ?>


    <!--Cars-->
    <div>
      <input class="form-control" type="search" id="searchbox" oninput="search()" placeholder="Search..."/>
      <div>
        <div style="display: flex; justify-content: space-between; margin: 15px 5%; flex-wrap: wrap; gap: 10px;" id="main-cont">

        </div>
      </div>
    </div>
    <script>
    let cars = [
    <?php
    $sql = "SELECT name, image, Price, id FROM pro";
    $result = mysqli_query($db, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "{id:'" . $row['id'] . "', image:'" . $row['image'] . "', name:'" . $row['name'] . "', price:'" . $row['Price'] . "'},";
    }
    ?>
];

function get_item(data) {
    return "\
    <a href='cars.php?Id=" + data['id'] + "' style='text-decoration: none;'>\
      <div class='card__body'>\
        <div class='card__body-cover'>\
          <img src='" + data['image'] + "' alt=''>\
        </div>\
        <header class='card__body-header'>\
          <p class='card__body-header-subtitle'>" + data['name'] + "</p>\
        </header>\
        <h2>" + data['price'] + "$</h2>\
      </div>\
    </a>";
}

for (car of cars) {
    document.getElementById("main-cont").innerHTML += get_item(car);
}

function search() {
    let text = document.getElementById("searchbox").value;
    document.getElementById("main-cont").innerHTML = "";
    for (car of cars) {
        if (car.name.toLowerCase().includes(text.toLowerCase())) {
            document.getElementById("main-cont").innerHTML += get_item(car);
        }
    }
}

    </script>
    <?php include "cta+footer.php";?>
  </body>
</html>      
