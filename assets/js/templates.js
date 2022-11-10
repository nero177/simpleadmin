
function onTemplateUpload(){
    if(!this.value.includes('.zip')){
        errorPopup('File extension must be .zip');
        return;
    }

    if(this.value){
        this.form.submit();
    }
}

document.querySelectorAll('.template-card').forEach(templateCard => {   
    templateCard.onclick = () => {
        if(templateCard.classList.contains('template-card-upload'))
            return;
        
        document.querySelectorAll('.template-card').forEach(templateCard => {
            templateCard.classList.remove('template-card_active');
        });

        templateCard.classList.add('template-card_active');
        templateCard.querySelector('.selectTemplateForm').submit();
    }
});
