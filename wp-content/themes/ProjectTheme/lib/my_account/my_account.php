<?php
/***************************************************************************
*
*	ProjectTheme - copyright (c) - sitemile.com
*	The only project theme for wordpress on the world wide web.
*
*	Coder: Andrei Dragos Saioc
*	Email: sitemile[at]sitemile.com | andreisaioc[at]gmail.com
*	More info about the theme here: http://sitemile.com/products/wordpress-project-freelancer-theme/
*	since v1.2.5.3
*
***************************************************************************/


function ProjectTheme_my_account_area_main_function()
{
	
				
				global $current_user, $wp_query;
				get_currentuserinfo();
				
				$uid = $current_user->ID;
	
	
?>
    	<div id="content">
        	<?php
			
			
				if(ProjectTheme_is_user_business($uid)):
			
			
			?>
            <div class="my_box3">            
            	<div class="box_title"><?php _e("Your Latest Posted Projects", "ProjectTheme"); ?></div>
                <div class="box_content "> 
            	
                 <?php
							
			
				$query_vars = $wp_query->query_vars;
				$post_per_page = 3;				
				
				global $wp_query;
				$query_vars = $wp_query->query_vars;
				$post_per_page = 5;				
				
			
		
					
				$closed = array(
						'key' => 'closed',
						'value' => "0",
						'compare' => '='
					);	
					
				$paid = array(
						'key' => 'paid',
						'value' => "1",
						'compare' => '='
					);		
				
				$args = array('post_type' => 'project', 'author' => $uid, 'order' => 'DESC', 'orderby' => 'date', 'posts_per_page' => $post_per_page,
				'paged' => 1, 'meta_query' => array($paid, $closed), 'post_status' =>array('draft','publish') );
				
				query_posts($args);
				
			//	query_posts( "meta_key=closed&meta_value=0&post_status=publish,draft&post_type=project&order=DESC&orderby=date&author=".$uid.
			//	"&posts_per_page=".$post_per_page."&paged=".$query_vars['paged'] );

				if(have_posts()) :
				while ( have_posts() ) : the_post();
					projectTheme_get_post();
				endwhile;
				
				//if(function_exists('wp_pagenavi')):
				//wp_pagenavi(); endif;
				
				 else:
				
				_e("There are no projects yet.",'ProjectTheme');
				
				endif;
				
				wp_reset_query();

				
				?>

              </div>
           </div>
           
           
           <div class="my_box3">
          
            
            	<div class="box_title"><?php _e("My Unpublished &amp; Unpaid Projects",'ProjectTheme'); ?></div>
                <div class="box_content">    
			
			
				<?php

				query_posts( "post_status=draft&meta_key=paid&meta_value=0&post_type=project&order=DESC&orderby=id&author=".$uid."&posts_per_page=3" );
				
				if(have_posts()) :
				while ( have_posts() ) : the_post();
					projectTheme_get_post(array('unpaid'));
				endwhile; else:
				
				_e("There are no projects yet.",'ProjectTheme');
				
				endif;
				
				wp_reset_query();
				
				?>
			
			</div>
			</div>
	
			
			
			<div class="clear10"></div>
			
			
			<div class="my_box3">
        
            
            	<div class="box_title"><?php _e("My Latest Closed Projects",'ProjectTheme'); ?></div>
                <div class="box_content">    
			
			
				<?php

				query_posts( "meta_key=closed&meta_value=1&post_type=project&order=DESC&orderby=id&author=".$uid."&posts_per_page=3" );

				if(have_posts()) :
				while ( have_posts() ) : the_post();
					projectTheme_get_post();
				endwhile; else:
				
				_e("There are no projects yet.",'ProjectTheme');
				
				endif;
				wp_reset_query();
				
				?>

			</div>
			</div>
		
        <?php endif; ?>
        
        <?php if(ProjectTheme_is_user_provider($uid)): ?>	
           
           
        <div class="my_box3">
        
            
            	<div class="box_title"><?php _e("Outstanding Projects",'ProjectTheme'); ?></div>
                <div class="box_content">    
			
			
				<?php
				
				global $wp_query;
				$query_vars = $wp_query->query_vars;
				$post_per_page = 3;				
				
		
				$outstanding = array(
						'key' => 'outstanding',
						'value' => "1",
						'compare' => '='
					);
					
				$winner = array(
						'key' => 'winner',
						'value' => $uid,
						'compare' => '='
					);		
				
				$args = array('post_type' => 'project', 'order' => 'DESC', 'orderby' => 'date', 'posts_per_page' => $post_per_page,
				'paged' => 1, 'meta_query' => array($outstanding, $winner));
				
				
				query_posts( $args  );

				if(have_posts()) :
				while ( have_posts() ) : the_post();
					projectTheme_get_post_outstanding_project();
				endwhile; else:
				
				_e("There are no projects yet.",'ProjectTheme');
				
				endif;
				wp_reset_query();
				
				?>

			</div>
			</div>   
           
           
           
           
           
        <div class="my_box3">
        
            
            	<div class="box_title"><?php _e("My Latest Bids",'ProjectTheme'); ?></div>
                <div class="box_content">    
			
			
				<?php

				query_posts( "meta_key=bid&meta_value=".$uid."&post_type=project&order=DESC&orderby=id&posts_per_page=3" );

				if(have_posts()) :
				while ( have_posts() ) : the_post();
					projectTheme_get_post();
				endwhile; else:
				
				_e("There are no projects yet.",'ProjectTheme');
				
				endif;
				wp_reset_query();
				
				?>

			</div>
			</div>
            
            
            
            <div class="my_box3">
        
            
            	<div class="box_title"><?php _e("My Latest Won Projects",'ProjectTheme'); ?></div>
                <div class="box_content">    
			
			
				<?php

				query_posts( "meta_key=winner&meta_value=".$uid."&post_type=project&order=DESC&orderby=id&posts_per_page=3" );

				if(have_posts()) :
				while ( have_posts() ) : the_post();
					projectTheme_get_post();
				endwhile; else:
				
				_e("There are no projects yet.",'ProjectTheme');
				
				endif;
				wp_reset_query();
				
				?>

			</div>
			</div>
            
        
        <?php endif; ?>   
                
        </div> <!-- end dif content -->
        
        <?php ProjectTheme_get_users_links(); ?>
        
    
	
<?php	
} 


?>