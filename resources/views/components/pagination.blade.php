<nav aria-label="Page navigation">
    <ul class="pagination">
        <li class="page-item <?=$currentPage <= 1 ? "disabled" : "" ?>"><a class="page-link" href="<?=$controller->makePrevPageUrl(); ?>"><i class="fas fa-long-arrow-alt-left"></i></a></li>
    <?php for($pageNumber = 1; $pageNumber <= $numberOfPages; ++$pageNumber) {?>
    <li class="page-item <?= $pageNumber == $currentPage ? "active" : "" ?>"><a class="page-link" href="<?=$controller->makePageUrl($pageNumber);?>"><?=$pageNumber;?></a></li>
    <?php } ?>

    <li class="page-item <?=$currentPage >= $numberOfPages ? "disabled" : "" ?>"><a class="page-link" href="<?=$controller->makeNextPageUrl();?>"><i class="fas fa-long-arrow-alt-right"></i></a></li>
    </ul>
</nav>