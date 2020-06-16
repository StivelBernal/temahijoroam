<div id="posts">

<?php

if( have_posts() ){
    while( have_posts() ){
        the_post();
        ?>


       <div class="entry clearfix">
    <?php

            if( has_post_thumbnail() ){
                ?>
                <div class="entry-image">
                    <a href="<?php the_permalink(); ?>">
                        <?php 
                        the_post_thumbnail( 'medium', [ 
                            'class' => 'image_fade' 
                        ]); 
                        ?>
                    </a>
                </div>
                <?php
            }

            ?>
            <div class="entry-title">
                <h2>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>
            </div>
            <ul class="entry-meta clearfix nav">
                <li class="mr-2"><i class="fas fa-calendar"></i> <?php echo get_the_date(); ?></li>
                <li class="mr-2">
                    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                        <i class="fas fa-user"></i>
                        <?php the_author(); ?>
                    </a>
                </li>
                <li class="mr-2">
                    <i class="fas fa-folder-open"></i>
                    <?php the_category(' , '); ?>
                </li>
                <li class="mr-2">
                    <span>
                        <i class="fas fa-comments"></i>
                        <?php comments_number(); ?>
                    </span>
                </li>
            </ul>
            <div class="entry-content">
                <?php the_excerpt(); ?>

                <nav class="nav my-5">
                <a href="<?php the_permalink(); ?>" class="btn btn-rounded btn-alternate mr-2 mr-md-5"><?php _e('leer más', 'ser'); ?> 
                <i class="fas fa-long-arrow-alt-right ml-2"></i></a>
                
                </nav>
                
            </div>
        </div>
      
      
        <?php
    }
}

?>


</div>