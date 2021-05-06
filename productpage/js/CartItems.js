//CartItems Class
class CartItems {
    //Attributes
    itemList;
    itemCount;

    //Constructor
    constructor(itemList, itemCount) {
        this.itemList = itemList;
        this.itemCount =  itemCount;
    }

    //Methods
    //Setters
    setItemCount(itemIndex, countValue) {
        this.itemList[itemIndex].count = countValue;
    }

    //Getters
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

    getItemCount() {
        return this.itemCount;
    }

    //Debug methods
    logItems() {
        for (let item of this.itemList) {
            console.log("name: " + item.name + " price: " + item.price + " count: " + item.count);
        }
    }
}