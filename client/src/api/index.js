import axios from "axios";

const API = axios.create({baseURL: 'http://localhost/swiftly/server'});

export const fetchProducts = () => API.get('/products/all');
export const newProduct = (productData) => API.post('/products/new', JSON.stringify(productData));
export const deleteProduct = (productSKU) => API.delete(`/products/delete/${productSKU}`);