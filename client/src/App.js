import React from "react";
import { BrowserRouter, Routes, Route } from 'react-router-dom';

import ProductList from "./pages/ProductList";
import AddProduct from "./pages/AddProduct";

import "./styles/queries.css";
import "./styles/style.css";

function App() {

    return (
        <BrowserRouter>
            <Routes>
                <Route path="/" element={<ProductList />} />
                <Route path="/add-product" element={<AddProduct />} />
            </Routes>
        </BrowserRouter>
    );
}

export default App;