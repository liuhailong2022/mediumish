<?php
/*
Template Name: Youtuber Tools
*/
get_header();

// 这里是你之前写好的数据数组 $tools_data
$tools_data = array(

    // 1. 下载工具
    array(
        'category_cn' => '下载工具',
        'category_en' => 'Download Tools',
        'subcategories' => array(
            array(
                'title' => '视频下载器',
                'tools' => array(
                    array('name' => '4K Video Downloader', 'link' => 'https://www.4kdownload.com/products/videodownloader'),
                    array('name' => 'YT-DLP', 'link' => 'https://github.com/yt-dlp/yt-dlp')
                )
            ),
            array(
                'title' => '音频提取工具',
                'tools' => array(
                    array('name' => 'ClipGrab', 'link' => 'https://clipgrab.org/'),
                    array('name' => 'Audacity 提取功能', 'link' => 'https://www.audacityteam.org/')
                )
            ),
            array(
                'title' => '字幕下载工具',
                'tools' => array(
                    array('name' => 'OpenSubtitles', 'link' => 'https://www.opensubtitles.org/'),
                    array('name' => 'DownSub', 'link' => 'https://downsub.com/')
                )
            )
        )
    ),

    // 2. 数据分析工具
    array(
        'category_cn' => '数据分析工具',
        'category_en' => 'Analytics & SEO Tools',
        'subcategories' => array(
            array(
                'title' => 'YouTube官方分析',
                'tools' => array(
                    array('name' => 'YouTube Studio Analytics', 'link' => 'https://studio.youtube.com/')
                )
            ),
            array(
                'title' => 'SEO优化工具',
                'tools' => array(
                    array('name' => 'TubeBuddy', 'link' => 'https://www.tubebuddy.com/'),
                    array('name' => 'VidIQ', 'link' => 'https://vidiq.com/')
                )
            ),
            array(
                'title' => '关键词 & 标题优化',
                'tools' => array(
                    array('name' => 'Ahrefs', 'link' => 'https://ahrefs.com/'),
                    array('name' => 'Ubersuggest', 'link' => 'https://neilpatel.com/ubersuggest/')
                )
            ),
            array(
                'title' => '受众 & 竞争对手分析',
                'tools' => array(
                    array('name' => 'Social Blade', 'link' => 'https://socialblade.com/'),
                    array('name' => 'Noxinfluencer', 'link' => 'https://www.noxinfluencer.com/')
                )
            )
        )
    ),

    // 3. 视频剪辑工具
    array(
        'category_cn' => '视频剪辑工具',
        'category_en' => 'Video Editing Software',
        'subcategories' => array(
            array(
                'title' => '专业剪辑软件',
                'tools' => array(
                    array('name' => 'Adobe Premiere Pro', 'link' => 'https://www.adobe.com/products/premiere.html'),
                    array('name' => 'Final Cut Pro', 'link' => 'https://www.apple.com/final-cut-pro/')
                )
            ),
            array(
                'title' => '轻量级剪辑工具',
                'tools' => array(
                    array('name' => 'DaVinci Resolve', 'link' => 'https://www.blackmagicdesign.com/products/davinciresolve'),
                    array('name' => 'Filmora', 'link' => 'https://filmora.wondershare.cn/'),
                    array('name' => 'Shotcut', 'link' => 'https://shotcut.org/')
                )
            ),
            array(
                'title' => '移动端剪辑',
                'tools' => array(
                    array('name' => 'CapCut', 'link' => 'https://www.capcut.com/'),
                    array('name' => 'VN Video Editor', 'link' => 'https://www.vlognow.me/'),
                    array('name' => 'InShot', 'link' => 'https://inshot.com/')
                )
            ),
            array(
                'title' => '动画 & 视觉特效',
                'tools' => array(
                    array('name' => 'After Effects', 'link' => 'https://www.adobe.com/products/aftereffects.html'),
                    array('name' => 'HitFilm Express', 'link' => 'https://fxhome.com/product/hitfilm'),
                    array('name' => 'Blender', 'link' => 'https://www.blender.org/')
                )
            )
        )
    ),

    // 4. 免费音乐库
    array(
        'category_cn' => '免费音乐库',
        'category_en' => 'Royalty-Free Music',
        'subcategories' => array(
            array(
                'title' => 'YouTube官方音频库',
                'tools' => array(
                    array('name' => 'YouTube Audio Library', 'link' => 'https://www.youtube.com/audiolibrary/music')
                )
            ),
            array(
                'title' => '免版权音乐平台',
                'tools' => array(
                    array('name' => 'Epidemic Sound', 'link' => 'https://www.epidemicsound.com/'),
                    array('name' => 'Artlist', 'link' => 'https://artlist.io/'),
                    array('name' => 'Bensound', 'link' => 'https://www.bensound.com/'),
                    array('name' => 'Pixabay Music', 'link' => 'https://pixabay.com/music/')
                )
            ),
            array(
                'title' => 'AI生成音乐',
                'tools' => array(
                    array('name' => 'AIVA', 'link' => 'https://www.aiva.ai/'),
                    array('name' => 'Boomy', 'link' => 'https://boomy.com/'),
                    array('name' => 'Mubert', 'link' => 'https://mubert.com/')
                )
            )
        )
    ),

    // 5. 免费图片 & 贴图资源
    array(
        'category_cn' => '免费图片 & 贴图资源',
        'category_en' => 'Stock Images & Graphics',
        'subcategories' => array(
            array(
                'title' => '免费图库',
                'tools' => array(
                    array('name' => 'Unsplash', 'link' => 'https://unsplash.com/'),
                    array('name' => 'Pexels', 'link' => 'https://www.pexels.com/'),
                    array('name' => 'Pixabay', 'link' => 'https://pixabay.com/')
                )
            ),
            array(
                'title' => '矢量图 & PNG',
                'tools' => array(
                    array('name' => 'Freepik', 'link' => 'https://www.freepik.com/'),
                    array('name' => 'Flaticon', 'link' => 'https://www.flaticon.com/'),
                    array('name' => 'Icons8', 'link' => 'https://icons8.com/')
                )
            ),
            array(
                'title' => '缩略图设计',
                'tools' => array(
                    array('name' => 'Canva', 'link' => 'https://www.canva.com/'),
                    array('name' => 'Adobe Express', 'link' => 'https://www.adobe.com/express'),
                    array('name' => 'Snappa', 'link' => 'https://snappa.com/')
                )
            )
        )
    ),

    // 6. 免费视频素材
    array(
        'category_cn' => '免费视频素材',
        'category_en' => 'Stock Footage & B-Roll',
        'subcategories' => array(
            array(
                'title' => '免费视频素材',
                'tools' => array(
                    array('name' => 'Pexels Video', 'link' => 'https://www.pexels.com/videos/'),
                    array('name' => 'Pixabay Video', 'link' => 'https://pixabay.com/videos/'),
                    array('name' => 'Videvo', 'link' => 'https://www.videvo.net/')
                )
            ),
            array(
                'title' => '高清电影级素材',
                'tools' => array(
                    array('name' => 'Mixkit', 'link' => 'https://mixkit.co/'),
                    array('name' => 'Coverr', 'link' => 'https://coverr.co/'),
                    array('name' => 'Motion Array', 'link' => 'https://motionarray.com/')
                )
            )
        )
    ),

    // 7. AI生成视频工具
    array(
        'category_cn' => 'AI生成视频工具',
        'category_en' => 'AI Video Creation Tools',
        'subcategories' => array(
            array(
                'title' => 'AI视频生成',
                'tools' => array(
                    array('name' => 'Runway ML', 'link' => 'https://runwayml.com/'),
                    array('name' => 'Synthesia', 'link' => 'https://www.synthesia.io/'),
                    array('name' => 'Pictory', 'link' => 'https://pictory.ai/'),
                    array('name' => 'DeepBrain AI', 'link' => 'https://www.deepbrain.io/')
                )
            ),
            array(
                'title' => '文本转动画',
                'tools' => array(
                    array('name' => 'D-ID', 'link' => 'https://www.d-id.com/'),
                    array('name' => 'HeyGen', 'link' => 'https://www.heygen.com/'),
                    array('name' => 'Steve.AI', 'link' => 'https://www.steve.ai/')
                )
            ),
            array(
                'title' => 'AI字幕 & 语音',
                'tools' => array(
                    array('name' => 'Descript', 'link' => 'https://www.descript.com/'),
                    array('name' => 'Kapwing', 'link' => 'https://www.kapwing.com/'),
                    array('name' => 'Speechelo', 'link' => 'https://speechelo.com/')
                )
            )
        )
    ),

    // 8. 文字 & 生成式AI工具
    array(
        'category_cn' => '文字 & 生成式AI工具',
        'category_en' => 'AI Writing & Scripting',
        'subcategories' => array(
            array(
                'title' => '视频脚本生成',
                'tools' => array(
                    array('name' => 'ChatGPT', 'link' => 'https://chat.openai.com/'),
                    array('name' => 'Rytr', 'link' => 'https://rytr.me/'),
                    array('name' => 'Jasper AI', 'link' => 'https://www.jasper.ai/')
                )
            ),
            array(
                'title' => 'AI标题 & 标签优化',
                'tools' => array(
                    array('name' => 'TubeBuddy AI', 'link' => 'https://www.tubebuddy.com/'),
                    array('name' => 'Headline Studio', 'link' => 'https://coschedule.com/headline-analyzer')
                )
            ),
            array(
                'title' => '自动字幕生成',
                'tools' => array(
                    array('name' => 'Otter.ai', 'link' => 'https://otter.ai/'),
                    array('name' => 'Rev.com', 'link' => 'https://www.rev.com/'),
                    array('name' => 'Veed.io', 'link' => 'https://www.veed.io/')
                )
            )
        )
    ),

    // 9. 直播工具
    array(
        'category_cn' => '直播工具',
        'category_en' => 'Live Streaming & Engagement',
        'subcategories' => array(
            array(
                'title' => '直播推流软件',
                'tools' => array(
                    array('name' => 'OBS Studio', 'link' => 'https://obsproject.com/'),
                    array('name' => 'Streamlabs', 'link' => 'https://streamlabs.com/'),
                    array('name' => 'XSplit', 'link' => 'https://www.xsplit.com/')
                )
            ),
            array(
                'title' => '直播互动 & 观众管理',
                'tools' => array(
                    array('name' => 'Restream', 'link' => 'https://restream.io/'),
                    array('name' => 'StreamYard', 'link' => 'https://streamyard.com/')
                )
            ),
            array(
                'title' => '虚拟主播 & VTuber工具',
                'tools' => array(
                    array('name' => 'VTube Studio', 'link' => 'https://store.steampowered.com/app/1325860/VTube_Studio/'),
                    array('name' => 'Live2D', 'link' => 'https://www.live2d.com/en/'),
                    array('name' => 'NVIDIA Broadcast', 'link' => 'https://www.nvidia.com/en-us/geforce/broadcasting/broadcast-app/')
                )
            )
        )
    ),

    // 10. YouTube增长 & 运营优化
    array(
        'category_cn' => 'YouTube增长 & 运营优化',
        'category_en' => 'Growth & Optimization Tools',
        'subcategories' => array(
            array(
                'title' => '频道管理 & 任务规划',
                'tools' => array(
                    array('name' => 'Trello', 'link' => 'https://trello.com/'),
                    array('name' => 'Notion', 'link' => 'https://www.notion.so/'),
                    array('name' => 'Airtable', 'link' => 'https://airtable.com/')
                )
            ),
            array(
                'title' => '社区互动 & 社群管理',
                'tools' => array(
                    array('name' => 'Discord', 'link' => 'https://discord.com/'),
                    array('name' => 'Patreon', 'link' => 'https://www.patreon.com/'),
                    array('name' => 'Ko-fi', 'link' => 'https://ko-fi.com/')
                )
            ),
            array(
                'title' => '广告 & 变现工具',
                'tools' => array(
                    array('name' => 'Google AdSense', 'link' => 'https://www.google.com/adsense/'),
                    array('name' => 'Affiliate Networks', 'link' => 'https://www.shareasale.com/'),
                    array('name' => 'Buy Me a Coffee', 'link' => 'https://www.buymeacoffee.com/')
                )
            )
        )
    ),

    // 11. 额外推荐：插件 & 增强工具
    array(
        'category_cn' => '额外推荐：插件 & 增强工具',
        'category_en' => 'Chrome Extensions & Add-ons',
        'subcategories' => array(
            array(
                'title' => 'YouTube增强插件',
                'tools' => array(
                    array('name' => 'Enhancer for YouTube', 'link' => 'https://chrome.google.com/webstore/detail/enhancer-for-youtube/bcitakcpohepflldcbngkgggncnhdnkk'),
                    array('name' => 'Magic Actions', 'link' => 'https://chrome.google.com/webstore/detail/magic-actions-for-youtube/bocjfdhedmkieehngbbhbdgcnhkbknca')
                )
            ),
            array(
                'title' => 'SEO & 关键词优化',
                'tools' => array(
                    array('name' => 'TubeBuddy', 'link' => 'https://www.tubebuddy.com/'),
                    array('name' => 'VidIQ', 'link' => 'https://vidiq.com/')
                )
            ),
            array(
                'title' => '生产力提升',
                'tools' => array(
                    array('name' => 'Grammarly', 'link' => 'https://grammarly.com/'),
                    array('name' => 'Toby for Tabs', 'link' => 'https://www.gettoby.com/')
                )
            )
        )
    )

);
?>

