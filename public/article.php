<?php
declare(strict_types=1);                                 // Use strict types
include '../bootstrap.php';                          // Setup file

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);// Validate id
if (!$id) {                                              // If no valid id
    include APP_ROOT . '/public/page-not-found.php';     // Page not found
}

$article = $cms->getArticle()->get($id);                 // Get article data
if (!$article) {                                         // If article array is empty
    include APP_ROOT . '/public/page-not-found.php';     // Page not found
}

$navigation  = $cms->getCategory()->getAll();            // Get categories
$section     = $article['category_id'];                  // Current category
$title       = $article['title'];                        // HTML <title> content
$description = $article['summary'];                      // Meta description content
?>
<?php include APP_ROOT . '/public/includes/header.php'; ?>
  <main class="article container" id="content">
    <section class="image">
      <img src="uploads/<?= escape($article['image_file'] ?? 'blank.png') ?>" 
           alt="<?= escape($article['image_alt']) ?>">
    </section>
    <section class="text">
      <h1><?= escape($article['title']) ?></h1>
      <div class="date"><?= format_date($article['created']) ?></div>
      <div class="content"><?= escape($article['content']) ?></div>
      <p class="credit">
        Posted in <a href="category.php?id=<?= $article['category_id'] ?>"><?= escape($article['category']) ?></a> by <a href="member.php?id=<?= $article['member_id'] ?>">
          <?= escape($article['author']) ?></a>
      </p>
    </section>
  </main>
<?php include APP_ROOT . '/public/includes/footer.php'; ?>