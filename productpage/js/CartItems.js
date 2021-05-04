//CartItems Class
class CartItems {
    //Attributes
    itemList;

    //Constructor
    constructor(itemList) {
        this.itemList = itemList;
    }

    //Methods
    setItemCount(itemIndex, countValue) {
        this.itemList[itemIndex].count = countValue;
    }

    getTotalPrice() {
        let totalPrice = 0;
        for (let item of this.itemList) {
            totalPrice += item.price * item.count;
        }
        return totalPrice;
    }

    getCartItemName(itemIndex) {
        return this.itemList[itemIndex].name;
    }

    //Debug methods
    logItems() {
        for (let item of this.itemList) {
            console.log("name: " + item.name + " price: " + item.price + " count: " + item.count);
        }
    }
}