<!-- 内联样式：如需全局使用，可移到 style.css -->
<style>
/* 1. 减小顶部边距：my-3 而非 my-5 */

/* 2. 标题左对齐：去掉 text-center */

/* 卡片整体内边距 */
.card-body {
  padding: 1.25rem;
}

/* 子分类块的下边距 */
.subcategory-block {
  margin-bottom: 1.5rem;
}
.subcategory-block h6 {
  margin-bottom: 0.5rem;
  font-weight: 600;
}

/* 自定义工具列表样式 */
.subcategory-list {
  list-style: none;
  padding-left: 0;
  margin: 0;
}
/* 4. 让工具纵向排列：使用 display: block */
.subcategory-list li {
  margin-bottom: 0.5rem;
  position: relative;
  padding-left: 1rem; /* 留出位置给 bullet */
  display: block;
}
/* 3. bullet再小些：font-size: 0.4rem */
.subcategory-list li::before {
  content: "■";
  color: #FF0000;
  font-size: 0.4rem;
  position: absolute;
  left: 0;
  top: 50%;
  transform: translateY(-50%);
}

/* 工具链接样式 */
.subcategory-list li a {
  color: #333;
  text-decoration: none;
}
.subcategory-list li a:hover {
  color: #FF0000;
  text-decoration: underline;
}

