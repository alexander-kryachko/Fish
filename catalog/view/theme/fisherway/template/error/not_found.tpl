<?php
header ("HTTP/1.1 404 Not Found");
?>
<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<style>
	.payment> .buttons {
		display: none;
	}
	.nofloat {
	  display: none;
	}
  #razdel_block+#softcubeHity{display: none !important;}
</style>
<div id="content">

<div id="content">
  <div class="page-cols">
      <div class="page-col-1">

      <div class="page-404-layout">
        <div class="page-404-title">
          <div class="bg">                          
          </div>
          <div class="txt">
            <div class="h">Страница которую Вы искали не открывается (или временно не доступна).Наши специалисты уже работают над решением этой проблемы.</div>
            <div class="h">Воспользуйтесь поиском</div>
            <form id="search-404">
              <input type="text" id="searchin2" placeholder="Поиск товаров">
              <input type="submit" value="">
            </form>
          </div>
        </div>

        <div class="page-404-links">
          <div class="h">ПОПУЛЯРНЫЕ КАТЕГОРИИ</div>
          <div class="categories">
            <div class="category-box">
              <div class="title">приманки</div>
              <div class="cnt">
                <figure><img src="/image/p404-cat-01.png" alt=""></figure>
                <div class="list">
                  <ul>
                    <li><a href="">Блесны</a></li>
                    <li><a href="">Воблеры</a></li>
                    <li><a href="">Силикон</a></li>
                    <li><a href="">Ароматизаторы</a></li>
                    <li><a href="">Прикормки и добавки</a></li>
                    <li><a href="">Дипы</a></li>
                  </ul>
                  <a href="" class="btn btn-red btn-reg">смотреть все</a>
                </div>
              </div>
            </div>
            <div class="category-box">
              <div class="title">удилища</div>
              <div class="cnt">
                <figure><img src="/image/p404-cat-02.png" alt=""></figure>
                <div class="list">
                  <ul>
                    <li><a href="">Спиннинговые</a></li>
                    <li><a href="">Фидерные</a></li>
                    <li><a href="">Поплавочные</a></li>
                    <li><a href="">Карповые</a></li>
                    <li><a href="">Зимние</a></li>
                    <li><a href="">Вершинки</a></li>
                  </ul>
                  <a href="" class="btn btn-red btn-reg">смотреть все</a>
                </div>
              </div>
            </div>
            <div class="category-box">
              <div class="title">оснастка</div>
              <div class="cnt">
                <figure><img src="/image/p404-cat-03.png" alt=""></figure>
                <div class="list">
                  <ul>
                    <li><a href="">Шнуры</a></li>
                    <li><a href="">Лески</a></li>
                    <li><a href="">Флюорокарбон</a></li>
                    <li><a href="">Поводки</a></li>
                    <li><a href="">Крючки</a></li>
                    <li><a href="">Готовые монтажи</a></li>
                    <li><a href="">Грузила</a></li>
                    <li><a href="">Сигнализаторы</a></li>
                  </ul>
                  <a href="" class="btn btn-red btn-reg">смотреть все</a>
                </div>
              </div>
            </div>
            <div class="category-box">
              <div class="title">снаряжение</div>
              <div class="cnt">
                <figure><img src="/image/p404-cat-04.png" alt=""></figure>
                <div class="list">
                  <ul>
                    <li><a href="">Одежда</a></li>
                    <li><a href="">Обувь</a></li>
                    <li><a href="">Очки</a></li>
                    <li><a href="">Подсаки</a></li>
                    <li><a href="">Садки</a></li>
                    <li><a href="">Коробки</a></li>
                    <li><a href="">Подставки</a></li>
                  </ul>
                  <a href="" class="btn btn-red btn-reg">смотреть все</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div><?php echo $content_top; ?></div>

        <div class="shop_rates_list-404 page-404-links">
          <div class="h">отзывы</div>
          <?php foreach($ratings as $rating){ ?>
            <div class="ratings-item">
                <div class="sender-name"><?php echo $rating['customer_name'];?></div>
                <div class="raiting-content">
                  <div class="rates">
                      <div class="rate">
                        <?php if(isset($shop_rating_shop_rating)){ ?>
                          <div class="ratings-item-rates-item shop-rates" <?php if($rating['customs']){ echo 'style="width: 100%"'; }?>>
                            <div class="rates-title"><?php echo $entry_rate; ?> </div>
                            <div class="rate-stars1">
                              <div class="rate-star-show <?php if($rating['shop_rate'] >= 1)echo 'star-change';?>"></div>
                              <div class="rate-star-show <?php if($rating['shop_rate'] >= 2)echo 'star-change';?>"></div>
                              <div class="rate-star-show <?php if($rating['shop_rate'] >= 3)echo 'star-change';?>"></div>
                              <div class="rate-star-show <?php if($rating['shop_rate'] >= 4)echo 'star-change';?>"></div>
                              <div class="rate-star-show <?php if($rating['shop_rate'] == 5)echo 'star-change';?>"></div>
                            </div>
                          </div>
                        <?php } ?>
                      </div>
                    <div class="rate">
                      <?php if(isset($shop_rating_site_rating)){ ?>
                        <div class="ratings-item-rates-item shop-rates" <?php if($rating['customs']){ echo 'style="width: 100%"'; }?>>
                          <div class="rates-title"><?php echo $entry_site_rate; ?> </div>
                          <div class="rate-stars1">
                            <div class="rate-star-show <?php if($rating['site_rate'] >= 1)echo 'star-change';?>"></div>
                            <div class="rate-star-show <?php if($rating['site_rate'] >= 2)echo 'star-change';?>"></div>
                            <div class="rate-star-show <?php if($rating['site_rate'] >= 3)echo 'star-change';?>"></div>
                            <div class="rate-star-show <?php if($rating['site_rate'] >= 4)echo 'star-change';?>"></div>
                            <div class="rate-star-show <?php if($rating['site_rate'] == 5)echo 'star-change';?>"></div>
                          </div>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="ratings-item-comment"><?php echo nl2br($rating['comment']);?></div>
                </div>
            </div>


          <?php }?>

        </div>

      </div>


    </div>
      <div class="page-col-2">
      <?php echo $content_bottom; ?>
    </div>
  </div>
</div>





</div>
<?php echo $footer; ?>