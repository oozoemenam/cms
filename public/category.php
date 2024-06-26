<?php
declare(strict_types = 1);                                // Use strict types
include '../bootstrap.php';                           // Setup file

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Validate id
if (!$id) {                                               // If id was not an integer
    include APP_ROOT . '/public/page-not-found.php';      // Page not found
}

$category = $cms->getCategory()->get($id);                // Get category data
if (!$category) {                                         // If category is empty
    include APP_ROOT . '/public/page-not-found.php';      // Page not found
}

$articles    = $cms->getArticle()->getAll(true, $id);     // Get articles

$navigation  = $cms->getCategory()->getAll();             // Get navigation categories
$section     = $category['id'];                           // Current category
$title       = $category['name'];                         // HTML <title> content
$description = $category['description'];                  // Meta description content
?>
<?php include APP_ROOT . '/public/includes/header.php' ?>
  <main class="container" id="content">
    <section class="header">
      <h1><?= escape($category['name']) ?></h1>
      <p><?= escape($category['description']) ?></p>
    </section>
    <section class="grid">
    <?php foreach ($articles as $article) { ?>
      <article class="summary">
        <a href="article.php?id=<?= $article['id'] ?>">
          <img src="uploads/<?= escape($article['image_file'] ?? 'blank.png') ?>"
               alt="<?= escape($article['image_alt']) ?>">
          <h2><?= escape($article['title']) ?></h2>
          <p><?= escape($article['summary']) ?></p>
        </a>
        <p class="credit">
          Posted in <a href="category.php?id=<?= $article['category_id'] ?>">
          <?= escape($article['category']) ?></a>
          by <a href="member.php?id=<?= $article['member_id'] ?>">
          <?= escape($article['author']) ?></a>
        </p>
      </article>
    <?php } ?>
    </section>
  </main>
<?php include APP_ROOT . '/public/includes/footer.php' ?>