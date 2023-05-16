import React from "react";

export const productTypes = {
    Book: {
        weightLabel: <label htmlFor="weight">Weight (KG)</label>,
        description: "Please, provide weight"
    },
    DVD: {
        sizeLabel: <label htmlFor="size">Size (MB)</label>,
        description: "Please, provide size"
    },
    Furniture: {
        heightLabel: <label htmlFor="height">Height (CM)</label>,
        widthLabel: <label htmlFor="width">Width (CM)</label>,
        lengthLabel: <label htmlFor="length">Length (CM)</label>,
        description: "Please, provide dimensions"
    }
};