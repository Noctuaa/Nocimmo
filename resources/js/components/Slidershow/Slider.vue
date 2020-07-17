<template>

    <Slides ref="caption" :slide="currentSlide"></Slides>

</template>

<script>
    //import {gsap} from "gsap";
    import Slides from './Slides.vue';
    import Items from './items.json';

    export default {
        components: {
            Slides,
        },
        data() {
            return {
                slides: Items,
                index: 0,
            };
        },
        methods: {
            /**
             * Slider Auto
             */
            startSlide() {
                this.timer = setInterval(() => {
                    this.next()
                }, 4500)
            },
            /**
             * Next slide.
             * We hide the previous legend before moving on to the next one
             * We call this method (hideCaption) to the child
             */
            next() {
                this.$refs.caption.hideCaption();
                setTimeout(() => {
                    this.index++
                    if (this.index >= this.slidesCount) {
                        this.index = 0
                    }
                }, 500);
            },
        },
        computed: {
            /**
             * Return informations current slide to Json items
             * @returns {Object}
             */
            currentSlide() {
                return this.slides[Math.abs(this.index) % this.slidesCount];
            },
            /**
             * Return the number of slides
             * @returns {number}
             */
            slidesCount() {
                return this.slides.length;
            }
        },

        mounted() {
            this.startSlide(); 
        },

        destroyed() {
            clearInterval(this.timer);
        }

    }

</script>

