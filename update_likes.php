<?php

include 'debugging.php';

$result = Article::updateArticleLikes($_GET['$articleId']);

                                echo '
		                  <a href="#" class="love" style="display: inline-block; margin-right: 10px;" onclick="updateLikes(<?php echo $result[$i]->article_id; ?>)"><i class="fas fa-thumbs-up"></i><div>'. $result[$i]->likes .'</div></a>
                                  ';

                            ?>