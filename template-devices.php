<?php
/*
Template Name: YouTuber Devices
*/
get_header();

$devices_data = array(
    array(
        'category_cn' => '相机',
        'category_en' => 'Cameras',
        'devices' => array(
            array(
                'name' => 'Canon EOS R6',
                'image' => 'https://m.media-amazon.com/images/I/71WvBLJvqGL._AC_SL1500_.jpg',
                'purchase_link' => 'https://www.amazon.com/',
                'youtuber' => 'Peter McKinnon'
            ),
            array(
                'name' => 'Sony A7 III',
                'image' => 'https://m.media-amazon.com/images/I/711KuxSzmqL._AC_SL1500_.jpg',
                'purchase_link' => 'https://www.amazon.com/',
                'youtuber' => 'MKBHD'
            ),
            array(
                'name' => 'Panasonic GH5',
                'image' => 'https://m.media-amazon.com/images/I/81ljOmAi7+L._AC_SL1500_.jpg',
                'purchase_link' => 'https://www.amazon.com/',
                'youtuber' => '某某大V'
            )
        )
    ),
    array(
        'category_cn' => '麦克风',
        'category_en' => 'Microphones',
        'devices' => array(
            array(
                'name' => 'Shure SM7B',
                'image' => 'https://m.media-amazon.com/images/I/81ljOmAi7+L._AC_SL1500_.jpg',
                'purchase_link' => 'https://www.amazon.com/',
                'youtuber' => 'Casey Neistat'
            ),
            array(
                'name' => 'Blue Yeti',
                'image' => 'https://m.media-amazon.com/images/I/81ljOmAi7+L._AC_SL1500_.jpg',
                'purchase_link' => 'https://www.amazon.com/',
                'youtuber' => '某某大V'
            ),
            array(
                'name' => 'Rode VideoMic Pro',
                'image' => 'https://m.media-amazon.com/images/I/81ljOmAi7+L._AC_SL1500_.jpg',
                'purchase_link' => 'https://www.amazon.com/',
                'youtuber' => '某某大V'
            )
        )
    )
);
?>

<style>
.category-title {
  font-size: 1.2rem;
  font-weight: 700;
  margin-bottom: 1rem;
  color: #333;
}
.category-title small {
  font-size: 1rem;
  color: #999;
  margin-left: 0.5rem;
}
.category-block {
  margin-bottom: 3rem;
}
.card {
  border: 1px solid #eee;
  border-radius: 4px;
  transition: box-shadow 0.2s;
  margin-bottom: 1.5rem;
}
.card:hover {
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.card-img-top {
  width: 100%;
  height: auto;
  max-height: 180px;
  object-fit: contain;
  background-color: #f7f7f7;
  padding: 5px;
}
.card-body {
  display: flex;
  flex-direction: column;
  padding: 1rem;
}
.recommend-label {
  color: #dc3545;
  font-size: 0.8rem;
  font-weight: 500;
  margin-bottom: 0.5rem;
}
.device-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 0.5rem;
}
.device-name {
  font-size: 1rem;
  font-weight: 600;
  color: #000;
}
.btn-buy {
  padding: 6px 12px;
  font-size: 0.8rem;
  border-radius: 20px;
  text-decoration: none;
  color: #666;
  background-color: #fff;
  border: 1px solid #ccc;
  transition: color 0.2s, border-color 0.2s, text-decoration 0.2s;
}
.btn-buy:hover {
  color: #ff0000;
  border-color: #ff0000;
  text-decoration: underline;
}
</style>

<div class="container">
  <div class="section-title">
    <h5 class="font400 mb-4 text-center" style="font-family: 'KaiTi', '楷体', serif; font-style: italic;">“做好内容，手机就够了” ——《油管家》</h5>
    <h2><span><?php the_title() ?></span></h2>
  </div>

  <?php foreach ($devices_data as $category):
    $cat_cn = $category['category_cn'];
    $cat_en = $category['category_en'];
    $devices = $category['devices'];
    if (empty($devices)) continue;
  ?>
    <div class="category-block">
      <div class="category-title mb-3">
        <?php echo esc_html($cat_cn); ?>
        <small><?php echo esc_html($cat_en); ?></small>
      </div>
      <div class="row">
        <?php
        $col_count = 0;
        foreach ($devices as $device):
          $name = $device['name'];
          $image = isset($device['image']) ? $device['image'] : '';
          $purchase_link = $device['purchase_link'];
          $youtuber = isset($device['youtuber']) ? $device['youtuber'] : '';
        ?>
          <div class="col-md-4">
            <div class="card h-100">
              <?php if (!empty($image)): ?>
                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($name); ?>" class="card-img-top">
              <?php endif; ?>
              <div class="card-body">
                <?php if (!empty($youtuber)): ?>
                  <div class="recommend-label"><?php echo esc_html($youtuber); ?> 推荐</div>
                <?php endif; ?>
                <div class="device-header">
                  <div class="device-name"><?php echo esc_html($name); ?></div>
                  <a href="<?php echo esc_url($purchase_link); ?>" target="_blank" class="btn-buy">
                    我也想要
                  </a>
                </div>
              </div>
            </div>
          </div>
          <?php
          $col_count++;
          if ($col_count % 3 == 0) {
            echo '</div><div class="row">';
          }
        endforeach;
        ?>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<?php get_footer(); ?>
