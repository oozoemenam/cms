<?php
declare(strict_types=1);                                 // Use strict types
include '../bootstrap.php';                          // Setup file

$articles    = $cms->getArticle()->getAll(true, null, null, 6); // Get latest article summaries

$navigation  = $cms->getCategory()->getAll();            // Get categories
$section     = '';                                       // Current category
$title       = 'Creative Folk';                          // HTML <title> content
$description = 'A collective of creatives for hire';     // Meta description content
?>
<?php include APP_ROOT . '/public/includes/header.php'; ?>
  <main class="container grid" id="content">
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
  </main>
<?php include APP_ROOT . '/public/includes/footer.php'; ?>