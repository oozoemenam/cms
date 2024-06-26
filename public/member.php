<?php
declare(strict_types=1);                                 // Use strict types
include '../bootstrap.php';                          // Setup file

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);// Validate id
if (!$id) {                                              // If no valid id
    include APP_ROOT . '/public/page-not-found.php';     // Page not found
}

$member = $cms->getMember()->get($id);                   // Get member data
if (!$member) {                                          // If array is empty
    include APP_ROOT . '/public/page-not-found.php';     // Page not found
}

$articles = $cms->getArticle()->getAll(true, null, $id); // Get member's articles

$navigation  = $cms->getCategory()->getAll();            // Get categories
$section     = '';                                       // Current category
$title       = $member['forename'] . ' ' . $member['surname']; // HTML <title> content
$description = $title . ' on Creative Folk';             // Meta description content
?>
<?php include APP_ROOT . '/public/includes/header.php'; ?>
  <main class="container" id="content">
    <section class="header">
      <h1><?= escape($member['forename'] . ' ' . $member['surname']) ?></h1>
      <p class="member"><b>Member since:</b> <?= format_date($member['joined']) ?></p>
      <img src="uploads/<?= escape($member['picture'] ?? 'member.png') ?>"
           alt="<?= escape($member['forename']) ?>" class="profile"><br>
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
<?php include APP_ROOT . '/public/includes/footer.php'; ?>