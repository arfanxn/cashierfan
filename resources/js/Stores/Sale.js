import { defineStore } from 'pinia';
import { useProducts } from './Products.js';

export const useSale = defineStore('sale', {
    state: () => ({
        cashier: ``,
        customer: ``,

        customer_pay_money: 0.0,

        discount: 0.0
    }),
    getters: {
        products: () => useProducts(),

        customer_change_money: (state) => {
            return (
                parseFloat(state.customer_pay_money) -
                    parseFloat(state.sum_net_price) || 0.0
            );
        },

        sum_tax: (state) => {
            let sum = parseFloat(0.0); // refresh sum
            state.products.datasets.forEach((product) => {
                sum += parseFloat(product.tax) * product.quantity;
            });
            return sum;
        },
        sum_profit: (state) => {
            let sum = parseFloat(0.0); // refresh sum
            state.products.datasets.forEach((product) => {
                sum += parseFloat(product.profit) * product.quantity;
            });
            return sum;
        },

        sum_gross_price: (state) => {
            let sum = parseFloat(0.0); // refresh sum
            state.products.datasets.forEach((product) => {
                sum += parseFloat(product.gross_price) * product.quantity;
            });
            return sum;
        },
        sum_net_price: (state) => {
            let sum = parseFloat(0.0); // refresh sum
            state.products.datasets.forEach((product) => {
                // add "sum" variable by "sum_net_price" of each product
                sum += parseFloat(product.net_price) * product.quantity;
            });
            sum -= parseFloat(state.discount); // subtract the "sum" variable by "discount"
            return sum;
        }
    },
    actions: {
        addProduct(product) {
            console.log(product);

            this.products.$patch((productsState) => {
                const indexOfProduct = productsState.datasets
                    .map((p) => p.id)
                    .indexOf(product.id);

                if (indexOfProduct > -1) {
                    // get the already added product for backup purposes
                    const backupProduct =
                        productsState.datasets[indexOfProduct];
                    // remove the already added product
                    productsState.datasets.splice(indexOfProduct, 1);

                    // push(unshift) the previously getted product to display on the first index
                    productsState.datasets.unshift({
                        ...backupProduct,
                        quantity:
                            parseInt(product.quantity) +
                            parseInt(backupProduct.quantity)
                    });

                    return;
                } else {
                    productsState.datasets.unshift({ ...product });
                }
            });
        },
        removeProduct(id) {
            const indexToRemove = this.products.datasets
                .map((stateProduct) => stateProduct.id)
                .indexOf(id);
            if (indexToRemove < 0) return;

            this.products.$patch((productsState) => {
                productsState.datasets.splice(indexToRemove, 1);
            });
        }

        //
    },
    persist: true
});
