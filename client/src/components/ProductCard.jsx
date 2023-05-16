import React from "react";

function ProductCard(props) {

    const {SKU, Name, Price, Size, Weight, Dimensions} = props.product;

    const handleCheckboxClick = () => {

        props.massDeleteHandler(props.product.SKU);
    }

    return (
        <div className="card">
            <input className="delete-checkbox" type="checkbox"
                   checked={props.massDeleteList.includes(props.product.SKU)}
                   onChange={handleCheckboxClick}/>

            <div className="product-info">
                <h3 className="product-info--sku">{SKU}</h3>
                <h2 className="product-info--name">{Name}</h2>
                <h4 className="product-info--price">${Price}</h4>

                {Weight != null && <p>Weight: {Weight}KG</p>}
                {Size != null && <p>Size: {Size} MB</p>}
                {Dimensions != null && <p>Dimension: {Dimensions}</p>}
            </div>
        </div>
    )
}

export default ProductCard;