function errorPopup(message){
    const errorPopup = document.createElement("div");

    errorPopup.innerHTML = message;
    errorPopup.classList.add('error-popup');
    document.body.appendChild(errorPopup);

    setTimeout(() => {
        errorPopup.remove();
    }, 5000)
}