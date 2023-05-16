import React, { useState } from "react";
import { useNavigate } from "react-router-dom";

import { productTypes } from "../helpers/productTypes";
import { requiredFields } from "../helpers/requiredTypes";

import * as api from "../api/index";

function AddProduct() {

    const navigate = useNavigate();

    const [productInfo, setProductInfo] =
        useState({sku: "", name: "", price: "", productType: "", weight: "", size: "", height: "", width: "", length: ""});

    const handleSaveProduct = async () => {
        const {sku, name, price, productType, weight, size, height, width, length} = productInfo;

        const required = requiredFields[productType] || [];

        if (![sku, name, price, productType].every(value => value !== "")) {
            alert("Please submit required data");
            return;
        }

        for (const field of required) {
            if (!productInfo[field]) {
                alert("Please submit required data");
                return;
            }
        }

        for (const field of ["price", "weight", "size", "height", "width", "length"]) {
            if (isNaN(productInfo[field])) {
                alert("Please, provide the data of indicated type");
                return;
            }
        }

        try {
            const product = {sku, name, price, productType, size, weight, height, width, length};

            for (const prop in product) {
                if (product[prop] === "") {
                    product[prop] = null;
                }
            }

            await api.newProduct({productInfo: product});
            navigate("/");

        } catch (error) {

            console.log(error.message);
        }
    };

    return (
        <React.Fragment>
            <header className="header">
                <h1>Product Add</h1>

                <div className="header-buttons">
                    <button className="button" onClick={handleSaveProduct}>Save</button>

                    <a href="/">
                        <button className="button delete">Cancel</button>
                    </a>
                </div>
            </header>

            <section className="section-product-add">
                <form className="product-form" id="product_form">
                    <div className="product-attributes--label">
                        <label htmlFor="sku">SKU</label>
                        <label htmlFor="name">Name</label>
                        <label htmlFor="price">Price ($)</label>
                        <label htmlFor="type">Type Switcher</label>

                        {productTypes[productInfo.productType]?.weightLabel}
                        {productTypes[productInfo.productType]?.sizeLabel}
                        {productTypes[productInfo.productType]?.heightLabel}
                        {productTypes[productInfo.productType]?.widthLabel}
                        {productTypes[productInfo.productType]?.lengthLabel}
                    </div>

                    <div className="product-attributes--input">
                        <input id="sku" type="text" value={productInfo.sku}
                               onChange={(event) => setProductInfo({...productInfo, sku: event.target.value})}/>

                        <input id="name" type="text" value={productInfo.name}
                               onChange={(event) => setProductInfo({...productInfo, name: event.target.value})}/>

                        <input id="price" type="text" value={productInfo.price}
                               onChange={(event) => setProductInfo({...productInfo, price: event.target.value})}/>

                        <select id="productType" onChange={(event) => setProductInfo({...productInfo, productType: event.target.value})} required>
                            <option value="">-- Select type --</option>
                            <option value="Book" id="Book">Book</option>
                            <option value="DVD" id="DVD">DVD</option>
                            <option value="Furniture" id="Furniture">Furniture</option>
                        </select>

                        {productInfo.productType === "Book" && (
                            <input id="weight" type="text" value={productInfo.weight}
                                   onChange={(event) => setProductInfo({...productInfo, weight: event.target.value})}/>
                        )}

                        {productInfo.productType === "DVD" && (
                            <input id="size" type="text" value={productInfo.size}
                                   onChange={(event) => setProductInfo({...productInfo, size: event.target.value})}/>
                        )}

                        {productInfo.productType === "Furniture" && (
                            <>
                                <input id="height" type="text" value={productInfo.height}
                                       onChange={(event) => setProductInfo({...productInfo, height: event.target.value})}/>

                                <input id="width" type="text" value={productInfo.width}
                                       onChange={(event) => setProductInfo({...productInfo, width: event.target.value})}/>

                                <input id="length" type="text" value={productInfo.length}
                                       onChange={(event) => setProductInfo({...productInfo, length: event.target.value})}/>
                            </>
                        )}
                    </div>
                </form>

                <p className="description">
                    {productInfo.productType === "Book" && productTypes.Book.description}
                    {productInfo.productType === "DVD" && productTypes.DVD.description}
                    {productInfo.productType === "Furniture" && productTypes.Furniture.description}
                </p>
            </section>
        </React.Fragment>
    )
}

export default AddProduct;