<template>
    <nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">
        <ul class="pagination justify-content-center">
            <li class="page-item" :class="pagination.current_page <= 1 ? 'disabled' : ''">
                <a class="page-link" @click.prevent="changePage(pagination.current_page - 1)">Précédent</a>
            </li>
            <li class="page-item" v-for="(page, index) in pages" :key="index" :class="isCurrentPage(page) ? 'active' : ''">
                <a class="page-link" @click="changePage(page)">{{ page }}</a>
            </li>
            <li class="page-item" :class="pagination.current_page >= pagination.last_page ? 'disabled' : ''">      
                <a class="page-link" @click.prevent="changePage(pagination.current_page + 1)">Suivant</a>
            </li>
        </ul>
    </nav>
</template>
<script>
    export default {
        props: ['pagination', 'offset'],

        methods: {
            /**
             * @param {!number} page - Pagination number current page
             */
            isCurrentPage(page) {
                return this.pagination.current_page === page;
            },
            /**
             * @param {!number} page - Pagination number change page
             */
            changePage(page) {
                if (page > this.pagination.last_page) {
                    page = this.pagination.last_page;
                }
                this.pagination.current_page = page;
                this.$emit('paginate');
            }
        },
        computed: {
            /**
             * Returns an array with visible pagination numbers, we use the this.offset
             * @returns {Array} 
             */
            pages() {
                let range = [];
                let from = this.pagination.current_page - Math.ceil(this.offset / 2) + 1;

                if (this.offset > this.pagination.last_page || from < 1) {
                    from = 1;
                }else{
                    if(this.pagination.current_page > this.pagination.last_page - 1){
                        from = this.pagination.last_page - this.offset + 1;
                    }
                }

                let to = from + this.offset - 1;
                if (to > this.pagination.last_page) {
                    to = this.pagination.last_page;
                }

                do {
                    range.push(from);
                    from++;
                } while (from <= to);

                return range;
            }
        }
    }
</script>
