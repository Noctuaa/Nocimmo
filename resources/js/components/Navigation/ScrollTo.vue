<template>
    <div @click="scrollTo" class="scrollto">
        <span></span>
    </div>
</template>

<script>
    //import {gsap} from 'gsap';
    //import {ScrollToPlugin} from "gsap/ScrollToPlugin.js";
    //gsap.registerPlugin(ScrollToPlugin);
    export default {
        methods: {
            scrollTo() {
                const topPos = document.getElementById('courchevel');
                gsap.to(window, {
                    duration: 2,
                    scrollTo: topPos.offsetTop - 90,
                    ease: "power2"
                });
            }
        },
    }

</script>