/* 一级分类标题：中文与英文分两行显示 */
.category-title {
  font-weight: 700;
  font-size: 1.1rem;
  line-height: 1.4;
}
.category-title small {
  display: block;
  font-size: 0.9rem;
  font-weight: 400;
  margin-top: 2px;
}
</style>

<div class="container my-2"><!-- 改为 my-2 减小顶部空白 -->
  <!-- 去掉 text-center，让标题左对齐 -->
  <div class="section-title">
    <h5 class="font400 mb-4" style="font-family: 'KaiTi', '楷体', serif; font-style: italic; text-align: center;">
      “工欲善其事，必先利其器。” ——《论语》
    </h5>
    <!-- 标题左对齐 -->
    <h2><span><?php the_title(); ?></span></h2>
  </div>

  <?php
  $col_count = 0;
  echo '<div class="row">';
  foreach ( $tools_data as $category ) {
      $cat_cn = $category['category_cn'];
      $cat_en = $category['category_en'];
      $subcategories = $category['subcategories'];
      ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <div class="card-header">
            <div class="category-title">
              <?php echo esc_html($cat_cn); ?>
              <small><?php echo esc_html($cat_en); ?></small>
            </div>
          </div>
          <div class="card-body">
            <?php if ( !empty($subcategories) ) : ?>
              <?php foreach ( $subcategories as $subcat ) {
                  $subcat_title = $subcat['title'];
                  $tools = $subcat['tools'];
                  ?>
                  <div class="subcategory-block">
                    <h6><?php echo esc_html($subcat_title); ?></h6>
                    <?php if ( !empty($tools) ) : ?>
                      <ul class="subcategory-list">
                        <?php foreach ( $tools as $tool ) : ?>
                          <li>
                            <a href="<?php echo esc_url($tool['link']); ?>" target="_blank">
                              <?php echo esc_html($tool['name']); ?>
                            </a>
                          </li>
                        <?php endforeach; ?>
                      </ul>
                    <?php endif; ?>
                  </div>
              <?php } ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php
      $col_count++;
      if ( $col_count % 3 == 0 ) {
          echo '</div><div class="row">';
      }
  }
  if ( $col_count % 3 != 0 ) {
      echo '</div>';
  }
  ?>
</div><!-- .container -->

<?php get_footer(); ?>
