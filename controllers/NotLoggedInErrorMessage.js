function displayNotLoggedInFav(errorMessageId) {
    let errorMessage = document.getElementById(errorMessageId);
    if (errorMessage) {
        errorMessage.innerHTML = "Впишете се, за да добавяте към любими.";
    }

    setTimeout(hideErrorMessage, 3000, errorMessage);
}

function displayNotLoggedInCart(errorMessageId) {
    let errorMessage = document.getElementById(errorMessageId);
    if (errorMessage) {
        errorMessage.innerHTML = "Впишете се, за да добавяте към количката.";
    }

    setTimeout(hideErrorMessage, 3000, errorMessage);
}

function hideErrorMessage(errorMessage) {
    errorMessage.innerHTML = "";
}
