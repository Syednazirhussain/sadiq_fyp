<?php 
    
    $pdo = new pdocrudhandler();
    $categories = (new category())->getNavCategories(6, [6, 12, 13, 14 , 15 ,16]);

    $all_category = [];

    foreach ($categories['result'] as $key => $category) {

            $category = json_decode(json_encode($category), true);
            $child_category = $pdo->select('category', ['*'], 'where parent_id = ?', [$category['id']]);
            if ($child_category['rowsAffected'] > 0) {

                $category['childrens'] = $child_category['result'];
            }
            array_push($all_category, $category);
    }

?>

<div class="container">
    <div class="yamm navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="nav-bg-class">
            <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                <div class="nav-outer">
                    <ul class="nav navbar-nav">
                        <?php foreach ($all_category as $key => $item) { ?>
                            <?php if (isset($item['childrens'])) { ?>
                                <?php if (count($item['childrens']) > 0) { ?>
                                    <li class="dropdown yamm mega-menu"> 
                                        <a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">
                                            <?php echo $item['name'] ?>
                                        </a>
                                        <ul class="dropdown-menu container">
                                            <li>
                                                <div class="yamm-content ">
                                                    <div class="row">
                                                        <?php foreach ($item['childrens'] as $child) { ?>
                                                            <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                                                <a href='category.php?id=<?php echo $child->id; ?>'><?php echo $child->name; ?></a>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                <?php } ?>
                            <?php } else { ?>
                                <li class="dropdown"> <a href="javascript:void(0);"><?php echo $item['name']; ?></a> </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>