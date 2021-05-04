function addProductToCart(itemIndex) {
    //Increase product count by 1
    CartItems.increaseItemCount(itemIndex);
    //Write cart array to localStorage
    localStorage.setItem("cartItems",JSON.stringify(CartItems));
    for (let i = 0; i < CartItems.items.length; i++) {
        console.log("Written " + CartItems.getCartItemName(i) + " to localStorage.");
    }
    //Write total price
    let totalPrice = CartItems.getTotalPrice();
    localStorage.setItem("totalPrice",totalPrice);
}