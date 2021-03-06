<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
<?php
$next_post = get_next_post();
$previous_post = get_previous_post();
$categorys = get_the_category(get_the_ID());

?>
<script type="text/javascript" src="http://www.lalaberlin.com/skin/frontend/default/lalaberlin/js/CSSPlugin.min.js"></script>
<article id="info" <?php post_class(); ?>>
	<header class="entry-header">

		<div class="post-views-details std row">
			<div class="small-12 medium-6 large-6 columns des">

				<!-- title Articles -->
				<?php if ( is_single() ) : ?>
					<h5><?php echo qtrans_use(mage_get_language(),the_title(false)); ?></h5>
					<?php
					$post_type_desc = get_post_custom(get_the_ID(false));
					if ( !empty($post_type_desc) AND isset($post_type_desc['wpcf-post-description']) AND is_array($post_type_desc['wpcf-post-description']) AND count($post_type_desc['wpcf-post-description']) )
					{
						echo '
							<div class="post-type-description">
								'.$post_type_desc['wpcf-post-description'][0].'
							</div>
						';
					}
					?>
					<!-- Tags Articles -->
					<div class="entry-tags padding-bottom-50-px">
					<?php
					/*date time created post*/
					echo '['.get_the_date("d-m-Y").'] ';
					/*Category */
					$tags = get_the_tags();
					if ( $categorys AND is_array($categorys) AND count($categorys) )
					{
						echo '- [Category: ';
						foreach ($categorys as $cate)
						{
							echo '<a href="'.qtrans_convertURL(get_category_link($cate), mage_get_language()).'">'.qtrans_use(mage_get_language(), $cate->name).'</a> ';
						}
						echo ']'.(!empty($tags) ? '[' : '');
					}
					the_tags();
					if ( $tags )
					{
						echo ']';
					}
					?>
					</div>
				<?php else : ?>
					<h5>
						<a href="<?php qtrans_convertURL(the_permalink(), mage_get_language()); ?>" rel="bookmark"><?php qtrans_use(mage_get_language(), the_title()); ?></a>
					</h5>

					<!-- Tags Articles -->
					<div class="entry-tags padding-bottom-50-px">
						<?php echo the_tags(); ?>
					</div>

				<?php endif; // is_single() ?>

			</div>
			<div class="small-12 medium-6 large-6 columns top-follow-lalaberlin">
				<div class="follow-us-lalaberlin">
					<!-- AddThis Button BEGIN -->
					<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
					<a class="addthis_button_facebook"></a>
					<a class="addthis_button_google_plusone_share"></a>
					<a class="addthis_button_pinterest_share"></a>
					<a class="addthis_button_tumblr"></a>
					</div>
					<!-- AddThis Button END -->
				</div>
			</div>
		</div>
		<!-- Featuer Image -->
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
			<div class="entry-thumbnail" style="background-image: url('<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0]; ?>'); background-size: cover; background-position: center center;">
			</div>
		<?php endif; ?>
	</header><!-- .entry-header -->
	<div class="borderbot"></div>
	<!-- Content articles -->
	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else: ?>

		<?php if (qtrans_use(mage_get_language(), get_the_content() )) : ?>
			<div class="entry-content post-view-details-content std text-center">
				<?php qtrans_use(mage_get_language(), the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' )) ); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>

	<?php endif; ?>





	<?php if( get_field('lala_journal_posts') ): ?>
	    <?php while( has_sub_field("lala_journal_posts") ): ?>


	        <?php if( get_row_layout() == 'text-bereich' ){ ?>
	            <div class="repeater-articles std padding-left-right padding-top-bottom text justify">
					<ul><li style="text-align:center"><?php the_sub_field("text"); ?></li></ul>
				</div>
	        <?php } ?>

	        <?php if (get_row_layout() == "slider-bereich"): ?>
		        <?php
		        	$images = get_sub_field('slider');
		        ?>
				<?php
							$i=0;
				?>				<div class="image-gallery-single-post padding-top-bottom row">
					    			<div id="slider" class="flexslider">
					        		<ul class="slides row">
				            <?php foreach( $images as $image ): ?>
				                <li>
									<?php
										$position=strpos($image['caption'],"embed");
										$position=strpos($image['caption'],"iframe");
										if($position !== false){
											echo '<div class="video-container">'.$image['caption']."</div>";
										}else{

									?>
				                    <img src="<?php echo $image['sizes']['large'] ?>" alt="<?php echo $image['title']; ?>" />
				                   	<?php if (!empty($image['caption'])) { echo '<p>' . $image['caption'] . '</p>'; } ?>
									<?php
									}
									$i++;
									?>
				                </li>
				            <?php endforeach; ?>
									</ul>

						</div>

						<?php

							if (count($images) > 1){
							echo '<div class="control-flexslideshow-design">
									<a href="javascript:;" data-control="pre" class="control-design-left"></a>
									<span class="control-page-active" data-active="1">1</span>/<span data-total="'.$i.'" class="control-page-total">'.$i.'</span>
									<a href="javascript:;" data-control="next" class="control-design-right"></a>
								</div>';
							}
						?>
						</div>
	        <?php endif ?>

	        <?php
	            if (get_row_layout() == "qa-bereich"){
	                $rows = get_sub_field('qa');
	                if ($rows){
	                     echo '
							<div class="repeater-articles single_post_qa_repeater_articles std padding-left-right padding-top-bottom justify">
								<ul>';
	                    foreach($rows as $row){
	                        echo '
				                <li>
				                	<span class="single-label">'.$row['frage'].'</span>
				                    <span class="single-value">'.$row['antwort'].'</span>
				                </li>';
	                    }
	                    echo '
				            </ul>
						</div>';
	                }
	            }
	        ?>
			<?php
	            if (get_row_layout() == "quote_text"){

	                ?>
					<div class="single_post_description padding-left-right padding-top-bottom justify">
						<div class="single_post_border_top"></div>
						<div class="single_post_content padding-top-bottom">
							<?php echo '&ldquo;'.get_sub_field("quotes_text").'&rdquo;'; ?>
						</div>
						<div class="single_post_border_bottom"></div>
					</div>
				<?php
				}?>
	        <?php if (get_row_layout() == "gallery-bereich"): ?>
	        	<?php
	        		$galleryFeature = get_sub_field('gallery');$i=0;$j=0;
	        	?>
				<?php

					echo '
					<div class="single-post-gallery-feature padding-top-bottom">
						<ul class="row">';
			           	foreach( $galleryFeature as $gallery )
			           	{
			           		echo '
			                <li class="medium-4 columns " data-ind="'.$i.'">
			                	<img class="th stand-img" src="' . dirname(get_site_url()).'/lib/timthumb.php?src='.$gallery['url'].'&w=400&h=370" alt="'.$gallery['title'].'" />
			                </li>';$i++;
			           	}
			           	echo '
			            </ul>
			            <div class="images-zoom-wrap">
						    <ul class="images-zoom">';
						    foreach( $galleryFeature as  $gallery )
			           	{
			           		echo '
			                <li class="img-zoom-item item-'.$j.'"><img data-src="'.$gallery['url'].'" src="" alt=""></li>';
							$j++;
			           	}
			           	echo '
						    </ul>
						    <div class="btn-handler">
						        <span id="view-prev-zoom" data-control="pre" class=""></span>
						        <span class="close-icon"></span>
						        <span id="view-next-zoom" data-control="next" class=""></span>
						    </div>
						</div>
					</div>';

				?>

	        <?php endif ?>

	        <?php
	            if (get_row_layout() == "links-bereich"){
	                $rows = get_sub_field('links');

	                if ($rows){
	                    echo '<div class="single_post-external row padding-left-right padding-top-bottom">';
						echo '<h4 class="single_post-external-title">External links</h4><ul>';
	                    foreach($rows as $row){
	                        echo '<li><a href="'.$row['link'].'" target="_blank">'.$row['titel'].'</a></li>';
	                    }
	                    echo '</ul></div>';
	                }
	            }
	        ?>

	        <?php if( get_row_layout() == 'musik-bereich' ){ ?>
	            <div class="single-post-embed-feature padding-left-right padding-top-bottom"><?php the_sub_field("embed_code"); ?></div>
	        <?php } ?>

	        <?php
	            if (get_row_layout() == "information-bereich"){
					echo "<div class='content_infor padding-left-right padding-top-bottom'>";
				?>
	                <h1 class="title_infor"><?php echo the_sub_field("titel");?></h1>
					<p class="sub_infor"><?php   echo the_sub_field("text");?></p>
					<?php echo "</div>";
	            }
	        ?>


			<?php
	            if (get_row_layout() == "produkte_mutil"){
	                $rows = get_sub_field('produktea');
	                if ($rows){?>
						<div class="produkte-feature padding-left-right padding-top-bottom">
						<h1 class="title_infor">Related Products</h1>
							<ul class="row">
								<?php  	foreach($rows as $row){
												$image = wp_get_attachment_image_src($row['produkt-bild'], 'medium');
									?>
								<li class="small-12 medium-4 large-4">
									<div class="group-product">
										<a class="product-image" href="<?php echo $row["produkt-link"]; ?>">
											<img class="th" src="<?php echo $image[0]; ?>" alt="<?php echo $row["produkt-name"]; ?>" />
										</a>
										<div class="product-caption">
											<div class="product-caption-name"><a class="product-image" href="<?php echo $row["produkt-link"]; ?>"><?php echo $row["produkt-name"]; ?></a></div>
										</div>
									</div>
								</li>
								<?php }?>
							</ul>
						</div>
					<?php
	                }
	            }
	        ?>


			<?php if (get_row_layout() == "produkte-bereich"): ?>
				<div class="produkte-feature padding-left-right padding-top-bottom">
					<h1 class="title_infor">Related Products</h1>
					<ul class="row">
						<li class="small-12 medium-4 large-4">
							<div class="group-product">
			            		<a class="product-image" href="<?php echo the_sub_field("produkt-link"); ?>">
			            			<img class="th" src="<?php $image = wp_get_attachment_image_src(get_sub_field('produkt-bild'), 'medium'); echo $image[0]; ?>" alt="<?php echo the_sub_field("produkt-name"); ?>" />
			            		</a>
			            		<div class="product-caption">
			            			<div class="product-caption-name"><a class="product-image" href="<?php echo $row["produkt-link"]; ?>"><?php echo the_sub_field("produkt-name") ?></a></div>
			            		</div>
			            	</div>
						</li>
					</ul>
				</div>
			<?php endif ?>

				<?php if( get_row_layout() == 'author-info' ){ ?>
				<div class="author-info padding-left-right padding-top-bottom">
<!-- 				<h1></h1> -->
					<div class="author small-12 medium-4 large-4">
					<!-- <?php echo get_sub_field('image') . '/' . get_sub_field('info')  ?>  -->
						<img src="<?php $image = wp_get_attachment_image_src(get_sub_field('image'), 'medium'); echo $image[0]; ?>" alt="<?php echo get_sub_field("info"); ?>">
						<span>
							<?php the_sub_field("info") ?>
						</span>
					</div>
				</div>
				<?php } ?>

	    <?php endwhile; ?>
	<?php endif; ?>



	<div class="control-panel-articles row">
		<div class="small-12 medium-4 large-4 columns control-back-to-view">
			<a href="<?php echo ( is_array($categorys) AND count($categorys) ) ? qtrans_convertURL(get_home_url(),mage_get_language()) : '#'; ?>" class="disabledBtn btn-back"><?php echo __('Back to overview')?></a>
		</div>
		<div class="small-12 medium-4 large-4 columns text-align-center control-panel-articles-middle">
			<a href="<?php echo get_permalink( $previous_post->ID ); ?>" class=" disabledBtn btn-pre"><?php echo __('Prev')?></a>
			<a href="<?php echo get_permalink( $next_post->ID ); ?>" class=" disabledBtn btn-next"><span></span><?php echo __('Next')?></a>
		</div>
		<div  class="small-12 medium-4 large-4 columns text-align-right">
			<div class="follow-us-lalaberlin">
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
					<a class="addthis_button_facebook"></a>
					<a class="addthis_button_google_plusone_share"></a>
					<a class="addthis_button_pinterest_share"></a>
					<a class="addthis_button_tumblr"></a>
				</div>
					<!-- AddThis Button END -->

			</div>
		</div>
	</div>

	<!-- Other Articles -->
	<?php
		$args = array(
		    'posts_per_page' => 3,
		    'offset' => 0,
		    'category' => the_category_ID(false),
		    'orderby' => 'post_date',
		    'order' => 'DESC',
		    'post_type' => 'post',
		    'post_status' => 'publish',
		    'suppress_filters' => true
		);
		$posts = wp_get_recent_posts($args);

		if ( !empty($posts) AND is_array($posts) AND count($posts) )
		{
			echo '
			<div class="other-articles-related-posts home-page-recent-articles">
				<div class="other-articles-title">'.__('Related Posts').'</div>
				<div class="row">';
			foreach ($posts as $post)
			{
				$des=(get_post_meta($post['ID'],'wpcf-post-description'));
				echo '
				<div class="small-12 medium-4 large-4 large-recent-articles columns">
					<div class="home-page-recent-articles-image">
						<img src="'.(dirname(get_site_url()).'/lib/timthumb.php?src='.wp_get_attachment_url( get_post_thumbnail_id($post['ID']) ).'&w=412&h=252').'" />
						<a class="a-view-more" href="'.qtrans_convertURL(get_permalink($post['ID']), mage_get_language()).'"><span>'.__('View').'</span></a>
					</div>
					<div class="home-page-recent-articles-description">
						<div class="title"><a href="'.qtrans_convertURL(get_permalink($post['ID']), mage_get_language()).'">'.qtrans_use(mage_get_language(),get_the_title($post['ID'])).'</a></div>
						<div class="description">'.$des[0].'</div>
						<div class="bottom">
							<div class="bottom-view"><a href="'.qtrans_convertURL(get_permalink($post['ID']), mage_get_language()).'">'.__('View post').'</a></div>
							<div class="bottom-date">['.date("d-m-Y", strtotime($post['post_date'])).']</div>
						</div>
					</div>
				</div>';
			}

			echo'
				</div>
			</div>
			';
		}
	?>

</article><!-- #post -->
