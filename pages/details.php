
<?php

include_once('../includes/db.php');
$db = init_sqlite_db('db/site.sqlite', 'db/init.sql');

$id = $_GET['id'];

const MATERIAL = array(
  1 => 'Silver',
  2 => 'Gold',
  3 => 'Other'
);

const JEWELER = array(
  1 => 'Im Zardy',
  2 => 'Protest Handmade'
);

const TYPE = array(
  1 => 'Ring',
  2 => 'Necklace',
  3 => 'Bracelet',
  4 => 'Belt',
  5 => 'Earing',
  6 => 'Brooch'
);

const RATING = array(
  0 => '☆☆☆☆☆',
  1 => '★☆☆☆☆',
  2 => '★★☆☆☆',
  3 => '★★★☆☆',
  4 => '★★★★☆',
  5 => '★★★★★'
);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="/public/styles/site.css" />

  <title>details</title>
</head>

<body>

<header>
    <h1> ARMJEWELERS </h1>

    <nav>
      <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/account">Account</a></li>
      </ul>
    </nav>
  </header>

<h1>Details for your product!</h1>

<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');


    $id = $_GET['id'];

    // query DB
    $result = exec_sql_query($db, "SELECT * FROM products INNER JOIN product_tags ON products.id = product_tags.product_id INNER JOIN tags ON product_tags.tag_id = tags.id INNER JOIN jewelers ON jewelers.id=products.jeweler_id WHERE products.id=" . $id);
    $records = $result->fetchAll();

    // var_dump($result);
    // echo "<h2>" . htmlspecialchars($result['product_name']) . "</h2>";
    // ?>


  <?php foreach ($records as $record) { ?>

  <div class="details-name-price">
    <!-- <h2> Berd </h2> -->
    <h2><?php echo htmlspecialchars($record['product_name']);?> </h2>
    <!-- <h2 class="product-price">$20</h2> -->
    <h2 class="product-price"><?php echo htmlspecialchars('$' . $record['product_price']);?></h2>
    <h2 class="details-rating"><?php echo htmlspecialchars(RATING[$record['product_rating']]);?></h2>
  </div>

<div class="image-description">
  <img src="../public/uploads/placeholder-image.jpg" alt="Placeholder image">
  <div class="product-descriptions">
    <h3>Metal: <?php echo htmlspecialchars(MATERIAL[$record['material']]);?></h3>
    <h3>Jevelery Type: <?php echo htmlspecialchars(TYPE[$record['tag_type']]);?></h3>
    <h3>Description:</h3>
    <!-- <p>The Armenian Berd Dance is a beautiful and captivating folk dance that has been a part of Armenian culture for centuries. This traditional dance is named after the ancient Armenian city of Berd, and it is known for its high energy, dynamic movements, and powerful rhythms. The Berd Dance is typically performed by a group of dancers, who move in a circular formation, with the lead dancer leading the way. The dancers move their feet quickly and gracefully, with the music driving their movements. The dance is accompanied by traditional Armenian music, featuring instruments like the duduk, dhol, and zurna.</p> -->
    <p><?php echo htmlspecialchars($record['product_description']);?></p>
    <h3>Jeweler: <?php echo htmlspecialchars(JEWELER[$record['jeweler_id']]); ?></h3>
    <p><?php echo htmlspecialchars($record['jeweler_description']); ?></p>
    <!-- <p>'Im Zardy' is Armenian for My Jewelery. We are a group of talented and dedicated jewelers making unique jewelery that is rich with the juxdoposition of Armenian traditional and modern styles and references to Armenian culture and history.</p> -->
    </div>
</div>

<?php } ?>


</body>

</html>