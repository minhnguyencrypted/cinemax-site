//Class

let CartItems = {
    items : [
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
            "price" : 359900000,
            "count" : 0
        }
    ],

    increaseItemCount : function(itemIndex) {
        return ++this.items[itemIndex].count;
    },

    getTotalPrice : function() {
        let total = 0;
        for (let item of this.items) {
            total += item.price * item.count;
        }
        return total;
    },

    getCartItemName : function(itemIndex) {
        return this.items[itemIndex].name;
    }
}