/*
    JS Script for manipulating Cart total price section
    SAMPLE HTML:
    <p>
        <span>Total Price</span>
        <span>$ 200</span>
    </p>
    <p>
        <span>Number of Items</span>
        <span>2</span>
    </p>
    <a href="#">Proceed to Checkout</a>
 */
function cartTotalPriceDomObjConstructor(priceStr) {
    //Create <p> element
    const cartTotalPriceElement = document.createElement("p");
    //Create title span and text
    const cartTotalPriceTitleElement = document.createElement("span");
    cartTotalPriceTitleElement.appendChild(document.createTextNode("Total Price"));
    //Create Price span and text
    const cartTotalPriceValueElement = document.createElement("span");
    cartTotalPriceValueElement.appendChild(document.createTextNode(priceStr));

    //Append Title and Price to parent <p> element
    cartTotalPriceElement.appendChild(cartTotalPriceTitleElement);
    cartTotalPriceElement.appendChild(cartTotalPriceValueElement);

    //Return object
    return cartTotalPriceElement;
}

function cartNumberOfItemsDomObjConstructor(count) {
    //Create <p> element
    const cartNumberOfItemsElement = document.createElement("p");
    //Create title span and text
    const cartNumberOfItemsTitleElement = document.createElement("span");
    cartNumberOfItemsTitleElement.appendChild(document.createTextNode("Number of Items"));
    //Create Price span and text
    const cartNumberOfItemsValueElement = document.createElement("span");
    cartNumberOfItemsValueElement.appendChild(document.createTextNode(count));

    //Append Title and Price to parent <p> element
    cartNumberOfItemsElement.appendChild(cartNumberOfItemsTitleElement);
    cartNumberOfItemsElement.appendChild(cartNumberOfItemsValueElement);

    //Return object
    return cartNumberOfItemsElement;

}

function cartCheckoutButtonDomObjConstructor() {
    //Create <a> element
    const cartCheckoutButtonElement = document.createElement("a");
    cartCheckoutButtonElement.href = "#";
    //Append Text
    cartCheckoutButtonElement.appendChild(document.createTextNode("Proceed to Checkout"));

    //Return
    return cartCheckoutButtonElement;
}

function reformatPrice(number) {
    if (number < 1000) return "VND " + number.toString();
    let digitsGroups = number.toString().match(/(\d+?)(?=(\d{3})+(?!\d)|$)/g);
    let splitNumberStr = digitsGroups[0];
    for (let i = 1; i < digitsGroups.length; i++) {
        splitNumberStr += "," + digitsGroups[i];
    }
    return "VND " + splitNumberStr;
}
