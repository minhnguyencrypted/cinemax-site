const defaultItems = [
    {
        "name" : "BMW R 1250 GSA",
        "price" : 699000000,
        "count" : 0,
        "imgSrc" : "product_img/foobar.png",
        "id" : 0
    },

    {
        "name" : "Royal Enfield Himalayan",
        "price" : 139000000,
        "count" : 0,
        "imgSrc" : "product_img/foo.png",
        "id" : 1
    },

    {
        "name" : "Triumph Tiger 850 Sport",
        "price" : 349900000,
        "count" : 0,
        "imgSrc" : "product_img/bar.png",
        "id" : 2
    }
]

function retrieveItemsList() {
    console.log(localStorage.getItem("cartItems"));
    if (localStorage.getItem("cartItems")) {
        //cartItems key and value is found at localStorage
        let cartItemsStr = localStorage.getItem("cartItems");
        return JSON.parse(cartItemsStr);
    } else {
        //cartItems key and value not found at localStorage
        return false;
    }
}

function addItemToCart(itemIndex) {
    //Try to retrieve cart items
    //If no key and value found, construct new object with default items
    let tryItemList = retrieveItemsList();
    let cartItemCount = tryItemList ? tryItemList.itemsCount : 0;
    let cartItemsObj = new CartItems(tryItemList ? tryItemList.itemList : defaultItems, cartItemCount);
    //Increase chosen item count and total item count by one
    cartItemsObj.itemList[itemIndex].count++;
    cartItemsObj.itemsCount++;
    //Write the object to localStorage
    localStorage.setItem("cartItems",JSON.stringify(cartItemsObj));
    cartItemsObj.logItems();    //Console logging
    //Write the total price and item count values to localStorage
    localStorage.setItem("totalPrice",cartItemsObj.getTotalPrice());
    localStorage.setItem("totalItemCount",cartItemsObj.getItemsCount());
    //Return added Item
    return cartItemsObj.getCartItemName(itemIndex);
}

function removeItemFromCart(itemIndex) {
    //Retrieve data on localStorage
    let retrievedCartData = JSON.parse(localStorage.getItem("cartItems"));
    let retrievedTotalPrice = JSON.parse(localStorage.getItem("totalPrice"));
    let retrievedTotalItemCount = JSON.parse(localStorage.getItem("totalItemCount"));

    //Edit the totalPrice and totalItemCount values
    let removeItemCount = retrievedCartData.itemList[itemIndex].count;
    let removeItemPrice = retrievedCartData.itemList[itemIndex].price;
    retrievedTotalItemCount -= removeItemCount;
    retrievedTotalPrice -= removeItemPrice * removeItemCount;
    //Edit the indexed element of item list count to zero
    retrievedCartData.itemList[itemIndex].count = 0;
    retrievedCartData.itemsCount -= removeItemCount;
    //Write the edited data back to localStorage
    localStorage.setItem("cartItems",JSON.stringify(retrievedCartData));
    localStorage.setItem("totalPrice",JSON.stringify(retrievedTotalPrice));
    localStorage.setItem("totalItemCount",JSON.stringify(retrievedTotalItemCount));
}