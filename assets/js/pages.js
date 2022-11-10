const popupWrapper = document.querySelector('.add-page-popup-wrapper');
const popup = document.querySelector('.add-page-popup');

document.querySelector('.add-page-button').onclick = () => {
    popupWrapper.classList.remove('hide');
}

document.querySelector('.add-page-popup__close').onclick = () => {
    popupWrapper.classList.add('hide');
}

popup.onclick = (e) => {
    e.stopPropagation();
}

popupWrapper.onclick = () => {
    popupWrapper.classList.add('hide');
}

/*page creating form validation*/

const urlInput = document.getElementById('url-input');
const pageCreatingForm = document.getElementById('page-creating-form');

pageCreatingForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const validation1 = /((admin\w+)|(^((?!admin)[\s\S])*$))/;
    const validation2 = /\//;

    if(validation1.test(urlInput.value) && !validation2.test(urlInput.value)){
        pageCreatingForm.submit();
    } else {
        errorPopup("page url should not contain '/' or can't be named 'admin'");
    }
}) 