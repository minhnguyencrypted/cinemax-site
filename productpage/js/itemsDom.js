function itemInfoDomObjectConstructor(name, price, count) {
    //Create div (class: item_info) element
    const itemInfo = document.createElement("div");
    itemInfo.className = "item_info";

    //Create item name (class: item_name) element
    const itemInfoName = document.createElement("h3");
    itemInfoName.className = "item_name";
    //Give item name value and append child node
    const itemInfoNameValue = document.createTextNode(name);
    itemInfoName.appendChild(itemInfoNameValue);

    //Create item price (class: item_price) element
    const itemInfoPrice = document.createElement("h4");
    itemInfoPrice.className = "item_price";
    //Give item price value and append child node
    const itemInfoPriceValue = document.createTextNode(price);
    itemInfoPrice.appendChild(itemInfoPriceValue);

    //Create item count (class: item_quantity) element
    //Sample <p class=item_quantity">Qnt: <input type="number" value="1" name="" class="item_quantity_input"></p>
    const itemInfoCount = document.createElement("p");
    itemInfoCount.className = "item_quantity";
    //Give item count text and append child node
    const itemInfoCountText = document.createTextNode("Qnt: ");
    itemInfoCount.appendChild(itemInfoCountText);
    //Create input field and give current value
    const itemInfoInputField = document.createElement("input");
    itemInfoInputField.type = "number";
    itemInfoInputField.value = count;
    itemInfoInputField.className = "item_quantity_input";
    //Append itemInfoInputField to itemInfoCount
    itemInfoCount.appendChild(itemInfoInputField);

    //Append name, price and count nodes to div (item_info) node
    itemInfo.appendChild(itemInfoName);     //Append Name
    itemInfo.appendChild(itemInfoPrice);     //Append Price
    itemInfo.appendChild(itemInfoCount);     //Append Count

    //Return
    return itemInfo;
}

function itemRemoveButtonDomObjectConstructor() {
    /*
        <p class="item_remove">
            <i class="fa fa-trash" aria-hidden="true"></i>
            <span class="remove">Remove</span>
        </p>
     */
    const itemRemoveButton = document.createElement("p");
    itemRemoveButton.className = "item_remove";

    //Create child element <i>
    const iChildElement = document.createElement("i");
    iChildElement.className = "fa fa-trash";
    iChildElement.ariaHidden = "true";
    //Append iChildElement to itemRemoveButton
    itemRemoveButton.appendChild(iChildElement);

    //Create child element <span>
    const spanChildElement = document.createElement("span");
    spanChildElement.className = "remove";
    //Append text node
    spanChildElement.appendChild(document.createTextNode("Remove"));
    //Append spanChildElement to itemRemoveButton
    itemRemoveButton.appendChild(spanChildElement);

    //Return
    return itemRemoveButton
}

//Construct a DOM object for item
function itemDomObjectConstructor(itemObj) {
    //Create div (class: item) element
    const item = document.createElement("div");
    item.className = "item";
    //Create img element
    const itemImg = document.createElement("img");
    itemImg.src = itemObj.imgSrc;
    itemImg.style.objectFit = "scale-down";
    //Append itemImg to item node
    item.appendChild(itemImg);

    //Create item info object
    let name = itemObj.name;
    let price = itemObj.price;
    let count = itemObj.count;
    const itemInfo = itemInfoDomObjectConstructor(name,price,count);
    //Append itemInfo remove button to item node
    itemInfo.appendChild(itemRemoveButtonDomObjectConstructor());

    //Append itemInfo to item node
    item.appendChild(itemInfo);

    //Return
    return item;
}