<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


		$woo_custom_option_plugin =  get_option( 'woo_custom_option_plugin' );

		if($woo_custom_option_plugin == 1) {
			
			add_filter( 'woocommerce_add_cart_item',  'add_cart_item' , 20, 1 );

			// Load cart data per page load
			add_filter( 'woocommerce_get_cart_item_from_session', 'get_cart_item_from_session' , 20, 2 );

			// Get item data to display
			add_filter( 'woocommerce_get_item_data',  'get_item_data' , 10, 2 );

			// Add item data to the cart
			add_filter( 'woocommerce_add_cart_item_data',  'add_to_cart_product' , 10, 2 );

			// Validate when adding to cart
			add_filter( 'woocommerce_add_to_cart_validation',  'validate_add_cart_product' , 10, 3 );

			// Add meta to order
			add_action( 'woocommerce_add_order_item_meta',  'order_item_meta' , 10, 2 );
		
		}
		
		add_action('admin_menu', 'register_custom_options_submenu_page',99);
		
		function register_custom_options_submenu_page() {
		
			add_menu_page( 'phoeniixx', __( 'Phoeniixx', 'phe' ), 'nosuchcapability', 'phoeniixx', NULL, custom_Options_plugin_dir_url.'/images/logo-wp.png', 57 );
        
			add_submenu_page( 'phoeniixx', 'Custom Options', 'Custom Options', 'manage_options', 'custom_options_setting', 'custom_options_setting' ); 
		
		}
		
		function custom_options_setting() {
			
			if( !empty( $_POST['submit'] )  && sanitize_text_field( $_POST['submit'] ) ) {
				
				
				if ( ! isset( $_POST['phoe_custom_options_lite_setting_nonce'] ) || ! wp_verify_nonce( $_POST['phoe_custom_options_lite_setting_nonce'], 'phoe_custom_options_lite_setting_submit' ) ) 
				{

				   print 'Sorry, your nonce did not verify.';
				   exit;

				}
				else
				{
					
						$checkco = sanitize_text_field(  $_POST['checkco'] );
						
						$checkco = ($checkco == '' ? '0' : '1'); 
						
						update_option( 'woo_custom_option_plugin', $checkco );
					
						
						$showot = sanitize_text_field(  $_POST['showot'] );
						
						$showot = ($showot == '' ? '0' : '1'); 
						
						update_option( 'woo_custom_option_optn_total', $showot );
				

						$showft = sanitize_text_field(  $_POST['showft'] );
						
						$showft = ($showft == '' ? '0' : '1'); 
						
						update_option( 'woo_custom_option_fnl_total', $showft );
				
					
				}

			}

			?>
			
			<div id="profile-page" class="wrap">
			
				<?php
				
					$woo_custom_option_plugin =  get_option( 'woo_custom_option_plugin' );
					
					$woo_custom_option_optn_total =  get_option( 'woo_custom_option_optn_total' );
					
					$woo_custom_option_fnl_total =  get_option( 'woo_custom_option_fnl_total' );
					
					//$tab = $_GET['tab'];
					if( isset( $_GET['tab'] ) ) {
	
						$tab = sanitize_text_field( $_GET['tab'] );
						
					}
					else
					{
						
						$tab = '';
						
					}

				?>
				<h2>
					<?php _e('WooCommerce Custom Options - Plugin Options', 'custom-options'); ?>
				</h2>
				<h2 class="nav-tab-wrapper woo-nav-tab-wrapper">
					<a class="nav-tab <?php if($tab == 'general' || $tab == ''){ echo ( "nav-tab-active" ); } ?>" href="?page=custom_options_setting&amp;tab=general"><?php _e('General', 'custom-options'); ?></a>
					<a class="nav-tab <?php if($tab == 'premium'){ echo ( "nav-tab-active" ); } ?>" href="?page=custom_options_setting&amp;tab=premium"><?php _e('Premium', 'custom-options'); ?></a>
				</h2>
					
					<?php 
                        
                        $plugin_dir_url =  plugin_dir_url( __FILE__ );
                        
						if($tab == 'general' || $tab == '')
						{
						  
                          
							?>
  
							<div class="meta-box-sortables" id="normal-sortables">
								<div class="postbox " id="pho_wcpc_box">
									<h3>&nbsp;&nbsp;&nbsp;<span class="upgrade-heading"><?php _e('Upgrade to the PREMIUM VERSION OF CUSTOM OPTIONS', 'custom-options'); ?></span></h3>
									<div class="inside">
										<div class="pho_premium_box">

											<div class="column two">
												<!-----<h2>Get access to Pro Features</h2>----->

												<p></p>

													<div class="pho-upgrade-btn">
														<a href="https://www.phoeniixx.com/product/woocommerce-product-custom-options/" target="_blank"><img src="<?php echo $plugin_dir_url; ?>../images/premium-btn.png" /></a>
														<a target="blank" href="http://customoption.phoeniixxdemo.com/"><img src="<?php echo $plugin_dir_url; ?>../images/demo-btn.png" /></a>
													</div>
											</div>
										</div>
									</div>
								</div>
							</div>  
							
							<div class="phoe_video_main">
								<h3><?php _e('How to set up plugin', 'custom-options'); ?></h3> 
							
								<iframe width="800" height="360"
									src="https://www.youtube.com/embed/ElmB8geNYA0">
								</iframe> 
							</div>		
                            
							<form novalidate="novalidate" method="post" action="" >
							<?php wp_nonce_field( 'phoe_custom_options_lite_setting_submit', 'phoe_custom_options_lite_setting_nonce' ); ?>
							<table class="form-table">

								<tbody>

									<h3><?php _e('General Options', 'custom-options'); ?></h3>
									
									<tr class="user-nickname-wrap">

										<th><label for="checkco"><?php _e('Enable Custom Options', 'custom-options'); ?></label></th>

										<td><input type="checkbox" value="1" <?php if($woo_custom_option_plugin == 1){ echo "checked"; }  ?> id="checkco" name="checkco" ></label></td>

									</tr>
									
									<tr class="user-nickname-wrap">

										<th><label for="showot"><?php _e('Show Options Total', 'custom-options'); ?></label></th>

										<td><input type="checkbox" value="1" <?php if($woo_custom_option_optn_total == 1){ echo "checked"; } ?> id="showot" name="showot" ></label></td>

									</tr>
									
									<tr class="user-nickname-wrap">

										<th><label for="showft"><?php _e('Show Final Total', 'custom-options'); ?></label></th>

										<td><input type="checkbox" value="1" <?php if($woo_custom_option_fnl_total == 1){ echo "checked"; } ?> id="showft" name="showft" ></label></td>

									</tr>
									
								</tbody>	

							</table>
							
							
							<p class="submit"><input type="submit" value="Save" class="button button-primary" id="submit" name="submit"></p>
							</form>
							
							<style>
								.phoe_video_main {
									padding: 20px;
									text-align: center;
								}
								
								.phoe_video_main h3 {
									color: #02c277;
									font-size: 28px;
									font-weight: bolder;
									margin: 20px 0;
									text-transform: capitalize
									display: inline-block;
								}
							</style>
								
							<?php
						}
						else if($tab == 'premium')
						{
						  
							?>

							<style>
							/*upgrade css*/

							.upgrade{background:#f4f4f9;padding: 50px 0; width:100%; clear: both;}
							.upgrade .upgrade-box{ background-color: #808a97;
							color: #fff;
							margin: 0 auto;
							min-height: 110px;
							position: relative;
							width: 60%;}

							.upgrade .upgrade-box p{ font-size: 15px;
							padding: 19px 20px;
							text-align: center;}

							.upgrade .upgrade-box a{background: none repeat scroll 0 0 #6cab3d;
							border-color: #ff643f;
							color: #fff;
							display: inline-block;
							font-size: 17px;
							left: 50%;
							margin-left: -150px;
							outline: medium none;
							padding: 11px 6px;
							position: absolute;
							text-align: center;
							text-decoration: none;
							top: 36%;
							width: 277px;}

							.upgrade .upgrade-box a:hover{background: none repeat scroll 0 0 #72b93c;}

							/**premium box**/    
							.premium-box{ width:100%; height:auto; background:#fff; float:left; }
							.premium-features{}
							.premium-heading{color:#484747;font-size: 40px; padding-top:35px;text-align:center;text-transform:uppercase;}
							.premium-features li{ width:100%; float:left;  padding: 80px 0; margin: 0; }
							.premium-features li .detail{ width:50%; }
							.premium-features li .img-box{ width:50%; }

							.premium-features li:nth-child(odd) { background:#f4f4f9; }
							.premium-features li:nth-child(odd) .detail{float:right; text-align:left; }
							.premium-features li:nth-child(odd) .detail .inner-detail{}
							.premium-features li:nth-child(odd) .detail p{ }
							.premium-features li:nth-child(odd) .img-box{ float:left; text-align:right;}

							.premium-features li:nth-child(even){  }
							.premium-features li:nth-child(even) .detail{ float:left; text-align:right;}
							.premium-features li:nth-child(even) .detail .inner-detail{ margin-right: 46px;}
							.premium-features li:nth-child(even) .detail p{ float:right;} 
							.premium-features li:nth-child(even) .img-box{ float:right;}

							.premium-features .detail{}
							.premium-features .detail h2{ color: #484747;  font-size: 24px; font-weight: 700; padding: 0;}
							.premium-features .detail p{  color: #484747;  font-size: 13px;  max-width: 327px;}

							/**images**/

							.custom-input-field { background:url("<?php echo custom_Options_plugin_dir_url; ?>/images/custom-input-field.png"); width:356px; height:194px; display:inline-block; margin-right: 25px; background-repeat:no-repeat;}

							.multiple-field{background:url("<?php echo custom_Options_plugin_dir_url; ?>/images/add-multiple-fields.png"); width:500px; height:229px; display:inline-block; margin-right:30px; background-size:500px auto; }

							.text-limit{background:url("<?php echo custom_Options_plugin_dir_url; ?>/images/text-limit.png"); width:248px;   height:209px; display:inline-block;}

							.input-field-conditonal{background:url("<?php echo custom_Options_plugin_dir_url; ?>/images/input-field-conditonal.png"); width:493px; height:76px; display:inline-block; margin-right: 30px;}	

							.add-description{background:url("<?php echo custom_Options_plugin_dir_url; ?>/images/add-description.png"); width:331px;   height:151px; display:inline-block; margin-right:30px; }					


							.multiple-styling{background:url("<?php echo custom_Options_plugin_dir_url; ?>/images/multiple-styling.png");  height: 930px; width: 533px; display:inline-block; background-size:500px auto; background-repeat:no-repeat; } 

							.premium-box-head {
							background: #eae8e7 none repeat scroll 0 0;
							height: 500px;
							text-align: center;
							width: 100%;
							}
							.pho-upgrade-btn {
							display: block;
							text-align: center;
							}
							.pho-upgrade-btn a {
							display: inline-block;
							margin-top: 75px;
							}
							.main-heading {
							background: #fff none repeat scroll 0 0;
							margin-bottom: -70px;
							text-align: center;
							}
							.main-heading img {
							margin-top: -200px;
							} 
							.premium-box-container {
							margin: 0 auto;
							}
							.premium-box-container .description:nth-child(2n+1) {
							background: #fff none repeat scroll 0 0;
							}
							.premium-box-container .description {
							display: block;
							padding: 35px 0;
							position: relative;
							text-align: center;
							}

							.premium-box-container .pho-desc-head::after {
							background: rgba(0, 0, 0, 0) url("<?php echo $plugin_dir_url; ?>../images/head-arrow.png") no-repeat scroll 0 0;
							content: "";
							height: 98px;
							position: absolute;
							right: 140px;
							top: 32px;
							width: 69px;
							}

							.premium-box-container .pho-desc-head h2 {
							color: #02c277;
							font-size: 28px;
							font-weight: bolder;
							margin: 0;
							text-transform: capitalize;
							}
							.pho-plugin-content {
							margin: 0 auto;
							overflow: hidden;
							width: 768px;
							}

							.premium-box-container .pho-plugin-content p {
							color: #212121;
							font-size: 18px;
							line-height: 32px;
							}

							.premium-box-container .description:nth-child(2n+1) .pho-img-bg {
							background: #f1f1f1 url("<?php echo $plugin_dir_url; ?>../images/image-frame-odd.png") no-repeat scroll 100% top;
							}
							.description .pho-plugin-content .pho-img-bg {
							border-radius: 5px 5px 0 0;
							height: auto;
							margin: 0 auto;
							padding: 70px 0 40px;
							width: 750px;
							}

							.premium-box-container .description:nth-child(2n) {
							background: #eae8e7 none repeat scroll 0 0;
							}
							.premium-box-container .description:nth-child(2n) .pho-img-bg {
							background: #f1f1f1 url("<?php echo $plugin_dir_url; ?>../images/image-frame-even.png") no-repeat scroll 100% top;
							} 

							.pho-upgrade-btn {
							display: block;
							text-align: center;
							}
							.pho-upgrade-btn a {
							display: inline-block;
							margin-top: 75px;
							}         

							</style>
							<div class="premium-box">

							<div class="premium-box-head">
							<div class="pho-upgrade-btn">
								<a href="https://www.phoeniixx.com/product/woocommerce-product-custom-options/" target="_blank"><img src="<?php echo $plugin_dir_url; ?>../images/premium-btn.png" /></a>
								<a target="blank" href="http://customoption.phoeniixxdemo.com/"><img src="<?php echo $plugin_dir_url; ?>../images/demo-btn.png" /></a>
							
							</div>
							</div>


							<ul class="premium-features">
							<div class="main-heading"><h1><img src="<?php echo $plugin_dir_url; ?>../images/premium-head.png" /></h1></div>

							<div class="premium-box-container">

							<div class="description">
							<div class="pho-desc-head"><h2><?php _e('Custom Input Fields', 'custom-options'); ?></h2></div>
							<div class="pho-plugin-content">
							<p>
							<?php _e('You could create Custom Input Fields Options (Text Field, Text Area, Check Box, Radio Button, File Upload, Quantity and Dropdown) depending upon the kind of inputs that are required by you. This would assist your users in filling the right kind of data in that particular field. ', 'custom-options'); ?>
							</p>

							<div class="pho-img-bg">
							<img src="<?php echo $plugin_dir_url; ?>../images/custom-input-field.png" />
							</div>   
							</div>

							</div><!-- description end -->
							
							
							<div class="description">
								<div class="pho-desc-head"><h2><?php _e('Create category based custom option', 'custom-options'); ?></h2></div>
								<div class="pho-plugin-content">
								<p>
									<?php _e('You could show options on all products at once and options could also be shown on the selected categories.', 'custom-options'); ?>   
								</p>

								<div class="pho-img-bg">
								<img src="<?php echo $plugin_dir_url; ?>../images/27.png" />
								</div>   
								</div>

							</div><!-- description end -->

							<div class="description">
							<div class="pho-desc-head"><h2><?php _e('Add multiple fields within Input Field', 'custom-options'); ?></h2></div>
							<div class="pho-plugin-content">
							<p>
							<?php _e('You are allowed to add multiple fields within the same Input Field, based on your requirement', 'custom-options'); ?>
							</p>

							<div class="pho-img-bg">
							<img src="<?php echo $plugin_dir_url; ?>../images/add-multiple-fields.png" />
							</div>   
							</div>

							</div><!-- description end -->
							
							<div class="description">
							<div class="pho-desc-head"><h2><?php _e('Price of options can be of two type:', 'custom-options'); ?></h2></div>
							<div class="pho-plugin-content">
							<p>
							<?php _e('You could add the option price in two ways i.e. Fixed price and other one is Percentage of Base price.', 'custom-options'); ?>
							</p>

							<div class="pho-img-bg">
							<img src="<?php echo $plugin_dir_url; ?>../images/price-of-option.png" />
							</div>   
							</div>

							</div><!-- description end -->

							<div class="description">
							<div class="pho-desc-head"><h2><?php _e('Define Text Limit on Input Field', 'custom-options'); ?></h2></div>
							<div class="pho-plugin-content">
							<p>
							<?php _e('Using this option, you could set a certain limit on the number of input characters. This will allow your users to be precise and specific. ', 'custom-options'); ?>
							</p>

							<div class="pho-img-bg">
							<img src="<?php echo $plugin_dir_url; ?>../images/input-field-conditonal.png" />
							</div>   
							</div>

							</div><!-- description end -->  

							<div class="description">
							<div class="pho-desc-head"><h2><?php _e('Add Description to every Option', 'custom-options'); ?></h2></div>
							<div class="pho-plugin-content">
							<p>
							<?php _e('You have the choice to describe every option. This field will allow the customer to fill in any description that he wants to.', 'custom-options'); ?>
							</p>

							<div class="pho-img-bg">
							<img src="<?php echo $plugin_dir_url; ?>../images/add-description.png" />
							</div>   
							</div>

							</div><!-- description end -->   

							<div class="description">
							<div class="pho-desc-head"><h2><?php _e('Make Custom Input field Conditional or Compulsory', 'custom-options'); ?> </h2></div>
							<div class="pho-plugin-content">
							<p>
							<?php _e('You have the option of making a particular Custom Input Field either Conditional or Compulsory to fill. Any input field could be made to be a required field', 'custom-options'); ?>
							</p>

							<div class="pho-img-bg">
							<img src="<?php echo $plugin_dir_url; ?>../images/input-field-conditonal.png" />
							</div>   
							</div>

							</div><!-- description end -->  

							<div class="description">
							<div class="pho-desc-head"><h2><?php _e('Availability of Multiple Styling Options', 'custom-options'); ?></h2></div>
							<div class="pho-plugin-content">
							<p>
							<?php _e('There are various styling options that are available. ', 'custom-options'); ?>
							</p>

							<div class="pho-img-bg">
							<img src="<?php echo $plugin_dir_url; ?>../images/multiple-styling.png" />
							</div>   
							</div>

							</div><!-- description end --> 

							<div class="description">
							<div class="pho-desc-head"><h2><?php _e('Conditional logic', 'custom-options'); ?></h2></div>
							<div class="pho-plugin-content">
							<p>
							<?php _e('With Conditional Logic you can apply rules to your fields in order to control their display. Not all fields can be used as rules to the logic. Only fields that have a way of showing a value are valid. An example of a field that cannot be used as a logic rule is the upload field. All fields though can have logic applied on them. ', 'custom-options'); ?>
							</p>

							<div class="pho-img-bg">
							<img src="<?php echo $plugin_dir_url; ?>../images/conditional-logic.png" />
							</div>   
							</div>

							</div><!-- description end -->

							<div class="pho-upgrade-btn">

							<a href="https://www.phoeniixx.com/product/woocommerce-product-custom-options/" target="_blank"><img src="<?php echo $plugin_dir_url; ?>../images/premium-btn.png" /></a>
							<a target="blank" href="http://customoption.phoeniixxdemo.com/"><img src="<?php echo $plugin_dir_url; ?>../images/demo-btn.png" /></a>

							</div>


							</div>      


							</ul>



							</div>	
						<?php
						
						}
						
						?>
					
				</div>
				
			<?php
		
		}
		
		function add_to_cart_product( $cart_item_data,$product_id ) {
				
				if ( empty( $cart_item_data['options'] ) ) {
					
					$cart_item_data['options'] = array();
					
				}
				
					$array_options  = (array) get_post_meta( $product_id, '_product_custom_options', true );
					
					foreach ( $array_options as $options_key => $options ) {
						
						$optionname_min=isset($options['name'])?$options['name']:'';
						
						$val_post = !empty($_POST['custom-options'][sanitize_title( $optionname_min )])?$_POST['custom-options'][sanitize_title( $optionname_min )]:'';
						
						$val_post = str_replace('\"','"',$val_post);
						$val_post = str_replace("\'","'",$val_post);
						
						if($val_post != '')
						{
							$data[] = array(
								'name'  => $options['label'],
								'value' => $val_post,
								'price' => $options['price']
							);
							
							$cart_item_data['options'] =  $data;
						}
						
					}
					
					return $cart_item_data;
					
		}
			
		function validate_add_cart_product(  $passed, $product_id, $quantity ) {
			
			global $woocommerce;
			
			$array_options  = (array) get_post_meta( $product_id, '_product_custom_options', true );
			
				foreach ( $array_options as $options_key => $options ) {
						
						$optionname_min=isset($options['name'])?$options['name']:'';
						
						$post_data =  isset($_POST['custom-options'][sanitize_title( $optionname_min )]) ? $_POST['custom-options'][sanitize_title( $optionname_min )]:'';
						
						if(isset($options['required']) && $options['required'] == 1  )
						{
							if ( $post_data == "" && strlen( $post_data ) == 0 ) {
								
								$data = new WP_Error( 'error', sprintf( __( '"%s" is a required field.', 'custom-options' ), $options['label'] ) );
								
									wc_add_notice( $data->get_error_message(), 'error' );
									
									$data_msg = 1;
							}
							
						}
						if (isset($options['max']) && strlen( $post_data ) > $options['max']) {
							
							$data = new WP_Error( 'error', sprintf( __( 'The maximum allowed length for "%s" is %s letters.', 'custom-options' ), $options['label'], $options['max'] ) );
							
							wc_add_notice( $data->get_error_message(), 'error' );
							
							$data_msg = 1;
						}
						
				}
				
				if(isset($data_msg) &&	 $data_msg == 1)
				{
					return false;
				}
						
				return $passed;
					
		}
		
		function get_item_data( $other_data, $cart_item_data ) {
			
			if ( ! empty( $cart_item_data['options'] ) ) {
				
				foreach ( $cart_item_data['options'] as $options ) {
									
					$name = $options['name'];

					if ( $options['price'] > 0 ) {
						
						$name .= ' (' . wc_price(  $options['price'] ) . ')';
					
					}

					$other_data[] = array(
						'name'    => $name,
						'value'   => $options['value'],
						'display' => ''
					);
				} 
			}
			return $other_data;
		}
		

		function add_cart_item($cart_item_data) {
		
			if ( ! empty( $cart_item_data['options'] ) ) {

				$extra_cost = 0;

				foreach ( $cart_item_data['options'] as $options ) {
					
					if ( $options['price'] > 0 ) {
						
						$extra_cost += $options['price'];
						
					}
				}
				
				/* if ( $product->is_on_sale( 'edit' ) ) {
					update_post_meta( $product->get_id(), '_price', $product->get_sale_price( 'edit' ) );
					$product->set_price( $product->get_sale_price( 'edit' ) );
				} else {
					update_post_meta( $product->get_id(), '_price', $product->get_regular_price( 'edit' ) );
					$product->set_price( $product->get_regular_price( 'edit' ) );
				} */

				$cart_item_data['data']->set_price( $extra_cost +$cart_item_data['data']->get_price());
			}
			
			
			return $cart_item_data;
		}


		function get_cart_item_from_session($cart_item_data, $values) {
			
			if ( ! empty( $values['options'] ) ) {
				
				$cart_item_data['options'] = $values['options'];
				
				$cart_item_data = add_cart_item( $cart_item_data );
				
			}
			return $cart_item_data;
		}

		

		function order_item_meta($item_id,$values) {
					
			if ( ! empty( $values['options'] ) ) {
				
				foreach ( $values['options'] as $options ) {

					$name = $options['name'];

					if ( $options['price'] > 0 ) {
						
						$name .= ' (' . wc_price( get_product_addition_options_price( $options['price'] ) ) . ')';
					}

					  woocommerce_add_order_item_meta( $item_id, $name, $options['value'] );
					
				}
			}
			
		}
		
		function get_product_addition_options_price( $price ) {
			
			global $product;

			if ( $price === '' || $price == '0' ) {
				
				return;
				
			}

			if ( is_object( $product ) ) {
				
				$tax_display_mode = get_option( 'woocommerce_tax_display_shop' );
				
				$display_price    = $tax_display_mode == 'incl' ? wc_get_price_including_tax( 1, $price ) : wc_get_price_including_tax( 1, $price );
			
			} else {
				
				$display_price = $price;
				
			}

			return $display_price;
		}

?>