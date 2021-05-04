let defaultItems = [
    {
        "name" : "BMW R 1250 GSA",
        "price" : 699000000,
        "count" : 0
    },

    {
        "name" : "Royal Enfield Himalayan",
        "price" : 139000000,
        "count" : 0
    },

    {
        "name" : "Triumph Tiger 850 Sport",
        "price" : 349900000,
        "count" : 0
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
    let cartItemsObj = new CartItems(tryItemList ? tryItemList.itemList : defaultItems);
    //Increase chosen item count by one
    cartItemsObj.itemList[itemIndex].count++;
    //Write the object to localStorage
    localStorage.setItem("cartItems",JSON.stringify(cartItemsObj));
    cartItemsObj.logItems();    //Console logging
    //Write the total price value to localStorage
    localStorage.setItem("totalPrice",cartItemsObj.getTotalPrice());

    //Return added Item
    return cartItemsObj.getCartItemName(itemIndex);
}