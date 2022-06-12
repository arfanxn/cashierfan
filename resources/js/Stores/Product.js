import { defineStore } from 'pinia';

export const useProduct = defineStore('product', {
    state: () => ({
        id: null,
        barcode: '',
        name: '',
        description: '',
        image: '',
        tax_percentage: 0,
        tax: 0,
        profit_percentage: 0,
        profit: 0,
        gross_price: 0,
        net_price: 0,
        stock: 0
    }),
    getters: {
        getNetPriceMultipleBy: (state) => (quantity) => {
            quantity = parseInt(quantity);
            if (typeof quantity !== 'number') return state.net_price;
            return parseFloat(state.net_price) * quantity;
        }
    },
    actions: {
        fill(product) {
            this.id = product.id;
            this.barcode = product.barcode;
            this.name = product.name;
            this.description = product.description;
            this.image = product.image;
            this.tax_percentage = product.tax_percentage;
            this.tax = product.tax;
            this.profit_percentage = product.profit_percentage;
            this.profit = product.profit;
            this.gross_price = product.gross_price;
            this.net_price = product.net_price;
            this.stock = product.stock;
        }
    }
    // persist: true,
});
