<template>
    <transition-group>
        <div class="p-make" :key="count"  v-show="startFlg === true && endFlg === false">
            <div v-if="count === -1">
                <h1 class="c-heading u-center">クイズのテーマ</h1>
                <h2 class="p-test__title">{{ subject }}</h2>
                <button class="c-btn" @click="add">クイズを開始する</button>
            </div>
            <div v-else>
                <h1 class="c-heading u-center">問題{{ count + 1 }}</h1>
                <div class="p-make__block">
                    <label class="p-test__label" for="problem">問題</label>
                    　   <h1 class="p-test__problem">{{ problem[count] }}</h1>
                </div>
                <div class="p-make__block">
                    <label class="p-test__label" for="choice1">選択肢１</label>
                    <span class="p-test__choice">・ {{ choice1[count] }}</span>
                </div>
                <div class="p-make__block">
                    <label class="p-test__label" for="choice2">選択肢２</label>
                    <span class="p-test__choice">・ {{ choice2[count] }}</span>
                </div>
                <div class="p-make__block">
                    <label class="p-test__label" for="choice3">選択肢３</label>
                    <span class="p-test__choice">・ {{ choice3[count] }}</span>
                </div>
                <div class="p-make__block">
                    <label class="p-test__label" for="choice4">選択肢４</label>
                    <span class="p-test__choice">・ {{ choice4[count] }}</span>
                </div>
                <div class="p-make__block">
                    <label class="p-test__label" for="answer">解答を選択してください</label>
                    <p class="p-test__err" v-if="errFlg">解答を選択してください</p>
                    <div class="p-make__answerCon">
                        １,<input class="p-make__answer" type="radio" v-model="answer[count]" value="1">
                        ２,<input class="p-make__answer" type="radio" v-model="answer[count]" value="2">
                        ３,<input class="p-make__answer" type="radio" v-model="answer[count]" value="3">
                        ４,<input class="p-make__answer" type="radio" v-model="answer[count]" value="4">
                    </div>
                </div>
                <button class="c-btn" v-if="count !== 0" @click="sub">前の問題へ</button>
                <button class="c-btn" v-if="count < 4" @click="add">次の問題へ</button>
                <button class="c-btn" v-if="count === 4" @click="add">クイズ結果へ</button>
            </div>
        </div>

        <div class="p-make" key="c"
             v-show="startFlg === false && endFlg === true">
            <h1 class="c-heading u-center">クイズ結果</h1>
            <p class="p-test__result">あなたは ５問中 {{ this.result }}問 正解でした。</p>
            <a class="c-btn" :href="this.url">もう一度挑戦する</a>
        </div>
    </transition-group>

</template>

<script>
    export default {
        name: "test",
        props : ['test'],
        data(){
            return{
                url : '',
                startFlg : true,
                endFlg : false,
                errFlg : false,
                count : -1,
                subject : '',
                problem : [],
                choice1 : [],
                choice2 : [],
                choice3 : [],
                choice4 : [],
                correct_answer : [],
                answer : [],
                result : 0,
            }
        },
        mounted(){
            this.id = '/quiz/test/' +  this.test.id;
            this.subject = this.test.subject;
            this.problem = JSON.parse(this.test.problem);
            this.choice1 = JSON.parse(this.test.choice1);
            this.choice2 = JSON.parse(this.test.choice2);
            this.choice3 = JSON.parse(this.test.choice3);
            this.choice4 = JSON.parse(this.test.choice4);
            this.correct_answer = JSON.parse(this.test.answer);
        },
        computed :  {
            arr : function(){
                if(this.count === 0){
                    return this.count;
                }else{
                    return this.count - 1 ;
                }
            },
        },
        methods : {
            start : function(){
                this.startFlg = true;
            },
            add : function(){
                if(this.count === -1){
                    if(this.subject){
                        this.correct();
                        this.plus();
                    }else{
                        this.err();
                    }
                }else{
                    if(this.problem[this.count] && this.choice1[this.count] && this.choice2[this.count]
                        && this.choice3[this.count] && this.choice4[this.count] && this.answer[this.count]){
                        this.correct();
                        if(this.count === 4){
                            for(let i =0;i < 5;i++){
                                if(this.correct_answer[i] === this.answer[i]){
                                    this.result ++;
                                }
                            }
                            this.startFlg = false;
                            this.endFlg = true;
                        }else{
                            this.plus();
                        }
                    }else{
                        this.err();
                    }
                }
            },
            sub : function(){
                this.count --;
            },
            plus : function(){
                this.count　++;
            },
            err : function(){
                this.errFlg = true;
            },
            correct : function(){
                this.errFlg = false;
            },
            edit : function(){
                this.startFlg = true;
                this.endFlg = false;
            },
        }
    }
</script>

<style scoped>
    .v-enter {
        transform: translate(-100px, 0);
        opacity: 0;
    }
    .v-enter-to {
        opacity: 1;
    }
    .v-enter-active {
        transition: all 1s 0s ease;
    }
    .v-leave {
        transform: translate(0, 0);
        opacity: 1;
    }
    .v-leave-to {
        transform: translate(0,-100px);
        opacity: 0;
    }
    .v-leave-active {
        transition: all .5s 0s ease;
    }
</style>

