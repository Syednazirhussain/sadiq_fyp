<?php require('./autoload.php'); ?>
<?php include('layouts/header.php'); ?>

<?php 
    
	if (isset($_REQUEST['id'])) {
			
		$parent_id = $_REQUEST['id'];
	    $categories_sidesbars = (new category())->getParentCategories($parent_id);

	    $all_category_sidesbar = [];
	    if ($categories_sidesbars['rowsAffected'] != 0) {

		    foreach ($categories_sidesbars['result'] as $key => $category) {

		            $category = json_decode(json_encode($category), true);
		            $child_category = $pdo->select('category', ['*'], 'where parent_id = ?', [$category['id']]);
		            if ($child_category['rowsAffected'] > 0) {

		                $category['childrens'] = $child_category['result'];
		            }
		            array_push($all_category_sidesbar, $category);
		    }
	    }

	    $category_id = $_REQUEST['id'];
	    $all_products = (new product)->getProducts($category_id);

	}

?>

    <div class="body-content outer-top-vs" id="top-banner-and-menu">
        <!-- Categories -->
        <div class="container">
            <div class="row">
                <?php if (count($all_category_sidesbar) > 0) { ?>
                <div class="col-xs-12 col-sm-12 col-md-3 sidebar">
                    <div class="side-menu animate-dropdown outer-bottom-xs">
                        <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
                        <nav class="yamm megamenu-horizontal">
                            <ul class="nav">
                            <?php foreach ($all_category_sidesbar as $key => $item) { ?>
                                <?php if (isset($item['childrens'])) { ?>
                                    <?php if (count($item['childrens']) > 0) { ?>
                                        <li class="dropdown menu-item"> 
                                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon fa fa-shopping-bag" aria-hidden="true"></i><?php echo $item['name'] ?>
                                            </a>
                                            <ul class="dropdown-menu mega-menu">
                                                <li class="yamm-content">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-3">
                                                            <ul class="links list-unstyled">
                                                                <?php foreach ($item['childrens'] as $child) { ?>
                                                                    <li><a href='category.php?id=<?php echo $child->id; ?>'><?php echo $child->name; ?></a></li>
                                                                <?php } ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                <?php } else { ?>
                                    <li class="menu-item"> <a href='category.php?id=<?php echo $item['id']; ?>'><?php echo $item['name']; ?></a> 
                                <?php } ?>
                            <?php } ?>
                            </ul>
                        </nav>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

        <!-- products -->
        <?php if (!empty($all_products['result'])) { ?>
	        <div class="container">
	            <section class="section featured-product wow fadeInUp">
	                <h3 class="section-title">New products</h3>
	                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
	                    <?php foreach ($all_products['result'] as $key => $value) { ?>
	                    <div class="item item-carousel">
	                        <div class="products">
	                            <div class="product">
	                                <div class="product-image">
	                                    <div class="image">
	                                        <a href="javascript:void(0);">
	                                        	<img src="images/<?php echo($value->image); ?>">
	                                        </a>
	                                    </div>
	                                </div>
	                                <div class="product-info text-left">
	                                    <h3 class="name"><a href="javascript:void(0);"><?php echo $value->name; ?></a></h3>
	                                    <div class="rating rateit-small"></div>
	                                    <div class="description"></div>
	                                    <div class="product-price"> 
	                                    	<span class="price"><?php echo $value->price; ?>&nbsp;PKR</span> 
	                                    	<!-- <span class="price-before-discount">$800</span>  -->
	                                    </div>
	                                </div>
	                                <!-- /.product-info -->
	                                <div class="cart clearfix animate-effect">
	                                    <div class="action">
	                                        <ul class="list-unstyled">
	                                            <li class="add-cart-button btn-group">
	                                                <button class="btn btn-primary icon addToCart" data-product-id="<?php echo $value->id; ?>" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
	                                                <button class="btn btn-primary cart-btn" data-product-id="<?php echo $value->id; ?>" type="button">Add to cart</button>
	                                            </li>
	                                            <li class="lnk wishlist">
	                                                <a class="add-to-cart" href="javascript:void(0);" title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
	                                            </li>
	                                            <li class="lnk">
	                                                <a class="add-to-cart" href="javascript:void(0);" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a>
	                                            </li>
	                                        </ul>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <?php } ?>
	                </div>
	            </section>

	            <!-- Featured products -->
	            <section class="section featured-product wow fadeInUp">
	                <h3 class="section-title">Featured products</h3>
	                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
	                    <div class="item item-carousel">
	                        <div class="products">
	                            <div class="product">
	                                <div class="product-image">
	                                    <div class="image">
	                                        <a href="javascript:void(0);"><img src="assets/images/products/p5.jpg" alt=""></a>
	                                    </div>
	                                    <!-- /.image -->

	                                </div>
	                                <!-- /.product-image -->

	                                <div class="product-info text-left">
	                                    <h3 class="name"><a href="javascript:void(0);">Floral Print Buttoned</a></h3>
	                                    <div class="rating rateit-small"></div>
	                                    <div class="description"></div>
	                                    <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$800</span> </div>
	                                    <!-- /.product-price -->

	                                </div>
	                                <!-- /.product-info -->
	                                <div class="cart clearfix animate-effect">
	                                    <div class="action">
	                                        <ul class="list-unstyled">
	                                            <li class="add-cart-button btn-group">
	                                                <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
	                                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
	                                            </li>
	                                            <li class="lnk wishlist">
	                                                <a class="add-to-cart" href="javascript:void(0);" title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
	                                            </li>
	                                            <li class="lnk">
	                                                <a class="add-to-cart" href="javascript:void(0);" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a>
	                                            </li>
	                                        </ul>
	                                    </div>
	                                    <!-- /.action -->
	                                </div>
	                                <!-- /.cart -->
	                            </div>
	                            <!-- /.product -->

	                        </div>
	                        <!-- /.products -->
	                    </div>
	                    <!-- /.item -->

	                    <div class="item item-carousel">
	                        <div class="products">
	                            <div class="product">
	                                <div class="product-image">
	                                    <div class="image">
	                                        <a href="javascript:void(0);"><img src="assets/images/products/p2.jpg" alt=""></a>
	                                    </div>
	                                    <!-- /.image -->

	                                </div>
	                                <!-- /.product-image -->

	                                <div class="product-info text-left">
	                                    <h3 class="name"><a href="javascript:void(0);">Floral Print Buttoned</a></h3>
	                                    <div class="rating rateit-small"></div>
	                                    <div class="description"></div>
	                                    <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$800</span> </div>
	                                    <!-- /.product-price -->

	                                </div>
	                                <!-- /.product-info -->
	                                <div class="cart clearfix animate-effect">
	                                    <div class="action">
	                                        <ul class="list-unstyled">
	                                            <li class="add-cart-button btn-group">
	                                                <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
	                                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
	                                            </li>
	                                            <li class="lnk wishlist">
	                                                <a class="add-to-cart" href="javascript:void(0);" title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
	                                            </li>
	                                            <li class="lnk">
	                                                <a class="add-to-cart" href="javascript:void(0);" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a>
	                                            </li>
	                                        </ul>
	                                    </div>
	                                    <!-- /.action -->
	                                </div>
	                                <!-- /.cart -->
	                            </div>
	                            <!-- /.product -->

	                        </div>
	                        <!-- /.products -->
	                    </div>
	                    <!-- /.item -->

	                    <div class="item item-carousel">
	                        <div class="products">
	                            <div class="product">
	                                <div class="product-image">
	                                    <div class="image">
	                                        <a href="javascript:void(0);"><img src="assets/images/products/p6.jpg" alt=""></a>
	                                    </div>
	                                    <!-- /.image -->

	                                    <div class="tag new"><span>new</span></div>
	                                </div>
	                                <!-- /.product-image -->

	                                <div class="product-info text-left">
	                                    <h3 class="name"><a href="javascript:void(0);">Floral Print Buttoned</a></h3>
	                                    <div class="rating rateit-small"></div>
	                                    <div class="description"></div>
	                                    <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$800</span> </div>
	                                    <!-- /.product-price -->

	                                </div>
	                                <!-- /.product-info -->
	                                <div class="cart clearfix animate-effect">
	                                    <div class="action">
	                                        <ul class="list-unstyled">
	                                            <li class="add-cart-button btn-group">
	                                                <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
	                                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
	                                            </li>
	                                            <li class="lnk wishlist">
	                                                <a class="add-to-cart" href="javascript:void(0);" title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
	                                            </li>
	                                            <li class="lnk">
	                                                <a class="add-to-cart" href="javascript:void(0);" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a>
	                                            </li>
	                                        </ul>
	                                    </div>
	                                    <!-- /.action -->
	                                </div>
	                                <!-- /.cart -->
	                            </div>
	                            <!-- /.product -->

	                        </div>
	                        <!-- /.products -->
	                    </div>
	                    <!-- /.item -->

	                    <div class="item item-carousel">
	                        <div class="products">
	                            <div class="product">
	                                <div class="product-image">
	                                    <div class="image">
	                                        <a href="javascript:void(0);"><img src="assets/images/blank.gif" data-echo="assets/images/products/p7.jpg" alt=""></a>
	                                    </div>
	                                    <!-- /.image -->

	                                </div>
	                                <!-- /.product-image -->

	                                <div class="product-info text-left">
	                                    <h3 class="name"><a href="javascript:void(0);">Floral Print Buttoned</a></h3>
	                                    <div class="rating rateit-small"></div>
	                                    <div class="description"></div>
	                                    <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$800</span> </div>
	                                    <!-- /.product-price -->

	                                </div>
	                                <!-- /.product-info -->
	                                <div class="cart clearfix animate-effect">
	                                    <div class="action">
	                                        <ul class="list-unstyled">
	                                            <li class="add-cart-button btn-group">
	                                                <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
	                                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
	                                            </li>
	                                            <li class="lnk wishlist">
	                                                <a class="add-to-cart" href="javascript:void(0);" title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
	                                            </li>
	                                            <li class="lnk">
	                                                <a class="add-to-cart" href="javascript:void(0);" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a>
	                                            </li>
	                                        </ul>
	                                    </div>
	                                    <!-- /.action -->
	                                </div>
	                                <!-- /.cart -->
	                            </div>
	                            <!-- /.product -->

	                        </div>
	                        <!-- /.products -->
	                    </div>
	                    <!-- /.item -->

	                    <div class="item item-carousel">
	                        <div class="products">
	                            <div class="product">
	                                <div class="product-image">
	                                    <div class="image">
	                                        <a href="javascript:void(0);"><img src="assets/images/products/p8.jpg" alt=""></a>
	                                    </div>
	                                    <!-- /.image -->

	                                    <div class="tag hot"><span>hot</span></div>
	                                </div>
	                                <!-- /.product-image -->

	                                <div class="product-info text-left">
	                                    <h3 class="name"><a href="javascript:void(0);">Floral Print Buttoned</a></h3>
	                                    <div class="rating rateit-small"></div>
	                                    <div class="description"></div>
	                                    <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$800</span> </div>
	                                    <!-- /.product-price -->

	                                </div>
	                                <!-- /.product-info -->
	                                <div class="cart clearfix animate-effect">
	                                    <div class="action">
	                                        <ul class="list-unstyled">
	                                            <li class="add-cart-button btn-group">
	                                                <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
	                                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
	                                            </li>
	                                            <li class="lnk wishlist">
	                                                <a class="add-to-cart" href="javascript:void(0);" title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
	                                            </li>
	                                            <li class="lnk">
	                                                <a class="add-to-cart" href="javascript:void(0);" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a>
	                                            </li>
	                                        </ul>
	                                    </div>
	                                    <!-- /.action -->
	                                </div>
	                                <!-- /.cart -->
	                            </div>
	                            <!-- /.product -->

	                        </div>
	                        <!-- /.products -->
	                    </div>
	                    <!-- /.item -->

	                    <div class="item item-carousel">
	                        <div class="products">
	                            <div class="product">
	                                <div class="product-image">
	                                    <div class="image">
	                                        <a href="javascript:void(0);"><img src="assets/images/products/p9.jpg" alt=""></a>
	                                    </div>
	                                    <!-- /.image -->

	                                </div>
	                                <!-- /.product-image -->

	                                <div class="product-info text-left">
	                                    <h3 class="name"><a href="javascript:void(0);">Floral Print Buttoned</a></h3>
	                                    <div class="rating rateit-small"></div>
	                                    <div class="description"></div>
	                                    <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$800</span> </div>
	                                    <!-- /.product-price -->

	                                </div>
	                                <!-- /.product-info -->
	                                <div class="cart clearfix animate-effect">
	                                    <div class="action">
	                                        <ul class="list-unstyled">
	                                            <li class="add-cart-button btn-group">
	                                                <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
	                                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
	                                            </li>
	                                            <li class="lnk wishlist">
	                                                <a class="add-to-cart" href="javascript:void(0);" title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
	                                            </li>
	                                            <li class="lnk">
	                                                <a class="add-to-cart" href="javascript:void(0);" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a>
	                                            </li>
	                                        </ul>
	                                    </div>
	                                    <!-- /.action -->
	                                </div>
	                                <!-- /.cart -->
	                            </div>
	                            <!-- /.product -->

	                        </div>
	                        <!-- /.products -->
	                    </div>
	                    <!-- /.item -->

	                    <div class="item item-carousel">
	                        <div class="products">
	                            <div class="product">
	                                <div class="product-image">
	                                    <div class="image">
	                                        <a href="javascript:void(0);"><img src="assets/images/products/p10.jpg" alt=""></a>
	                                    </div>
	                                    <!-- /.image -->

	                                    <div class="tag sale"><span>sale</span></div>
	                                </div>
	                                <!-- /.product-image -->

	                                <div class="product-info text-left">
	                                    <h3 class="name"><a href="javascript:void(0);">Floral Print Buttoned</a></h3>
	                                    <div class="rating rateit-small"></div>
	                                    <div class="description"></div>
	                                    <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$800</span> </div>
	                                    <!-- /.product-price -->

	                                </div>
	                                <!-- /.product-info -->
	                                <div class="cart clearfix animate-effect">
	                                    <div class="action">
	                                        <ul class="list-unstyled">
	                                            <li class="add-cart-button btn-group">
	                                                <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
	                                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
	                                            </li>
	                                            <li class="lnk wishlist">
	                                                <a class="add-to-cart" href="javascript:void(0);" title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
	                                            </li>
	                                            <li class="lnk">
	                                                <a class="add-to-cart" href="javascript:void(0);" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a>
	                                            </li>
	                                        </ul>
	                                    </div>
	                                    <!-- /.action -->
	                                </div>
	                                <!-- /.cart -->
	                            </div>
	                            <!-- /.product -->

	                        </div>
	                        <!-- /.products -->
	                    </div>
	                    <!-- /.item -->
	                </div>
	                <!-- /.home-owl-carousel -->
	            </section>
	        	<!-- Featured products ends -->
	        </div>
    	<?php } else { ?>
    		<div class="container">
    			<div class="row">
					<div class="alert alert-info">
						No product(s) available
					</div>
    			</div>
    		</div>
    	<?php } ?>
    </div>



<?php include('layouts/footer.php'); ?>

