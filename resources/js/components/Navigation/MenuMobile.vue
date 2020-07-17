<template>
    <div class="mobile_nav">
        <div id="hamburger" :class="{'close': this.state}" @click="stateMobileNav('menu')">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </div>
        <div v-if="displaySearch" id="icon_search" @click="stateMobileNav('search')">
            <font-awesome-icon class="fa-search" icon="search" />
        </div>
    </div>
</template>

<script>
import {mapGetters} from 'vuex';

export default {
    props: {url: ""},
    data(){
        return {
            state: false,
            search: false,
            route: this.url
        }
    },
    methods: {
        /**
         * Choose the type of menu to open between search and nav.
         * Trigger the corresponding animation
         * @param {string} type - Type of menu to open between search and nav
         */
        stateMobileNav(type = String){
            if(type ===  'menu'){
                this.search = false;
                this.state = !this.state;
            }else{
                this.search = true;
                this.state = true;
            }
  
            //this.$emit('clicked', this.state);
            this.animation();
        },
        /**
         * Close Mobile Animation with Gsap
         */
        closeMobile(){
            gsap.to('.nav_header',{height: '', duration: 0.5, delay: .5})
            gsap.to('.logo', {opacity:0, transform:'scale(1)', duration:0.3})
            gsap.to('#access ul li',{x: "-100%", opacity: 0, autoAlpha:0, duration:0.3,
                    stagger: {each:0.1}
            });
            const queryFilter = document.getElementsByClassName('query_filter');
            queryFilter.length > 0 ? gsap.to('.query_filter', {opacity:0, autoAlpha:0, display:'none', duration:0.3}) : ''; 
            gsap.to('.logo, #access ul li, .query_filter', {display:'', opacity: '', visibility: '', x: '', delay: .5});
            document.body.classList.remove('noScroll');
        },
        /**
         * Mobile menu animation with Gsap
         */
        animation(){
            if(!this.search && this.state){ // Open Menu
                document.body.classList.add('noScroll');
                gsap.to('.nav_header',{height: '100vh', duration:.3});
                gsap.to('.logo', {opacity:1, autoAlpha:1, transform:'scale(1)', duration:0.3, delay:.5})
                gsap.to('#access ul li',{x: "100%", opacity: 1, autoAlpha:1, duration:0.3, delay:.5,
                        stagger: {each:0.1}
                });
            }else if(this.state && this.search){ // Open Search
                document.body.classList.add('noScroll');
                gsap.to('.nav_header',{height: '100vh', duration:.3});
                gsap.to('.logo', {opacity:0, autoAlpha:0, transform:'scale(1)', duration:.3})
                gsap.to('#access ul li',{x: "-100%", opacity: 0, duration:.3,
                        stagger: {each:0.1}
                });
                gsap.to('.query_filter', {opacity:1, autoAlpha:1, display:'block', duration:0.3, delay:.5})
            }else if (!this.search && !this.state ){// Close Menu or Search
                this.closeMobile();
            }
        }
    },

    computed: {
        ...mapGetters([
            'filter',
        ]),

        /**
         * Displays the icon searches only if the route is sale or rental
         */
        displaySearch(){
            if(window.location.href ===  this.route[0] || window.location.href ===  this.route[1] ){
                return true;
            }else{
                return false;
            }
        }
    },

    watch: {
        /**
         * When we send the search we check that everything is ok with filter and we close the mobile menu
        */
        filter(newValue) {
            if(window.matchMedia("(max-width: 960px)").matches && newValue === true){
                this.state = false;
                this.search = false;
                this.closeMobile();
            }
        }
    }
}
</script>
