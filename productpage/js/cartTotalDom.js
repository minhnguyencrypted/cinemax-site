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
    cartTotalPriceValueElement.id = "cartTotalPriceValue";
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
    cartNumberOfItemsValueElement.id = "numberOfItems";

    //Append Title and Price to parent <p> element
    cartNumberOfItemsElement.appendChild(cartNumberOfItemsTitleElement);
    cartNumberOfItemsElement.appendChild(cartNumberOfItemsValueElement);

    //Return object
    return cartNumberOfItemsElement;
}

function setDiscountedPrice(discountedPriceStr) {
    //Get current total price element
    let currentTotalPriceValueElement = document.getElementById("cartTotalPriceValue");
    //Cross out current price
    currentTotalPriceValueElement.style.textDecoration = "line-through";

    //Check if discounted price element already exists
    let currentDiscountedPriceElement = document.getElementById("discountedPriceValue");
    if (currentDiscountedPriceElement) {
        currentDiscountedPriceElement.innerText = discountedPriceStr;
    } else {
        //Create new discounted price element
        const discountedTotalPriceElement = document.createElement("p");
        discountedTotalPriceElement.id = "discountedPrice";
        //Create span elements
        const discountedTotalPriceTextElement = document.createElement("span");
        discountedTotalPriceTextElement.appendChild(document.createTextNode("New Price"));
        const discountedTotalPriceValueElement = document.createElement("span");
        discountedTotalPriceValueElement.appendChild(document.createTextNode(discountedPriceStr));
        discountedTotalPriceValueElement.id = "discountedPriceValue";
        //Append span elements to <p> element
        discountedTotalPriceElement.appendChild(discountedTotalPriceTextElement);
        discountedTotalPriceElement.appendChild(discountedTotalPriceValueElement);

        const currentTotalPriceValueElementParent = currentTotalPriceValueElement.parentNode;
        //Append new element after current total price element
        currentTotalPriceValueElementParent.parentNode.insertBefore(
            discountedTotalPriceElement,
            currentTotalPriceValueElementParent.nextSibling);
    }
}

function unsetDiscountedPrice() {
    //Get current total price element
    let currentTotalPriceValueElement = document.getElementById("cartTotalPriceValue");
    //Uncross out current price
    currentTotalPriceValueElement.style.removeProperty("text-decoration");

    //Remove discounted price element
    let discountedPriceElement = document.getElementById("discountedPrice");
    if (discountedPriceElement) {
        discountedPriceElement.parentNode.removeChild(discountedPriceElement);
    }
}

function updateCartTotal(discountPercentage) {
    let newTotalPriceStr = JSON.parse((localStorage.getItem("totalPrice")));
    let newDiscountedPriceStr = reformatPrice(newTotalPriceStr * (100 -discountPercentage) / 100);
    newTotalPriceStr = reformatPrice(newTotalPriceStr);

    //Get total price element and update it
    let currentTotalPrice = document.getElementById("cartTotalPriceValue");
    currentTotalPrice.innerText = newTotalPriceStr;
    //In case discount is applied, update discounted price as well
    let currentDiscountTotalPrice = document.getElementById("discountedPrice");
    if (currentDiscountTotalPrice) {
        currentDiscountTotalPrice.innerText = newDiscountedPriceStr;
    }
    //Update total item count
    document.getElementById("numberOfItems").innerText = JSON.parse(localStorage.getItem("totalItemCount"));

}