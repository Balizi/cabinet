<template >
    <img src="./../assets/lg.png" alt="">
    <h1>SignUp </h1>
    <div class="regiser">
        <input type="text" v-model="nom" placeholder="Nom" required>
        <input type="text" v-model="prenom" placeholder="Prenom" required>
        <input type="date" v-model="datenaissance" name="" id="" required>
        <button @click="signUp">Sign Up</button>
        <p>
            <router-link to="/login">Login</router-link>
        </p>
    </div>


</template>
<script>
import axios from 'axios'
export default {
    name:"SignupVue",
    data()
    {
        return{
            nom:'',
            prenom:'',
            datenaissance:''
        }
    },
    methods:{
        async signUp()
        {
            // console.warn('Sign Up',this.nom,this.prenom,this.datenaissance);
            let res=await axios.post("http://localhost/Api_cabinet/controllers/userController/signup.php",{
                nom:this.nom,
                prenom:this.prenom,
                datenaissance:this.datenaissance
            })

            console.log(res.data.data['ref']);

            if(res.status==200)
            {
                localStorage.setItem("userInfo",JSON.stringify(res.data));
                this.$router.push({name:'HomeVue'})
            }
        }
    },
    mounted()
    {
        let user=localStorage.getItem('userInfo');
        if(user)
        {
            this.$router.push({name:'HomeVue'})
        }
    }
}
</script>
<style scoped>
    img{
        width: 100px;
        margin-top: 60px;
    }
    .regiser input{
        width: 300px;
        height: 40px;
        padding-left: 20px;
        display: block;
        margin: 15px auto;
        border: 1px solid skyblue;
    }
    .regiser button{
        width: 320px;
        height: 40px;
        border: 1px solid skyblue;
        background: skyblue;
        color: white;
        cursor: pointer;
    }
</style>