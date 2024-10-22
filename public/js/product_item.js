window.onload = function() {
    const item_price_tag = document.getElementsByClassName("item_price_tag");
    const item_size_button = document.getElementsByClassName("item_size_button");
    let current_price; // luu lai gia tri hien tai cua price voi moi size 

    item_price_tag[1].style.display = 'block';
    item_size_button[1].classList.add('click')
    current_price = item_price_tag[1].value;

    document.getElementById("item_size_container").addEventListener('click', function(event) {
        const index = Array.prototype.indexOf.call(item_size_button, event.target);
        for (i = 0; i < item_price_tag.length; i++) {
            if (event.target.tagName == 'BUTTON') {
                item_price_tag[i].style.display = 'none';
                item_size_button[i].classList.remove('click');
            }
        }
        if (event.target.tagName == 'BUTTON') {
            item_price_tag[index].style.display = 'block';
            item_size_button[index].classList.add('click');
            let input_item_price = document.getElementsByClassName('input_item_price');
            current_price = input_item_price[index].value;
        }
    });

    let choose_quantity = document.getElementById('choose_quantity');
    let choose_quantity_value = Number(document.getElementById('choose_quantity').value);

    let increase_quantity_button = document.getElementById('increase_quantity_button');
    let decrease_quantity_button = document.getElementById('decrease_quantity_button');

    increase_quantity_button.addEventListener('click', function() {
        if (choose_quantity_value >= 20) {
            choose_quantity_value = 1;
            choose_quantity.value = choose_quantity_value;
        } else if (choose_quantity_value < 20) {
            choose_quantity_value += 1;
            choose_quantity.value = choose_quantity_value;
            increase_quantity_button.classList.add('click');
            decrease_quantity_button.classList.remove('click');
        }
    });

    decrease_quantity_button.addEventListener('click', function() {
        if (choose_quantity_value > 1) {
            choose_quantity_value -= 1;
            choose_quantity.value = choose_quantity_value;
            decrease_quantity_button.classList.add('click');
            increase_quantity_button.classList.remove('click');
        }
    });
}