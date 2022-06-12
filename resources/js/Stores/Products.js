import { defineStore } from 'pinia';
import { isset } from '../Helpers';

export const useProducts = defineStore('products', {
    state: () => ({
        datasets: []
    }),
    getters: {
        getById: (state) => (id) => {
            return isset(
                () => state.datasets.filter((data) => data.id == id)[0]
            );
        },
        getStockLeft:
            (state) =>
            (id, quantity = null) => {
                const data = state.getById(id);
                if (!data) return null;

                if (typeof quantity === 'number')
                    return (
                        parseInt(data.stock) -
                        (parseInt(quantity) + parseInt(data.quantity || 0))
                    );
                else if (data.quantity)
                    return parseInt(data.stock) - parseInt(data.quantity);
                else return parseInt(data.stock);
            }
    },
    actions: {
        updateQuantity(id, quantity) {
            const indexToUpdate = this.datasets.findIndex(
                (data) => data.id == id
            );
            this.$patch((state) => {
                state.datasets[indexToUpdate]['quantity'] = quantity;
            });
        }
    },
    persist: true
});
