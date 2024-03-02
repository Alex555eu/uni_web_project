    const search = document.querySelector('input[placeholder="Search"]');
    const search_category = document.querySelector('select[name="selected_category"]');
    const search_store = document.querySelector('select[name="selected_store"]');
    const productContainer = document.querySelector(".product-list");

    search.addEventListener("keyup", fetchMeData);
    search_category.addEventListener("change", fetchMeData);
    search_store.addEventListener("change", fetchMeData);

    function fetchMeData(event) {
        event.preventDefault();

        const data = {search: search.value, search_category: search_category.value, search_store: search_store.value};

        fetch("/search", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (products) {
            productContainer.innerHTML = '';
            loadProducts(products)
        })
    }

    function loadProducts(products) {
        products.forEach(product => {
            createProduct(product);
        });
    }

    function createProduct(product) {

        const template = document.querySelector("#product-template");

        const clone = template.content.cloneNode(true);
        const a_tag = clone.querySelector("a");
        let tmp1 = "/select_product?id=" + product.id;
        a_tag.setAttribute('href', tmp1);
        const image = clone.querySelector("img");
        image.src = `${product.image}`;

        const name = clone.querySelector("h2");
        name.innerHTML = product.name;

        const price = clone.querySelector("p");
        price.innerHTML = product.price + ' $';


        productContainer.appendChild(clone);
    }
