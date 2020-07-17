<template>
    <div class="carousel">
        <div id="carousel1">
            <hooper ref="carousel" group="group1" :infiniteScroll="true" :itemsToShow="1" pagination="no"
                style="height: 100%" :wheelControl="false" @slide="updateCarousel">
                <slide v-for="(item, n) in items" :key="n" :index="n">
                    <div class="item">
                        <img :src="'/' + item" :alt="'Image ' + name">
                    </div>
                </slide>
            </hooper>
        </div>
        <div v-if="slidesCount > 1" >        
            <font-awesome-icon class="carousel_prev" @click.prevent="slidePrev" icon="chevron-circle-up" />
            <font-awesome-icon class="carousel_next" @click.prevent="slideNext" icon="chevron-circle-up" />
        </div>

        <div v-if="slidesCount > 1" id="carousel2" :class="{hide: !isActive}">
            <hooper v-if="slidesCount >= 7" group="group1" :itemsToShow="5" :infiniteScroll="true" :centerMode="true"
                :wheelControl="false">
                <slide v-for="(item, n) in items" :key="n" :index="n">
                    <div class="item" @click="slideTo(n)">
                        <img :src="'/' + item" :alt="'Image ' + name" style="width:143px">
                    </div>
                </slide>
            </hooper>
            <div v-else v-for="(item, n) in items" :key="n" :index="n" :class="carouselData === n ? 'is-current' : ''">
                <div class="item" @click="slideTo(n)">
                    <img :src="'/' + item" :alt="'Image ' + name" style="width:143px">
                </div>
            </div>
        </div>
        <div v-if="slidesCount > 1" class="carousel_pagination">
            <button v-for="n in slidesCount" @click="slideTo(n-1)" :class="{active: n-1 == carouselData}"
                :key="n"></button>
            <font-awesome-icon class="button_state" icon="chevron-circle-up" @click="stateContainer"
                :class="{chevron_down: !isActive}" />
        </div>
    </div>
</template>

<script>
    import {
        Hooper,
        Slide
    } from 'hooper';
    import 'hooper/dist/hooper.css';
    export default {
        components: {
            Hooper,
            Slide
        },
        props: ['url','name'],
        data() {
            return {
                items: JSON.parse(this.url),
                isActive: true,
                carouselData: 0
            }
        },

        methods: {
            /**
             * Controls the display of the second carousel
             */
            stateContainer() {
                this.isActive = !this.isActive;
            },
            slideTo(index) {
                this.$refs.carousel.slideTo(index);
                index = this.carouselData
            },
            slideNext() {
                this.$refs.carousel.slideNext();
            },
            slidePrev() {
                this.$refs.carousel.slidePrev();
            },
            updateCarousel(payload) {
                this.carouselData = payload.currentSlide;
                if (this.carouselData >= this.slidesCount) {
                    this.carouselData = 0;
                } else if (this.carouselData < 0) {
                    this.carouselData = this.slidesCount - 1
                }
            }
        },

        computed: {
            slidesCount() { // Return the number of slides
                return this.items.length;
            },
        },
    }

</script>
