window.onload = function() {
    const item_price_tag = document.getElementsByClassName("item_price_tag");
    const item_size_button = document.getElementsByClassName("item_size_button");
    const input_price_tag = document.getElementsByClassName("input_price_tag");
    const input_size = document.getElementsByClassName("input_size");

    for (let i = 0; i < item_size_button.length; i++) {
        if (item_size_button[i].value == 'L') {
            for (let j = 0; j < item_size_button.length; j++) {
                console.log(input_size[j]);
                input_size[j].disabled = true;
                input_price_tag[j].disabled = true;
            }
            input_size[i].disabled = false;
            input_price_tag[i].disabled = false;
            item_size_button[i].classList.add('click');
            item_price_tag[i].style.display = 'block';

            break;
        } else if ((i == item_size_button.length - 1) && (item_size_button[i].value != 'L')) {
            for (let j = 0; j < item_size_button.length; j++) {
                input_size[j].disabled = true;
            }
            input_size[i].disabled = false;
            item_size_button[0].classList.add('click');
            item_price_tag[0].style.display = 'block';
            break;
        }
    }


    document.getElementById("item_size_container").addEventListener('click', function(event) {
        const index = Array.prototype.indexOf.call(item_size_button, event.target);
        for (i = 0; i < item_price_tag.length; i++) {
            if (event.target.tagName == 'BUTTON') {
                item_price_tag[i].style.display = 'none';
                item_size_button[i].classList.remove('click');
                input_size[i].disabled = true;
                input_price_tag[i].disabled = true;
            }
        }
        input_size[index].disabled = false;
        input_price_tag[index].disabled = false;
        if (event.target.tagName == 'BUTTON') {
            item_price_tag[index].style.display = 'block';
            item_size_button[index].classList.add('click');
        }
    });

    let choose_quantity = document.getElementById('choose_quantity');
    let quantity = document.getElementById('quantity');
    let choose_quantity_value = Number(document.getElementById('choose_quantity').value);
    let quantity_value = Number(document.getElementById('quantity').value);

    let increase_quantity_button = document.getElementById('increase_quantity_button');
    let decrease_quantity_button = document.getElementById('decrease_quantity_button');

    increase_quantity_button.addEventListener('click', function() {
        if (choose_quantity_value >= 20) {
            choose_quantity_value = 1;
            quantity_value = 1;
            choose_quantity.value = choose_quantity_value;
            quantity.value = quantity_value;
        } else if (choose_quantity_value < 20) {
            choose_quantity_value += 1;
            choose_quantity.value = choose_quantity_value;
            quantity_value += 1;
            quantity.value = quantity_value;
            increase_quantity_button.classList.add('click');
            decrease_quantity_button.classList.remove('click');
        }
    });

    decrease_quantity_button.addEventListener('click', function() {
        if (choose_quantity_value > 1) {
            choose_quantity_value -= 1;
            choose_quantity.value = choose_quantity_value;
            quantity_value -= 1;
            quantity.value = quantity_value;
            decrease_quantity_button.classList.add('click');
            increase_quantity_button.classList.remove('click');
        }
    });



}