<template >
    
    <img src="./../assets/lg.png" alt="">
    <h1>Login</h1>
    <div class="login">
        <input type="text" v-model="ref" placeholder="Ref" required>
        <button @click="login">Login</button>
        <p>
            <router-link to="/Signup">SignUp</router-link>
        </p>
    </div>

</template>
<script>
import axios from 'axios'
export default {
    name:"loginVue",
    data()
    {
        return{
            ref:'',
        }
    },
    methods:{
        async login()
        {
            let res=await axios.get('http://localhost/Api_cabinet/controllers/userController/login.php?ref='+this.ref);
            // console.log(this.ref);

            if(res.status==200 && res.data.length>0)
            {
                localStorage.setItem("userInfo",JSON.stringify(res.data[0]));
                this.$router.push({name:'HomeVue'})

                // console.log(res.data);
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
    .login input{
        width: 300px;
        height: 40px;
        padding-left: 20px;
        display: block;
        margin: 15px auto;
        border: 1px solid skyblue;
    }
    .login button{
        width: 320px;
        height: 40px;
        border: 1px solid skyblue;
        background: skyblue;
        color: white;
        cursor: pointer;
    }
</style>