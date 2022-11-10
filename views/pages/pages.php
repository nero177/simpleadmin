<?php
use App\Classes\Page;
use App\Classes\App;
use App\Classes\TemplatesManager;

Page::part('header');
Page::part('navbar');
?>
<body>
    <div class="admin-content">
        <div class="panel">
            <h2 class="section-title">Pages</h2>
            <div class="add-page-button">
                +
            </div>
            <div class="pages-list">
                <?php
                    $sql = "SELECT * FROM pages";
                    $pages = App::exec($sql);
                    $pages = $pages->fetchAll();

                    foreach($pages as $page){
                        ?>
                            <div class="pages-list-item">
                                <div class="pages-list-item__title"><a href="#"><?=$page['title']?></a></div>
                                <div class="pages-list-item__controls">
                                    <div class="pages-list-item__editbtn">
                                        <form action="admin/changePageFile" method="post">
                                            <input type="hidden" name="page_title" value="<?=$page['title']?>">
                                            <select name="template_file" class="input-select" onchange="this.form.submit()" value="<?=$page['template_file']?>">
                                            <?php 
                                                $template_pages = TemplatesManager::getTemplatePages(TemplatesManager::$selected_template);

                                                foreach($template_pages as $template_page){
                                                    ?>
                                                    <option 
                                                        value="<?=$template_page['name']?>"
                                                        <?php if($template_page['name'] == $page['template_file']):?>
                                                        selected
                                                        <?php endif;?>
                                                    >
                                                        <?=$template_page['name']?>
                                                    </option>
                                                    <?php
                                                }
                                            ?>
                                             </select>
                                        </form>
                              
                                        <img src="assets/images/down-arrow.png" alt="" class="s-icon">
                                    </div>
                                    <div class="pages-list-item__editbtn"><span>Edit</span> <img src="assets/images/pen.png" alt="" class="s-icon"></div>
                                    <form action="admin/deletePage" method="post">
                                        <input type="hidden" name="id" value="<?=$page['id']?>">

                                        <button type="submit" class="pages-list-item__delete">
                                            <img src="assets/images/delete.png" alt="">     
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="add-page-popup-wrapper hide">
        <div class="add-page-popup">
            <div class="add-page-popup__close">
                &#10006;
            </div>
            <form action="admin/createPage" method="post" id="page-creating-form">
                <div class="input-wrapper">
                    <label>Page title</label>
                    <input type="text" name="title">
                </div>
                <div class="input-wrapper input-wrapper-url">
                    <label>Page url</label>
                    <span class="url-input-slash">/</span>
                    <input type="text" name="url" id="url-input">
                </div>
                <div class="input-wrapper">
                    <label>Page template file</label>
                    <div class="input-select-wrapper">
                        <select name="template_file" class="input-select">
                            <?php 
                                $template_pages = TemplatesManager::getTemplatePages(TemplatesManager::$selected_template);

                                foreach($template_pages as $template_page){
                                    ?>
                                    <option 
                                        value="<?=$template_page['name']?>"
                                    >
                                        <?=$template_page['name']?>
                                    </option>
                                    <?php
                                }
                            ?>
                            
                        </select>
                    </div>  
                </div>
                <button type="submit">Create new page</button>
            </form>
        </div>
    </div>

    <script src="assets/js/utils.js"></script>
    <script src="assets/js/pages.js"></script>
</body>