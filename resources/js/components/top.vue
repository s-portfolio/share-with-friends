<template>
    <div class="p-top">
        <div class="p-top__title">
            <transition appear>
                <h1 class="p-top__txt">クイズを作って<br/>
                    友達に共有しよう!!</h1>
            </transition>
            <transition appear
                        appear-class="appear-late"
                        appear-active-class="appear-late-active">
                <a class="p-top__link" href="/quiz/make">クイズを作る</a>
            </transition>
        </div>
        <transition appear>
            <img class="p-top__img" :src="'/img/hand.png'" alt="">
        </transition>
    </div>
</template>

<script>
    export default {
        mounted() {

        }
    }
</script>

<style scoped>
    .v-enter{
        opacity:0;
    }
    .v-enter-active{
        transition:all 2s ease;
    }
    .appear-late{
        opacity:0;
    }
    .appear-late-active{
        transition:all 3s  ease;
    }
</style>
