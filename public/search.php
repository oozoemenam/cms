<?php
declare(strict_types=1);                                  // Use strict types
include '../bootstrap.php';                           // Setup file

$term  = filter_input(INPUT_GET, 'term');                 // Get search term
$show  = filter_input(INPUT_GET, 'show', FILTER_VALIDATE_INT) ?? 3; // Limit
$from  = filter_input(INPUT_GET, 'from', FILTER_VALIDATE_INT) ?? 0; // Offset
$count = 0;                                               // Set count to 0
$articles = [];                                           // Set articles to empty array

if ($term) {                                              // If search term provided
    $count = $cms->getArticle()->searchCount($term);      // Get number of matches
    if ($count > 0) {
        $articles = $cms->getArticle()->search($term, $show, $from); // Get matches
      }
}

if ($count > $show) {                                     // If more than 3 results
    $total_pages  = ceil($count / $show);                 // Total pages
    $current_page = ceil($from / $show) + 1;              // Current page
}
$navigation  = $cms->getCategory()->getAll();             // Get categories
$section    = '';                                         // Current category
$title      = 'Search results for ' . escape($term); // HTML <title> content
$description = $title . ' on Creative Folk';              // Meta description content
?>
<?php include 'includes/header.php'; ?>
  <main class="container" id="content">
    <section class="header">
      <form action="search.php" method="get" class="form-search">
        <label for="search"><span>Search for: </span></label>
        <input type="text" name="term" value="<?= escape($term) ?>" 
               id="search" placeholder="Enter search term"  
        /><input type="submit" value="Search" class="btn btn-search" />
      </form>
      <?php if ($term) { ?><p><b>Matches found:</b> <?= $count ?></p><?php } ?>
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

    <?php if ($count > $show) { ?>
    <nav class="pagination" role="navigation" aria-label="Pagination Navigation">
      <ul>
      <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <li>
          <a href="?term=<?= $term ?>&show=<?= $show ?>&from=<?= (($i - 1) * $show) ?>"
            class="btn <?= ($i == $current_page) ? 'active" aria-current="true' : '' ?>">
            <?= $i ?>
          </a>
        </li>
      <?php } ?>
      </ul>
    </nav>
    <?php } ?>

  </main>
<?php include 'includes/footer.php'; ?>