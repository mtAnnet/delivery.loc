function hiddenList() {
    let search_field_list = document.getElementById('search_field_list');

    if (document.getElementById('search_field').value === "") {
        search_field_list.classList.add('d-none');
    } else {
        search_field_list.classList.remove('d-none');
    }
}

function submit(title) {
    document.getElementById("search_field").value = title;
    document.getElementById('search_form').submit();
}

function autoPredictorFunction(route) {
    var inputElm = document.getElementById("search_field");

    inputElm.addEventListener('input', onInput);

    function onInput() {
        let duration = 300;
        clearTimeout(inputElm._timer);
        inputElm._timer = setTimeout(() => {
            update(this.value);
        }, duration);
    }

    function update() {
        let input_value = document.getElementById("search_field").value;
        let url = route;
        let search_value = {
            value: input_value,
            '_token': document.querySelector('meta[name="csrf-token"]').content // добавляем CSRF токен
        };

        fetch(url,
            {
                headers: {
                    'Content-Type': 'application/json'
                },
                method: 'POST',
                body: JSON.stringify(search_value),
            }
        )

            .then((response) => {
                return response.json();
            })

            .then((data) => {
                document.getElementById("search_field_list").innerHTML = data.result;
            });
    }
}
