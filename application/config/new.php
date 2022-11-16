<!DOCTYPE html>
<html lang="en">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <!-- /Added by HTTrack -->
   <head>
      <!-- css
         ============================================ -->
      <?php include('common/cssfiles.php');?>
      <style type="text/css">
         body{font-family:'Roboto', sans-serif}
         .video-container {
         position: relative;
         padding-bottom: 56.25%; /* 16:9 */
         height: 0;
         }
         .video-container iframe {
         position: absolute;
         top: 0;
         left: 0;
         width: 100%;
         }
         .d-flex{
         display: flex;
         }
      </style>
   </head>
   <body class="res layout-subpage layout-1 banners-effect-5">
      <div id="wrapper" class="wrapper-fluid">
      <!-- Header Container  -->
      <?php include('common/header.php');?>
      <!-- //Header Container  -->
      <!-- Main Container  -->
      <div class="main-container container">
      <ul class="breadcrumb">
         <li><a href="#"><i class="fa fa-home"></i></a></li>
         <li><a href="#"><?= $product_details['category_name'] ?></a></li>
         <li><a href="#"><?= $product_details['sub_category_name'] ?></a></li>
      </ul>
      <div class="row">
         <!--Left Part Start -->
         <aside class="col-sm-4 col-md-3 content-aside arabic-web-category" id="column-left">
            <!--<div class="module category-style">-->
            <!--   <h3 class="modtitle">Categories</h3>-->
            <!--
               </div>-->
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
               <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingOne">
                     <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                       <?= $product_details['categories'] ?>
                        </a>
                     </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                     <div class="panel-body">
                        <div class="modcontent">
                           <div class="box-category">
                              <ul id="cat_accordion" class="list-group">
                                 <?php foreach($cat_data as $key => $value){ 
                                    ?>
                                 <li class="hadchild">
                                    <a href="<?php echo base_url().'Frontend/category?catid='.base64_encode($value['category_id']); ?>" class="cutom-parent"><?php echo $value['category_name']; ?></a>   <?php  if(!empty($value['sub_category_name'][0])){?><span class="button-view  fa fa-plus-square-o"></span><?php } ?>
                                    <ul style="display: none;">
                                       <?php 
                                          $sub_catgory_id_info = $value['sub_category_name'];
                                          $catgory_id_info = $value['sub_category_id'];
                                          foreach($value['sub_category_name'] as $sub_category_name_key =>$value1){ 
                                          ?>
                                       <li style="font-size:12px;"><a href="<?php echo base_url().'Frontend/sub_category?subcatid='.base64_encode($catgory_id_info[$sub_category_name_key]).'&catid='.base64_encode($value['category_id']); ?>"><?php echo $value1; ?></a></li>
                                       <?php } ?>
                                    </ul>
                                 </li>
                                 <?php } ?>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               </div>
         </aside>
         <!--Left Part End -->
         <!--Middle Part Start-->
         <div id="content" class="col-md-9 col-sm-8">
         <div class="product-view row">
         <div class="left-content-product">
             <div id="content" class="col-md-3 col-sm-8 arabic-mobile-category" style="float:right;">
                           <!--Left Part Start -->
                           <aside class=" content-aside" style="width: 100%!important" id="column-left">
                              <div class="panel panel-default">
                                 <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                       <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                          <h3 class="modtitle textright"><?= $product_details['categories'] ?></h3>
                                       </a>
                                    </h4>
                                 </div>
                                 <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                       <div class="module category-style">
                                          <div class="modcontent">
                                             <div class="box-category">
                                                <ul id="cat_accordion" class="list-group">
                                                   <?php
                                                      foreach($cat_data as $key => $value){ 
                                                      
                                                         ?>
                                                   <li class="hadchild" style="text-align:end;">
                                                      <?php  if(!empty($value['sub_category_name'][0])){?><span class="button-view  fa fa-plus-square-o" style="right:auto !important"></span><?php } ?> <a href="<?php echo base_url().'Frontend/category?catid='.base64_encode($value['category_id']); ?>" class="cutom-parent"><?php echo $value['category_name']; ?></a>  
                                                      <ul style="display: none;">
                                                         <?php foreach($value['sub_category_name'] as $key1 =>$value1){ 
                                                            ?>
                                                         <li style="font-size:12px;"><a href="<?php echo base_url().'Frontend/sub_category?subcatid='.base64_encode($value['sub_category_id'][$key1]); ?>"><?php echo $value1; ?></a></li>
                                                         <?php } ?>
                                                      </ul>
                                                   </li>
                                                   <?php } ?>
                                                </ul>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </aside>
                           <!--Left Part End -->
                        </div>
         <div class="content-product-left class-honizol col-md-5 col-sm-12 col-xs-12">
         <div class="large-image">
         <?php  $img_url = explode(",",$product_details['img_url']);  ?>
         <img itemprop="image" class="product-image-zoom" src="<?= $img_url['0'] ?>" title="<?= $product_details['product_name'] ?>" alt="<?= $product_details['product_name'] ?>">
         </div>
         <?php if(!empty($product_details['video_url'])){?>
         <a class="thumb-video pull-left" data-toggle="modal" data-target="#modal_<?=$product_details['product_id']; ?>"><i class="fa fa-youtube-play"></i></a>
         <div class="modal fade" id="modal_<?=$product_details['product_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog customdialog" role="document">
         <div class="modal-content">
         <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel"></h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
         </div>
         <div class="modal-body" align="center">
         <?php $str= preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"750\" height=\"500\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" id=\"videourls\" allowfullscreen></iframe>",$product_details['video_url']); echo $str; ?>
         </div>
         </div>
         </div>
         </div>
         <?php } ?>
         <div id="thumb-slider" class="yt-content-slider full_slider owl-drag" data-rtl="yes" data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="10" data-items_column0="4" data-items_column1="3" data-items_column2="4"  data-items_column3="1" data-items_column4="3" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
         <?php 
            $img_url = explode(",",$product_details['img_url']);
            
            foreach ($img_url as $img_url_key => $img_url_row) { ?>     
         <a data-index="0" class="img thumbnail " data-image="<?=$img_url_row?>" title="<?= $product_details['product_name'] ?>">
         <img src="<?=$img_url_row?>" title="<?= $product_details['product_name'] ?>" alt="<?= $product_details['product_name'] ?>">
         </a>
         <?php }
            ?>
         </div>
         </div>
          <div class="content-product-right arabic-mobile-des col-md-7 col-sm-12 col-xs-12" >
                           <div class="title-product title-product-reverse" style="width:40ch">
                              <input type="hidden" value="<?=$product_details['product_id']?>" id="product_id">
                              <h1><?= $product_details['product_name'] ?></h1>
                           </div>
                           <!-- Review ---->
                           <!--  <div class="box-review form-group">
                              <div class="ratings">
                                    <div class="rating-box">
                                       <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                       <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                       <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                       <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                       <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                    </div>
                                 </div> -->
                           <!--  <a class="reviews_button" href="#" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">0 reviews</a>   |  -->
                           <!-- <a class="write_review_button" href="#" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">Write a review</a>
                              </div>-->
                           <div id="content " >
                              <!-- Product Tabs -->
                              <div class="producttab" style="margin: 0px !important;">
                                 <div class="tabsslider  vertical-tabs col-xs-12">
                                    <ul class="nav nav-tabs" style="float:right !important;">
                                       <li class="active"><a data-toggle="tab" href="#tab-1">وصف </a></li>
                                       <!--<li class="item_nonactive"><a data-toggle="tab" href="#tab-review">Reviews (1)</a></li>-->
                                       <!-- <li class="item_nonactive"><a data-toggle="tab" href="#tab-4">Tags</a></li>
                                          <li class="item_nonactive"><a data-toggle="tab" href="#tab-5">Custom Tab</a></li> -->
                                    </ul>
                                    <div class="tab-content col-lg-10 col-sm-9 col-xs-12" >
                                       <div id="tab-1" class="tab-pane fade active in description-rev">
                                          <p><?php echo $product_details['description']; ?></p>
                                       </div>
                                       <div id="tab-review" class="tab-pane fade">
                                          <form>
                                             <!--<div id="review">-->
                                             <!--   <table class="table table-striped table-bordered">-->
                                             <!--      <tbody>-->
                                             <!--         <tr>-->
                                             <!--            <td colspan="2">-->
                                             <!--               <p>Best this product opencart</p>-->
                                             <!--               <div id="rating_div" style="margin-bottom: 10px;">-->
                                             <!--               <div class="star-rating">-->
                                             <!--               <span class="fa fa-star-o" data-rating="1" style="font-size:20px;"></span>-->
                                             <!--               <span class="fa fa-star-o" data-rating="2" style="font-size:20px;"></span>-->
                                             <!--               <span class="fa fa-star-o" data-rating="3" style="font-size:20px;"></span>-->
                                             <!--               <span class="fa fa-star-o" data-rating="4" style="font-size:20px;"></span>-->
                                             <!--               <span class="fa fa-star-o" data-rating="5" style="font-size:20px;"></span>-->
                                             <!--               <input type="hidden" name="whatever3" class="rating-value" value="1">-->
                                             <!--               <p><button type="button" class="btn btn btn-normal btn-sm" id="srr_rating" style="padding:10px;margin-top: 5px;">Submit</button></p>-->
                                             <!--               </div>-->
                                             <!--               </div>-->
                                             <!--            </td>-->
                                             <!--         </tr>-->
                                             <!--      </tbody>-->
                                             <!--   </table>-->
                                             <!--   <div class="text-right"></div>-->
                                             <!--</div>-->
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- //Product Tabs -->
                           </div>
                           <div class="product-label form-group productlabelrev">
                              <div class="product_page_price price" itemprop="offerDetails" itemscope="" itemtype="http://data-vocabulary.org/Offer">
                                 <span class="price-new" itemprop="price"><?php if($fk_lang_id == 1){ echo $product_details['currency_in_english']; }else{ echo $product_details['currency_in_arabic']; } ?>
                                 <?php echo $product_details['product_offer_price']; ?></span>
                                 <!--<span class="price-old"><?php if($fk_lang_id == 1){ echo $product_details['currency_in_english']; }else{ echo $product_details['currency_in_arabic']; } ?>-->
                                 <!--                    <?php echo $product_details['product_price']; ?></span>-->
                              </div>
                              <!-- <div class="stock"><span>Availability:</span> <span class="status-stock">In Stock</span></div> -->
                              
                           </div>
                            <div id="product" class="productreverse">
                              <div class="form-group box-info-product box-info-product-rev" style="margin-left: 0px!important">
                                 <?php if(!empty($product_details['quantity'])){ ?>
                                 <div class="cart" style="float:right!important">
                                    <input type="button" id="<?=$product_details['product_id'] ?>" data-toggle="tooltip" title="" value="<?= $product_details['add_to_cart'] ?>" data-loading-text="Loading..."  class="btn btn-mega btn-lg addtocart addtocartrev" data-original-title="Add to Cart">
                                 </div>
                                 <div class="add-to-links wish_comp d-flex">
                                    <ul class="blank list-inline arabic-wishlist">
                                       <li class="wishlist">
                                          <a class="icon add_wishlist" data-toggle="tooltip" title="" id="<?=$product_details['product_id']?>"
                                             data-original-title="Add to Wish List"><i class="fa fa-heart"></i>
                                          </a>
                                       </li>
                                    </ul>
                                 </div>
                                 <?php }else{ ?>
                                 <span style="color: red; font-size: 20px; margin-top:20px; width:100px;" ><strong>إنتهى من المخزن </strong></span>
                                 <?php }?>
                                 <div class="social-share">
                                    <label class="toggle" for="toggle">
                                    <input type="checkbox" id="toggle" />
                                    <div class="btn">
                                    <i class="fa fa-share-alt"></i>
                                    <i class="fa fa-times"></i>
                                    <div class="social">
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-vk"></i></a>
                                    </div>
                                    </div>
                                    </label>
                                 </div>
                              </div>
                           </div>
                           <!-- end box info product -->
                        </div>
         <div class="content-product-right col-md-5 col-sm-12 col-xs-12">
         <div class="title-product" style="width:40ch;">
         <input type="hidden" value="<?=$product_details['product_id']?>" id="product_id">
         <h1><?= $product_details['product_name'] ?></h1>
         </div>
         <!-- Review ---->
         <div class="box-review form-group">
         <!--  <div class="ratings">
            <div class="rating-box">
               <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
               <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
               <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
               <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
               <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
            </div>
            </div> -->
         <!--  <a class="reviews_button" href="#" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">0 reviews</a>   |  -->
         <!-- <a class="write_review_button" href="#" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">Write a review</a> -->
         </div>
         
         <div class="product-label form-group mb-0">
         <div class="product_page_price price" itemprop="offerDetails" itemscope="" itemtype="http://data-vocabulary.org/Offer">
         <span class="price-new" itemprop="price"><?php if($fk_lang_id == 1){ echo $product_details['currency_in_english']; }else{ echo $product_details['currency_in_arabic']; } ?>
         <?php echo $product_details['product_offer_price']; ?></span>
        
         </div>
         </div>
         
         <div id="product">
         <div class="form-group box-info-product">
         <?php if(!empty($product_details['quantity'])){ ?>
         <div class="cart">
         <input type="button" id="<?=$product_details['product_id'] ?>" title="" value="Add to Cart" data-loading-text="Loading..."  class="btn btn-mega btn-lg addtocart" data-original-title="Add to Cart">
         </div>
         <div class="add-to-links wish_comp d-flex">
         <ul class="blank list-inline">
         <li class="wishlist">
         <?php if($product_details['wishlist_product'] == true){ ?>
         <a class="icon add_wishlist" title="" id="<?=$product_details['product_id']?>"
            data-original-title="Add to Wish List" style="color: red !important;"><i class="fa fa-heart"></i>
         </a>
         <?php }else{ ?>
         <a class="icon add_wishlist" title="" id="<?=$product_details['product_id']?>"
            data-original-title="Add to Wish List"><i class="fa fa-heart"></i>
         </a>
         <?php } ?>
         </li>
         </ul>
         <div class="social-share" style="margin-top: -5px;">
         <label class="toggle" for="toggle">
         <input type="checkbox" id="toggle" />
         <div class="btn">
         <i class="fa fa-share-alt"></i>
         <i class="fa fa-times"></i>
         <div class="social">
         <a href="#"><i class="fa fa-twitter"></i></a>
         <a href="#"><i class="fa fa-instagram"></i></a>
         <a href="#"><i class="fa fa-vk"></i></a>
         </div>
         </div>
         </label>
         </div>
         <div>
         </div>
         <?php }else{ ?>
         <span style="color: red; font-size: 20px; margin-top:20px; width:100px;" ><strong>Out of Stock</strong></span>
         <?php }?>
         <!--    <div class="row">-->
         <!--   <div class="col-md-6">-->
         <!--   </div>-->
         <!--</div>-->
         </div>
         <!-- end box info product -->
         </div>
         </div>
         <div class="producttab ">
         <div class="tabsslider  vertical-tabs col-xs-12">
         <ul class="nav nav-tabs col-lg-2 col-sm-3">
         <li class="active"><a data-toggle="tab" href="#tab-1">Description</a></li>
         <!--<li class="item_nonactive"><a data-toggle="tab" href="#tab-review">Reviews (1)</a></li>-->
         <!-- <li class="item_nonactive"><a data-toggle="tab" href="#tab-4">Tags</a></li>
            <li class="item_nonactive"><a data-toggle="tab" href="#tab-5">Custom Tab</a></li> -->
         </ul>
         <div class="tab-content col-lg-10 col-sm-9 col-xs-12">
         <div id="tab-1" class="tab-pane fade active in">
         <?=$product_details['description']?>
         </div>

         <div id="tab-review" class="tab-pane fade">
        
         </div>
         
         </div>
         </div>
         </div>
         <div class="cart">
          
         <a href="<?=base_url()?>Frontend"><input type="button"  title="" value="Continue" data-loading-text="Loading..."  class="btn btn-mega btn-lg " data-original-title="Continue" style="background: #fd7e14 !important; color: #fff; text-align: center;"></a>
        
           
        
         </div>
         </div>

         <!-- Product Tabs -->
         <div class="related titleLine products-list grid module ">
         <?php if(!empty($related_product_details)){?>
         <h3 class="modtitle">Related Products  </h3>
         <div class="releate-products yt-content-slider products-list" data-rtl="no" data-loop="yes" data-autoplay="no" data-autoheight="no" data-autowidth="no" data-delay="4" data-speed="0.6" data-margin="30" data-items_column0="5" data-items_column1="3" data-items_column2="3" data-items_column3="2" data-items_column4="1" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-hoverpause="yes">
         <?php 
            foreach ($related_product_details as $related_product_details_key => $related_product_details_row) { ?>
         <div class="item">
         <div class="item-inner product-layout transition product-grid">
         <div class="product-item-container">
         <div class="left-block">
         <div class="product-image-container second_img">
         <input type="hidden" name="product_id" id="product_id" value="<?php echo base64_decode($_GET['id']);?>">
         <a href="<?=base_url();?>Frontend/product_details?id=<?php echo base64_encode($related_product_details_row['product_id']) ?>" target="_self" title="Pastrami bacon">
         <img src="<?=$related_product_details_row['image_name']?>" class="img-1 img-responsive" alt="<?=$related_product_details_row['product_name']?>">
         </a>
         <?php if($related_product_details_row['new_arrival'] == '1'){ ?>
         <div class="ribbon ribbon-top-left"><span>NEW</span></div>
         <?php } ?>
         <?php if($related_product_details_row['product_offer'] == '1'){ ?>
         <div class="ribbon-top-right_inner"><img src="<?php echo base_url()?>assets_frontend/image/icons/offer.png"></span></div>
         <?php } ?>
         <div>
         <?php if(!empty($related_product_details_row['quantity'])){ ?>
         <button type="button" id="<?=$related_product_details_row['product_id'] ?>" class="addToCart btn-button addtocart" title="Add to cart" style="width:100px">  <i class="fa fa-shopping-basket"></i>&nbsp Add to Cart
         </button>
         <ul class="blank list-inline">
         <li class="wishlist">
         <?php if($related_product_details_row['wishlist_product'] == '1'){ ?>
         <button type="button" id="<?=$related_product_details_row['product_id'] ?>"  class="icon addToCart btn-button add_wishlist custwishlist" title="Add to Wish List" style="border: 1px solid red"><i class="fa fa-heart"></i><span></span>
         </button>
         <?php }else{ ?>
         <button type="button" id="<?=$related_product_details_row['product_id'] ?>"  class=" addToCart btn-button add_wishlist " title="Add to Wish List"><i class="fa fa-heart"></i><span></span>
         </button>
         <?php } ?>
         </li>
         </ul>
         <?php }else{ ?>
         <span style="color: red; font-size: 20px; margin-top:20px; width:100px;" ><strong>Out of Stock</strong></span>
         <?php }?>
         </div>
         </div>
         </div>
         <div class="right-block">
         <div class="caption">
         <!--  <div class="rating">    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
            <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
            <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
            <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
            </div> -->
         <h4 style="color: #000000 !important;"><strong><a href="product.html" title="Pastrami bacon" target="_self"><?php echo substr($related_product_details_row['product_name'],0,35);?></a></strong></h4>
         <div class="price"> <span class="price-new"><?php echo $related_product_details_row['currency_in_english'];?> <?php echo $related_product_details_row['product_offer_price'];?></span>
         <!--<span class="price-old"><?php echo $related_product_details_row['currency_in_english'];?> <?php echo $related_product_details_row['product_purchase_price'];?></span>-->
         </div>
         </div>
         </div>
         </div>
         </div>
         </div>
         <?php }
            ?>
         </div>
         <?php } ?>
         </div>
         <!-- end Related  Products-->
         </div>
         </div>
         </div>
         <!--Middle Part End-->
         </div>
         <!-- //Main Container -->
       
      </div>
        <!-- Footer Container -->
         <?php include('common/footer.php');?>
         <!-- //end Footer Container -->
      <!-- Include Libs & Plugins
         ============================================ -->
      <?php include('common/jsfiles.php');?>
      <script src="<?= base_url();?>assets_frontend/custom_js/wishlist.js"></script>
      <script src="<?= base_url();?>assets_frontend/custom_js/cart.js"></script>
      <script src="<?= base_url();?>assets_frontend/custom_js/rating.js"></script>
      <script>
         $(".modal").on('hidden.bs.modal', function (e) {
         $(".modal iframe").attr("src", $(".modal iframe").attr("src"));
         });
      </script>
   </body>
</html>