<template>
    <transition-group>
        <div class="p-make" :key="count"  v-show="startFlg === true && endFlg === false">
            <div v-if="count === -1">
                <p class="p-make__err" v-if="errFlg">空欄があります。</p>
                <h1 class="c-heading u-center">クイズのテーマ編集</h1>
                <input class="p-make__subject" type="text" placeholder="○○クイズ" v-model="subject">
                <button class="c-btn" @click="add">問題文と解答編集へ</button>
            </div>
            <div v-else>
                <p class="p-make__err" v-if="errFlg">空欄があります。</p>
                <h1 class="c-heading u-center">問題{{ count + 1 }} 編集</h1>
                <div class="p-make__block">
                    <label class="p-make__label" for="problem">問題文</label>
                    　   <input class="p-make__problem"  type="text"
                               v-model="problem[count]" placeholder="好きな果物は？">
                </div>
                <div class="p-make__block">
                    <label class="p-make__label" for="choice1">選択肢１</label>
                    <input class="p-make__choice" type="text"
                           v-model="choice1[count]" placeholder="りんご">
                </div>
                <div class="p-make__block">
                    <label class="p-make__label" for="choice2">選択肢２</label>
                    <input class="p-make__choice" type="text"
                           v-model="choice2[count]" placeholder="ぶどう">
                </div>
                <div class="p-make__block">
                    <label class="p-make__label" for="choice3">選択肢３</label>
                    <input class="p-make__choice" type="text"
                           v-model="choice3[count]" placeholder="ばなな">
                </div>
                <div class="p-make__block">
                    <label class="p-make__label" for="choice4">選択肢４</label>
                    <input class="p-make__choice" type="text"
                           v-model="choice4[count]" placeholder="さくらんぼ">
                </div>
                <div class="p-make__block">
                    <label class="p-make__label" for="answer">解答番号</label>
                    <div class="p-make__answerCon">
                        １,<input class="p-make__answer" type="radio" v-model="answer[count]" value="1">
                        ２,<input class="p-make__answer" type="radio" v-model="answer[count]" value="2">
                        ３,<input class="p-make__answer" type="radio" v-model="answer[count]" value="3">
                        ４,<input class="p-make__answer" type="radio" v-model="answer[count]" value="4">
                    </div>
                </div>
                <button class="c-btn" v-if="count === 0" @click="sub">前のテーマへ</button>
                <button class="c-btn" v-else @click="sub">前の問題へ</button>
                <button class="c-btn" v-if="count < 4" @click="add">次の問題へ</button>
                <button class="c-btn" v-if="count === 4" @click="add">確認へ</button>
            </div>
        </div>

        <div class="p-make" key="c"
             v-show="startFlg === false && endFlg === true">
            <h1 class="c-heading u-center">編集確認</h1>
            <h3>テーマ : {{ subject }}</h3>
            <div v-for="n in [0,1,2,3,4]">
                問題　: {{ problem[n] }}
                選択肢１ : {{ choice1[n] }}
                選択肢２ : {{ choice2[n] }}
                選択肢３ : {{ choice3[n] }}
                選択肢４ : {{ choice4[n] }}
                解答 : {{ answer[n] }}
            </div>
            <button class="c-btn" @click="edit">前に戻る</button>
            <button @click="save" class="c-btn">クイズの編集を完成する</button>
        </div>
    </transition-group>

</template>

<script>
    export default {
        name: "edit",
        props : ['old_problem'],
        data(){
            return{
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
                answer : [],

            }
        },
        mounted(){
            this.subject = this.old_problem.subject;
            this.problem = JSON.parse(this.old_problem.problem);
            this.choice1 = JSON.parse(this.old_problem.choice1);
            this.choice2 = JSON.parse(this.old_problem.choice2);
            this.choice3 = JSON.parse(this.old_problem.choice3);
            this.choice4 = JSON.parse(this.old_problem.choice4);
            this.answer = JSON.parse(this.old_problem.answer);
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
            save : function(){
                axios.post('/quiz/change/' + this.old_problem.id,{ subject : this.subject,
                    problem : this.problem,choice1 : this.choice1,
                    choice2 : this.choice2 , choice3 : this.choice3 ,
                    choice4 : this.choice4 , answer : this.answer}
                ).then(function(response){
                    let url = '/quiz/list/' + this.old_problem.id;
                    location.href = url;
                }.bind(this));
            }
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
