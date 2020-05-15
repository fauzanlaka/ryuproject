<template>
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-12">
                <h1>รายละเอียดกระทู้ : {{id}}</h1>
                <p>The new rule bars semiconductor-makers that use US technology and software in chip design from shipping to Huawei without US government permission.</p>
                <p>It is the latest US action to target Huawei, which US officials view as a national security threat.</p>
                <p>China threatened to retaliate against US tech firms.</p>
                <p>The tightened controls come a year after the US moved to cut off Huawei, the world's second largest smart phone maker, from access to US-made semiconductor chips, which form the backbone of most computer and phone systems.</p>
                
                <p>คะแนน : {{starScore}} ดาว</p>
                
                <!-- ให้คะแนนกระทู้ -->
                <div class="rate">
                    <input type="radio" id="star5" name="rate" :value="5" v-model="starLevel" @click="giveStar($event.target.value)"/>
                    <label for="star5" title="text">5 stars</label>
                    <input type="radio" id="star4" name="rate" :value="4" v-model="starLevel" @click="giveStar($event.target.value)"/>
                    <label for="star4" title="text">4 stars</label>
                    <input type="radio" id="star3" name="rate" :value="3" v-model="starLevel" @click="giveStar($event.target.value)"/>
                    <label for="star3" title="text">3 stars</label>
                    <input type="radio" id="star2" name="rate" :value="2" v-model="starLevel" @click="giveStar($event.target.value)"/>
                    <label for="star2" title="text">2 stars</label>
                    <input type="radio" id="star1" name="rate" :value="1" v-model="starLevel" @click="giveStar($event.target.value)"/>
                    <label for="star1" title="text">1 star</label>
                </div>
                <!-- /.ให้คะแนนกระทู้ -->


            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            id: ''//id ของ review นั้นๆ วิธีที่จะรับ id นี้อาจไม่เหมือนของที่เราทำ
        },
        mounted(){
            this.getStarScore();
        },
        data(){
            return{
                starScore: '',
                starLevel: '',
            }
        },
        methods:{
            //ดึงคะเเนนเฉลี่ยน (ดาว)
            getStarScore(){
                axios.get('/api/starScore/'+this.id)
                    .then(r => {
                        this.starScore = r.data.score;
                    })
                    .catch(() => {

                    })
            },
            //บันทึกการให้คะแนน (ดาว)
            giveStar(star){
                axios.post('/api/giveStar',{
                    'star':star,
                    'post_id':this.id
                    })
                    .then(r => {

                    })
                    .catch(() => {

                    })
            }
        }
    }
</script>

<style scoped>
    /* *{
        margin: 0;
        padding: 0;
    } */
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }
    .rate:not(:checked) > input {
        position:absolute;
        top:-9999px;
    }
    .rate:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ccc;
    }
    .rate:not(:checked) > label:before {
        content: '★ ';
    }
    .rate > input:checked ~ label {
        color: #ffc700;    
    }
    .rate:not(:checked) > label:hover,
    .rate:not(:checked) > label:hover ~ label {
        color: #deb217;  
    }
    .rate > input:checked + label:hover,
    .rate > input:checked + label:hover ~ label,
    .rate > input:checked ~ label:hover,
    .rate > input:checked ~ label:hover ~ label,
    .rate > label:hover ~ input:checked ~ label {
        color: #c59b08;
    }

    /* Modified from: https://github.com/mukulkant/Star-rating-using-pure-css */
</style>
