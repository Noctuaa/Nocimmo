<template>
    <div>
        <transition-group appear :name="slide.effect" tag="div" class="slide-image">
            <div :key="slide.id" :style="setBackgroundImage"></div>
        </transition-group>
        <div :index="id" :key="slide.id" class="caption_wrapper">
            <div class="caption">
                <font-awesome-icon class="fa-icon" :icon="slide.icon"/>
                <p class="title">{{slide.title}}</p>
                <p v-if="slide.city" class="city">{{slide.city}}</p>
                <p class="subtitle">{{slide.subtitle}}</p>
            </div>
        </div>
    </div>
</template>

<script>
    //import { gsap } from "gsap";
    export default {
        props: ['slide'],
        data() {
            return {
                index: this.$parent.index,
            }
        },
        computed: {
            /**
             * Returns a string the image url
             * @returns {string}
             */
            setBackgroundImage() { 
                return {
                    backgroundImage: "url(" + this.slide.url + ")"
                }
            },
            /**
             * Returns the slider index
             * @returns {number}
             */
            id() {
                return this.index = this.$parent.index;
            },
        },

        methods:{
            /**
             * Animation of the Caption with Gsap
             */
            transitionCaption(){
                gsap.from(".caption", {opacity: 0, duration: 0.6,delay: 0.6})
                gsap.from(".title", {y: 50,stagger: 0.8,duration: 0.7,delay: 0.7 })
                gsap.from(".subtitle", {y: -50,stagger: 0.8,duration: 0.7,delay: 0.7})
                gsap.from('.fa-icon', {transform: 'scale(0)', duration:0.7, delay:1})
                this.slide.city ? gsap.from(".city", {opacity:0, duration: 0.7, delay:1.4}) : ''
            },

            /**
             * Hide the Caption with animation.
             * The method is used in slider.vue
             */
            hideCaption(){
                gsap.to(".caption", { opacity: 0, duration: 0.5})
            }
        },

        mounted() {
            this.transitionCaption()
        },


        watch: {
            /**
             * We check the index to launch a new animation
             */
            index(newIndex, oldIndex) {
                this.transitionCaption();
            }
        }
    }

</script>