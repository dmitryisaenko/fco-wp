
                    <div class="w23 news-item">
                        <div class="news-item-media-block">
                            <div class="news-item-image <?=$postFormat;?>">
                                <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                                    <? if (get_post_format() === "video") {
                                        $youtube_id = get_field('youtube_link');
                                        $url = "<img src='https://img.youtube.com/vi/$youtube_id/mqdefault.jpg' style='height:165px;'>";
                                        echo $url;
                                    }
                                    
                                        else {
                                            if (has_post_thumbnail()){
                                                the_post_thumbnail( 'fco-news-logo-300px' );
                                            }
                                            else {
                                                echo "<img src='https://picsum.photos/300/200'>";
                                            }
                                        }

                                    
                                    ?>
                                </a>
                            </div>
                            <div class="news-item-meta">
                                <div class="news-date">
                                    <?=get_the_date('j.n.Y'); ?>
                                </div>
                                <div class="news-category">
                                    <?=get_the_category_by_ID(1); ?>
                                </div>
                            </div>
                        </div>
                        <div class="news-item-title">
                            <span>
                                <a href="<?php the_permalink() ?>"
                                    title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                            </span>
                        </div>
                    </div>

                