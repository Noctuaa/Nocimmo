<template>
    <div class="col-xl-9 col-lg-8 col-md-12 col-12">
        <div class="row">
            <div v-for="(n, index) in realEstate" :key="index" class="mr-xl-0 col-xl-4 col-sm-6 col-12 d-flex
            justify-content-center justify-content-lg-start">
                <a :href="currentUrl + '/' +  n.slug">
                    <div class="estate_list card mb-3">
                        <div class="estate_img">
                            <img :src="'/images/realEstates/'+ n.id +'/Thumbnail/thumbnail_' + n.id + '.jpg'" loading="lazy" :alt="'Vignette ' + n.name">
                        </div>
                        <div class="card-body">
                            <h4>{{n.name}}</h4>
                            <div class="estate_details">
                                <span class="detail">
                                    <font-awesome-icon class="fa-icon" icon="bed" />
                                    {{n.bedroom}}
                                </span>
                                <span class="detail">
                                    <font-awesome-icon class="fa-icon" icon="bath" />
                                    {{n.bathroom}}
                                </span>
                                <span class="detail">
                                    <font-awesome-icon class="fa-icon" icon="map-marked-alt" />
                                    {{n.area}} m²
                                </span>
                            </div>
                            <div class="estate_description">
                                <p>
                                    {{getExcerpt(n.description) }}
                                </p>
                            </div>
                        </div>
                        <div class="estate_price card-footer">
                            {{new Intl.NumberFormat().format(n.price)}} €
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <pagination v-if="pagination.last_page > 1" :pagination="pagination" @paginate="post()" :offset="6"></pagination>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex';
    import pagination from  './Pagination';
    export default {
        components: {pagination},
        data() {
            return {
                realEstate: [],
                pagination: Object,
                response: ''
            }
        },

        methods: {
            /**
             * Returns an excerpt from the domain description
             * @param {string} str - Estate description
             * @returns {string} 
             */
            getExcerpt(str) {
                if(str.length > 100) {
                    const content = str.substring(0, str.indexOf(' ', 100)) + ' ...'
                    return content;
                }

                return str;
            },

            /**
             * Get the estate list with or without query filter
             */
            async post() {
                try {
                    if(this.filter === null) {
                        this.response = await axios.get(this.currentUrl + '?page=' + this.pagination.current_page);
                    }else{
                        this.response = await axios.post(this.currentUrl + '/filter?page=' + this.pagination.current_page, this.filterData);
                    }

                    this.realEstate = this.response.data.items;
                    this.pagination = this.response.data.pagination;

                } catch (error) {
                    console.log(error);
                }
            },
        },
        computed: {
            ...mapGetters([
                'realEstates',
                'filter',
                'paginate',
                'filterData'
            ]),
            
            currentUrl(){
                return window.location.href;
            }
        },

        mounted() {
            this.post();
        },

        watch: {
            /**
             * Get the estate list and the pagination when using the filter search
             * @param {Boolean} newValue - Indicates if the search filter is used
             */
            filter(newValue) {
                if(newValue){
                    this.realEstate = this.realEstates;
                    this.pagination = this.paginate;
                    this.$store.dispatch('reset');
                }
            }
        }
    }

</script>