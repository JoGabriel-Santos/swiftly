import React, { useEffect, useState } from "react";

import ProductCard from "../components/ProductCard";

import * as api from "../api/index";

function ProductList() {

    const [productList, setProductList] = useState([]);
    const [massDelete, setMassDelete] = useState([]);
    const [isDeleting, setIsDeleting] = useState(false);

    const updateProductList = async () => {
        const {data} = await api.fetchProducts();

        setProductList(data?.result.results);
    };

    const fetchProducts = async () => {
        try {
            await updateProductList();

        } catch (error) {

            console.log(error.message);
        }
    }

    const massDeleteAction = async () => {
        setIsDeleting(true);

        try {
            await Promise.all(massDelete.map((productSKU) => api.deleteProduct(productSKU)));
            setMassDelete([]);

            await updateProductList();

        } catch (error) {

            console.log(error.message);
        }

        setIsDeleting(false);
    }

    const massDeleteHandler = (deleteProduct) => {
        if (massDelete.includes(deleteProduct)) {
            setMassDelete(massDelete.filter(product => product !== deleteProduct));

        } else {
            setMassDelete([...massDelete, deleteProduct]);
        }
    }

    useEffect(() => {

        fetchProducts();
    }, []);

    return (
        <React.Fragment>
            <header className="header">
                <h1>Product List</h1>

                <div className="header-buttons">
                    <a href="/add-product">
                        <button className="button">ADD</button>
                    </a>

                    <button className="button delete" id="delete-product-btn" onClick={massDeleteAction}>
                        MASS DELETE
                    </button>
                </div>
            </header>

            <section className="section-products">

                {
                    productList !== null ?
                        productList?.map((product, key) => (

                            <div className="product-card" key={key}>
                                <ProductCard
                                    product={product}
                                    massDeleteHandler={massDeleteHandler}
                                    massDeleteList={massDelete}
                                />
                            </div>

                        )) : <h2 className="product-list-empty">No items were found...</h2>
                }

            </section>
        </React.Fragment>
    )
}

export default ProductList;