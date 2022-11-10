<?php
    use App\Classes\Page;
    use App\Classes\TemplatesManager;
    
    Page::part('header');
    Page::part('navbar');
?>
  <div class="admin-content">
        <div class="panel">
            <h2 class="section-title">Templates</h2>
            <div class="template-cards"> 
                
                <?php
                    $templates = TemplatesManager::loadTemplates();
              
                    foreach($templates as $template){
                        ?>
                        <div class="template-card <?php if('uploaded_templates/' . $template === TemplatesManager::$selected_template):?>template-card_active<?php endif;?>">
                            <form action="admin/deleteTemplate" method="post">
                                <input type="hidden" value="<?=$template?>" name="template_name">
                                <button type="submit" class="template-card__delete"><img src="assets/images/delete.png" alt=""></button>
                            </form>
                            <form action="admin/selectTemplate" method="post" class="selectTemplateForm">
                                <div class="template-card__name"><?=$template?></div>
                                <input type="hidden" name="template_name" value="<?=$template?>">
                            </form>
                        </div>
                        <?php
                    }
                ?>
                <div class="template-card template-card-upload">
                    <form action="admin/uploadTemplate" enctype="multipart/form-data" method="post">
                        <input type="file" name="templateArchive" oninput="onTemplateUpload.bind(this)()" class="upload-input">
                        <div class="plus-icon"><span>+</span></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/utils.js"></script>
    <script src="assets/js/templates.js"></script>