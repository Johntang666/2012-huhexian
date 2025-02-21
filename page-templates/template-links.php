<?php
/*
Template Name: 友情链接
*/
?>
<?php get_header(); ?>

<div id="primary" class="site-content">
    <div class="breadcrumb">
        <?php the_crumbs(); ?>
	</div>
    <div id="content" class="site-main template-links" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<div class="single-content link_clr">
						<?php the_content(); ?>
						<div class="clear"></div>
						<?php
							$args = array(
							    'orderby'           => 'slug', 
							    'order'             => 'ASC'
							);


							function get_the_link_items_a($id = null)
					      {
					        $bookmarks = get_bookmarks('orderby=date&category=' . $id);
					        $default_ico = 'https://s.w.org/favicon.ico?2';
					        $output = '';
					        if (!empty($bookmarks)) {
					          $output .= '<div><ul>';
					          foreach ($bookmarks as $bookmark) {
					            $output .= '<li style="display: inline-block;width: 203px;line-height: 10px;margin: 0 10px 10px 0;padding: 15px 0px 15px 15px;list-style-type: none;background: rgb(0 0 0 / 2%);transition: .5s;box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.1) inset;"><img style="border: 0;-ms-interpolation-mode: bicubic;width: 30px;height: 30px;padding: 0;border: none;display: block;" src="https://zuofei.net/ico/?url=' . $bookmark->link_url . '" onerror="javascript:this.src=\'' . $default_ico . '\'" /><a style="color: #21759b;float: left;margin: -20px 0px 0px 40px;color: #555;text-decoration: none;box-shadow: none;" href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '" target="_blank" >' . $bookmark->link_name . '</a></li>';
					          }
					          $output .= '</ul></div><div class="clear"></div>';
					        }
					        return $output;
					      }


						    $linkcats = get_terms('link_category',$args);
						    $result = '';
						    if (!empty($linkcats)) {
						        foreach ($linkcats as $linkcat) {
						            $result .= '
						            <h2 class="links-category-title">' . $linkcat->name . '</h2>';
						            $result .= get_the_link_items_a($linkcat->term_id);
						        }
						    } else {
						        $result = get_the_link_items_a();
						    }
						    echo $result;
						?>
						<div class="clear"></div>
					</div> <!-- .single-content -->
					<div class="clear"></div>
				</div><!-- .entry-content -->

				<?php
                    //文章结尾插入指定内容
                    if ( ox_get_option( 'article_info_foot' ) ) {
                        echo '<div class="article_info_foot">'.ox_get_option( 'article_info_foot' ).'</div>';
                    }
                ?>

                <div class="clear"></div>
                
                <footer class="entry-meta-single">
                    <?php  if (function_exists('the_views')) : ?>
                        <span class="views">
                            <?php the_views($display = true, $prefix = '浏览:&nbsp;', $postfix = '', $always = false); ?>
                        </span>
                    <?php endif; ?>
                </footer><!-- .entry-meta -->

			</article><!-- #page -->
		<?php endwhile; ?>

		<?php if ( comments_open() || get_comments_number() ) : ?>
			<?php comments_template( '', true ); ?>
		<?php endif; ?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
