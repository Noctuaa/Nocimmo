<template>
<div class="col-xl-3 col-lg-4 col-md-9 col-sm-9 col-12 query_filter">
    <div class="sidebar_search">
        <form id="filter" @submit.prevent="searchFilter" method="get">
            <label for="bedroom">Min.Chambre</label>
            <select class="form-control" name="bedroom" id="bedroom" v-model="form.bedroom">
                <option value="" disabled>Min.Chambre</option>
                <option v-for="i in 10" :key="i" :value="i">{{i}}</option>
            </select>
            <label for="bathroom">Min.Salle de Bain</label>
            <select class="form-control" name="bathroom" id="bathroom" v-model="form.bathroom">
                <option value="" disabled >Min.Salle de Bain</option>
                <option v-for="i in 10" :key="i" :value="i">{{i}}</option>
            </select>

            <label for="area">Min.Superficie</label>
            <input class="form-control" v-model.number="form.area" type="number" name="area" id="area" min="0" placeholder="Min.Superficie">
 
            <label for="min_price">Prix.min</label>
            <input class="form-control" v-model.number="form.min_price" step="0.01" type="number" name="min_price" id="min_price" min="0" value="0">

            <label for="max_price">Prix.max</label>
            <input class="form-control" v-model.number="form.max_price" type="number" name="max_price" id="max_price" min="0" placeholder="Prix.max">

            <button class="btn btn-primary" type="submit">Rechercher</button>
        </form>
    </div>
</div>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    bedroom: '',
                    bathroom: '',
                    area: '',
                    min_price: 0,
                    max_price: ''
                },
            }
        },
        methods: {
            /**
             * Send the filter search and if ok then we store the data with vuex [filterEstates.js]
             */
            async searchFilter(){
                const url = window.location.href + '/filter';
                this.form.min_price === "" ? this.form.min_price = 0 : ''
                try {
                    const response = await axios.post(url, this.form);

                    this.$store.dispatch('success', {
                        realEstates : response.data.items,
                        pagination : response.data.pagination,
                        filterData :  this.form,
                    });

                } catch (error) {
                    console.log(error.response);
                }
            }
        },

        watch: {
            min_price(newValue){
                if(newValue){
                    console.log('ok');
                }
            }
        }
    }

</script>
