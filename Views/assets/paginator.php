<nav aria-label="Page navigation example">
  <ul class="pagination">
      <?php if ($active != 1)
{ ?>
<li class="page-item"><a class="page-link" href="<?php $prev_page = $active - 1; echo $page_template.$prev_page ?>">Предыдущая</a></li>
<?php }
      ?>
      <?php for ($i = $start;$i <= $end;$i++)
    { ?>
      <?php if ($i == $active)
        { ?>
        <li class="page-item active">
            <a class="page-link" href="<?php echo ($i == 1) ? $first_page : $page_template . $i ?>"><?php echo $i ?></a>
        </li>
        <?php
        }
        else
        { ?>
        <li class="page-item">
            <a class="page-link" href="<?php echo ($i == 1) ? $first_page : $page_template . $i ?>"><?php echo $i ?></a>
        </li>
        <?php
        } ?>
    <?php
    } ?>
    <?php if ($active != $count_pages)
    { ?>
<li class="page-item"><a class="page-link" href="<?php echo $page_template . ($active + 1) ?>">Следующая</a></li>
<?php
    } ?>
  </ul>
</nav>