<template>
    <div class="backtop">
        <a @click.prevent="scrollTop" class="d-inline-flex justify-content-center align-items-center" href="">
            <font-awesome-icon class="fa" icon="angle-up" />
        </a>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                hide:Boolean,
            }
        },
        methods: {
            scrollTop(){ //Come back to the top with animation
                 gsap.to(window, {duration: 2, scrollTo: 0, ease: "power2"});
            },
            visible(){ // Visibility of the button according to the pageYOffset
                window.addEventListener('scroll', () => {
                    window.pageYOffset <= 80 ? this.hide = true : this.hide = false;
                })
            }
        },
        watch: {
            hide(newValue, OldValue){ // Animation of the button in real time
                newValue === true ? gsap.to('.backtop', {right: -60, opacity:0, duration:0.3}) : gsap.to('.backtop', {right: 15, opacity:0.7, duration:0.3})
           }
        },
        mounted(){
            this.visible();
        }
    }

</script>

